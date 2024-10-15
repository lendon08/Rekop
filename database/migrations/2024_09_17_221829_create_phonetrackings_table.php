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
        Schema::create('phonetrackings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Phonenumbers::class);
            $table->tinyInteger('display');
            $table->tinyInteger('useon');
            $table->tinyInteger('googleads');
            $table->string('tracking_options', 50);
            $table->string('URL', 100)->nullable();
            $table->string('search_engine', 100)->nullable(); //Google, Yahoo, Bing, All
            $table->string('traffic', 100)->nullable(); // paid, organic, all
            $table->string('swaptarget');
            $table->string('callforwarding');
            $table->tinyInteger('numoftracking');
            $table->string('areacode');
            $table->string('poolname');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phonetrackings');
    }
};
