<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingCollection;
use App\Models\Setting;
use App\Services\ApiResponse;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $allsettings = SettingCollection::collection(Setting::all());
        $allsettings = $allsettings->mapWithKeys(function($setting, $key) {
            return [$setting->key => $setting];
        });
        return ApiResponse::json(
            $allsettings
        );
    }

}
