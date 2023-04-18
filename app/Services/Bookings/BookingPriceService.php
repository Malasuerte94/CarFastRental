<?php

namespace App\Services\Bookings;
use App\Models\Bookable;
use App\Models\SeasonPrice;
use App\Services\Bookings\BookingService;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Summary of BookingPriceService
 */
class BookingPriceService extends BookingService
{
    private Bookable $bookable;
    private string $from;
    private string $to;
    private int $bookedDays;
    private float $priceSingle;
    private int $priceFullDays;
    private float $priceTotal;

    private Collection $extra;

    public function __construct(Bookable $bookable, string $from, string $to)
    {
        parent::__construct();
        $this->bookable = $bookable;
        $this->from = $from;
        $this->to = $to;
        $this->setPrices();

    }
    public function setPrices()
    {
        $this->extra = collect();
        $this->priceSingle = $this->bookable->price;
        $this->bookedDays = (new Carbon($this->from))->diffInDays(new Carbon($this->to)) + 1;
        $this->priceFullDays = $this->bookedDays * $this->priceSingle;
        $this->priceTotal = $this->priceFullDays;
    }

    public function calculatePrice()
    {
        $activeSeasons = $this->getActiveSeasons();

        if ($activeSeasons) {
            $this->applySeasonalPriceRules($activeSeasons);
        }

        $activePriceRules = $this->getActivePriceRules();

        if ($activePriceRules) {
            $this->applyCustomPriceRules($activePriceRules);
        }

        return [
            'total' => $this->priceTotal,
            'breakdown' => [
                $this->bookable->price => $this->bookedDays,
            ],
            'extra' => [$this->extra],
        ];
    }

    public function applySeasonalPriceRules($priceRules)
    {
        if ($priceRules->count() > 0) {
            foreach ($priceRules as $priceRule) {
                $priceModifier = $this->seasonCalculator($priceRule);
                $this->updateExtra($priceRule, $priceModifier);
            }
            return;
        }
    }

    public function applyCustomPriceRules($priceRules)
    {
        if ($priceRules->count() > 0) {
            foreach ($priceRules as $priceRule) {
                if ($priceRule->priceConditions->condition === 'weekend') {
                    $weekendDays = $this->getWeekendDaysInBooking();
                    $priceModifier = $this->applyCustomWeekendPriceRules($priceRule, $weekendDays);
                    $this->updateExtra($priceRule, $priceModifier);
                }
            }
        }
    }

    public function applyCustomWeekendPriceRules($priceRule, $weekendDays)
    {
        $operation = $priceRule->operation;
        $type = $priceRule->type;
        $value = $priceRule->value;
        $multiplier = $priceRule->multiplier;

        if($type === 'fixed') {
            $priceModifier = $this->customFixedCalculator($weekendDays, $value, $operation, $multiplier);
        } else {
            $priceModifier = $this->customPercentageCalculator($weekendDays, $value, $operation, $multiplier);
        }


        return $priceModifier;
    }

    public function customPercentageCalculator($days, $value, $operation, $multiplier) {
        if($multiplier == 'once') {
            if($operation === 'add') {
                $this->priceTotal += $this->priceTotal * ($value / 100);
            } elseif($operation === 'subtract') {
                $this->priceTotal -= $this->priceTotal * ($value / 100);
            }
            return $this->priceTotal * ($value / 100);
        }
        if($multiplier == 'per_day') {
            if($operation === 'add') {
                $this->priceTotal += $this->priceTotal * ($value / 100) * $days;
            } elseif($operation === 'subtract') {
                $this->priceTotal -= $this->priceTotal * ($value / 100) * $days;
            }
            return $this->priceTotal * ($value / 100) * $days;
        }
        return 0;
    }

    public function customFixedCalculator($days, $value, $operation, $multiplier) {
        if ($multiplier == 'once') {
            if ($operation === 'add') {
                $this->priceTotal += $value;
            } elseif ($operation === 'subtract') {
                $this->priceTotal -= $value;
            }
            return $value;
        }

        if ($multiplier == 'per_day') {
            if ($operation === 'add') {
                $this->priceTotal += $value * $days;
            } elseif ($operation === 'subtract') {
                $this->priceTotal -= $value * $days;
            }
            return $value * $days;
        }

        return 0;
    }

    public function getWeekendDaysInBooking()
    {
        $weekendDays = 0;
                    $startDate = Carbon::parse($this->from);
                    $endDate = Carbon::parse($this->to);

                    while ($startDate <= $endDate) {
                        if ($startDate->isWeekend()) {
                            $weekendDays++;
                        }
                        $startDate->addDay();
                    }
        return $weekendDays;
    }

    public function seasonCalculator($priceRule)
    {
        $operation = $priceRule->operation;
        $type = $priceRule->type;
        $value = $priceRule->value;
        $multiplier = $priceRule->multiplier;

        if ($type === 'fixed') {
            $priceAddition = $this->applyFixedPriceRule($operation, $value, $multiplier);
        } elseif ($type === 'percentage') {
            $priceAddition = $this->applyPercentagePriceRule($operation, $value, $multiplier);
        }

        return $priceAddition;
    }

    public function applyFixedPriceRule($operation, $value, $multiplier)
    {
        if ($multiplier == 'once') {
            if ($operation === 'add') {
                $this->priceTotal += $value;
            } elseif ($operation === 'subtract') {
                $this->priceTotal -= $value;
            }
            return $value;
        }

        if ($multiplier == 'per_day') {
            if ($operation === 'add') {
                $this->priceTotal += $value * $this->bookedDays;
            } elseif ($operation === 'subtract') {
                $this->priceTotal -= $value * $this->bookedDays;
            }
            return $value * $this->bookedDays;
        }

        return 0;
    }

    public function applyPercentagePriceRule($operation, $value, $multiplier)
    {
        if ($multiplier == 'once') {
            if ($operation === 'add') {
                $this->priceTotal += $this->priceTotal * ($value / 100);
            } elseif ($operation === 'subtract') {
                $this->priceTotal -= $this->priceTotal * ($value / 100);
            }
            return $this->priceTotal * ($value / 100);
        }

        if ($multiplier == 'once') {
            if ($operation === 'add') {
                $this->priceTotal += ($this->priceSingle * ($value / 100)) * $this->bookedDays;
            } elseif ($operation === 'subtract') {
                $this->priceTotal -= ($this->priceSingle * ($value / 100)) * $this->bookedDays;
            }
            return ($this->priceSingle * ($value / 100)) * $this->bookedDays;
        }

        return 0;
    }

    public function updateExtra($priceRule, $priceAdded)
    {
        $this->extra->push([
            'label' => $priceRule->label,
            'value' => $priceRule->value,
            'multiplier' => $priceRule->multiplier == 'once' ? '1' : $this->bookedDays,
            'operation' => $priceRule->operation === 'add' ? '+' : '-',
            'value_type' => $priceRule->type === 'fixed' ? '€' : '%',
            'total' => $priceAdded,
        ]);
    }

    public function getActiveSeasons()
    {
        $seasons = SeasonPrice::where('start_date', '<=', $this->from)
            ->where('end_date', '>=', $this->to)->where('active', true)
            ->get();

        return $seasons;
    }

    public function getActivePriceRules()
    {
        $priceRules = $this->bookable->priceRules()->where('active', true)->get();

        return $priceRules;
    }
}
