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
        Schema::table('mail_register', function (Blueprint $table) {
            //Arrived Status
            $table->timestamp('arrived_at')->nullable();
            $table->json('arrived_data')->nullable();
            $table->unsignedBigInteger('receiver_id')->nullable();

            //Recorded Status
            $table->timestamp('recorded_at')->nullable();
            $table->string('record_number')->nullable();
            $table->json('recorded_data')->nullable();
            //Process Status
            $table->timestamp('processed_at')->nullable();
            $table->json('processed_data')->nullable();
            $table->text('processed_orientations')->nullable();

            //Send Status
            $table->timestamp('sent_at')->nullable();
            $table->json('sent_to')->nullable();
            $table->string('sent_number')->nullable();
            $table->unsignedBigInteger('sender_id')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mail_register', function (Blueprint $table) {
            //
            $table->removeColumn('arrived_at');
            $table->removeColumn('arrived_data');
            $table->removeColumn('receiver_id');

            $table->removeColumn('recorded_at');
            $table->removeColumn('recorded_data');
            $table->removeColumn('arrived_number');

            $table->removeColumn('processed_at');
            $table->removeColumn('processed_data');
            $table->removeColumn('processed_orientations');

            $table->removeColumn('sent_at');
            $table->removeColumn('sent_to');
            $table->removeColumn('sent_number');
            $table->removeColumn('sender_id');

        });
    }
};
