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
            // $table->string('phonenumber_id');
            // $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('number');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->softDeletes();
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
