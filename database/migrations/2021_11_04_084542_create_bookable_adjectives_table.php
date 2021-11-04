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
        Schema::create('bookable_adjective', function (Blueprint $table) {
            $table->unsignedBigInteger('bookable_id');
            $table->unsignedBigInteger('adjective_id');

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
        Schema::dropIfExists('bookable_adjective');
    }
}
