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
        Schema::create('parafeures', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('initiated_by');
            $table->bigInteger('service_id');
            $table->string('title');
            $table->text('abstract')->nullable();
            $table->unsignedInteger('signed')->nullable();
            $table->timestamp('signet_at')->nullable();
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
        Schema::drop('parafeures');
    }
};
