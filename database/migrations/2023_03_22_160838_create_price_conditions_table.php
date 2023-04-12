<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_conditions', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(true);

            $table->string('name');
            $table->string('description');
            $table->string('label');

            $table->enum('condition', ['weekend', 'holiday', 'cart', 'payment'])->default('weekend');
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
        Schema::dropIfExists('price_conditions');
    }
}
