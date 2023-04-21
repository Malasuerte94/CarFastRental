<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        $data = [
            ['key' => 'feature_icons_title',
                'name'  => 'Titlu - Secțiune "Beneficii"',
                'value' => 'Rezervă acum și beneficiezi de'
            ],
            ['key' => 'home_search_title',
                'name'  => 'Titlu - Secțiune "Căutare"',
                'value' => 'Când vrei să închiriezi?'
            ],
            ['key' => 'home_faq_title',
                'name'  => 'Titlu - Secțiune "Faq"',
                'value' => 'Întrebări frecvente'
            ],
            ['key' => 'cta_phone_icon',
                'name'  => 'Text CTA - Secțiune "Apel telefonic"',
                'value' => 'Ne poți contacta telefonic la'
            ],
            ['key' => 'cta_phone_number',
                'name'  => 'Număr de telefon 1 - Secțiune "Apel telefonic"',
                'value' => '0747729446'
            ],
            ['key' => 'cta_phone_number',
                'name'  => 'Număr de telefon 2 - Secțiune "Apel telefonic"',
                'value' => '0756245243'
            ]
        ];

        Setting::insert($data);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
