<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_prices', function (Blueprint $table) {
            $table->id();

            $table->boolean('active')->default(true);

            $table->string('name');
            $table->string('description');
            $table->string('label');

            $table->date('start_date');
            $table->date('end_date');

            $table->string('operation');
            $table->enum('type', ['fixed', 'percentage'])->default('fixed');
            $table->string('value');
            $table->enum('multiplier', ['per_day', 'once'])->default('per_day');

            $table->boolean('global')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_prices');
    }
}
