<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_rules', function (Blueprint $table) {
            $table->id();

            $table->boolean('active')->default(true);

            $table->string('name');
            $table->string('description');
            $table->string('label');

            $table->string('operation');
            $table->enum('type', ['fixed', 'percentage'])->default('fixed');
            $table->string('value');

            $table->enum('multiplier', ['per_day', 'once'])->default('per_day');

            $table->boolean('global')->default(false);
            $table->integer('order')->default(0);

            $table->unsignedBigInteger('price_conditions_id')->index()->nullable();
            $table->unsignedBigInteger('bookable_id')->index()->nullable();
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
        Schema::dropIfExists('price_rules');
    }
}
