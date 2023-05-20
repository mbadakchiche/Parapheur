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
        Schema::create('mail_register', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('mail_id');
            $table->unsignedInteger('register_id');

            $table->timestamps();
            $table->foreign('mail_id')->references('id')->on('mails')->onDelete('cascade');
            $table->foreign('register_id')->references('id')->on('registers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_register');
    }
};
