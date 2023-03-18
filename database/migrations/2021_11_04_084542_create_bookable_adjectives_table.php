<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookableAdjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookable_adjectives', function (Blueprint $table) {

            $table->id();

            $table->string('value');

            $table->unsignedBigInteger('bookable_id');
            $table->unsignedBigInteger('adjective_id');

            $table->timestamps();

            $table->foreign('bookable_id')
                ->references('id')
                ->on('bookables')
                ->onDelete('cascade');

            $table->foreign('adjective_id')
                ->references('id')
                ->on('adjectives')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookable_adjectives');
    }
}
