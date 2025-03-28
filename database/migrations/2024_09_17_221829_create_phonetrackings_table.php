<?php


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
            $table->foreignUuid('phonenumber_id')->constrained('phonenumbers')->onDelete('cascade');
            $table->tinyInteger('display');
            $table->tinyInteger('useon');
            $table->tinyInteger('googleads');
            $table->string('utm_source', 100)->nullable();
            $table->string('utm_medium', 100)->nullable();
            $table->string('utm_campaign', 100)->nullable();
            $table->string('tracking_options', 50);
            $table->string('URL', 100)->nullable();
            $table->string('search_engine', 100)->nullable(); //Google, Yahoo, Bing, All
            $table->string('traffic', 100)->nullable(); // paid, organic, all
            $table->string('swaptarget');
            $table->string('callforwarding');
            $table->string('whispermsg');
            $table->boolean('recordingflag')->default(true);
            $table->boolean('textmsg')->default(false);
            $table->string('callgreeting');
            $table->string('campaignname');
            $table->boolean('autoreply')->default(false);
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
