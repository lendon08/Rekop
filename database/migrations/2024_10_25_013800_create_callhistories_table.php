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
        Schema::create('callhistories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('phonenumber_id')->constrained('phonenumbers')->onDelete('cascade');
            $table->string('caller');
            $table->integer('duration');
            $table->float('price', 4, 6)->nullable();
            $table->dateTime('call_date', precision: 0)->nullable();
            $table->string('recording');
            $table->string('status', 10);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('callhistories');
    }
};
