<?php

use App\Models\User;
use App\Models\Company;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->string('projectid')->nullable();
            $table->string('token')->nullable();
            $table->decimal('lead_value', $precision = 15, $scale = 2)->default(15.0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('company_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Company::class);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('company_phonenumber', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Phonenumbers::class);
            $table->foreignIdFor(Company::class);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
        Schema::dropIfExists('company_user');
        Schema::dropIfExists('company_phonenumber');
    }
};
