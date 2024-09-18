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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('fwd_number');
            $table->integer('sets');
            $table->enum('day', [1, 2, 3, 4, 5, 6, 7]);
            $table->enum('callflow', ['ring through', 'multi ring', 'round robin']);
            $table->string('call_request_url')->nullable();
            $table->time('start_sched')->nullable();
            $table->time('end_sched')->nullable();
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
        Schema::dropIfExists('schedule');
    }
};
