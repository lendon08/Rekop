<?php

use App\Models\Phonenumbers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('phone_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Phonenumbers::class);
            $table->tinyInteger('display');
            $table->tinyInteger('useon');
            $table->tinyInteger('googleads');
            $table->tinyInteger('options');
            $table->string('swaptarget');
            $table->string('callforwarding');
            $table->tinyInteger('numoftracking');
            $table->string('areacode');
            $table->string('poolname');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_trackings');
    }
};
