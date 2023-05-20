<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label_ar');
            $table->string('label_en');
            $table->year('year');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('starting_nbr');
            $table->enum('type', [1,2])->nullable();
            $table->enum('category', [1,2])->nullable();
            $table->text('licence');
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
        Schema::drop('registers');
    }
};
