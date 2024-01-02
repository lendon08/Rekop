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
        Schema::create('phonenumbers', function (Blueprint $table) {
            $table->id();
            $table->string('phone_id');
            $table->string('name')->nullable();
            $table->string('number');
            $table->string('fwd');
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
        Schema::dropIfExists('phonenumbers');
    }
};
