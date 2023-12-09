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
            $table->string('id')->unique();
            $table->string('name')->nullable();
            $table->string('number');
            $table->string('call_handler');
            $table->string('call_request_url')->nullable();
            $table->string('message_handler');
            $table->string('message_request_url')->nullable();
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
