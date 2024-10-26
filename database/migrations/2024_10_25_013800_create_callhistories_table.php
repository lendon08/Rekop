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
            $table->string('caller');
            $table->string('receiver');
            $table->integer('duration');
            $table->float('price', 4, 6);
            $table->dateTime('call_date', precision: 0);
            $table->string('recording');
            $table->softDeletes();
            $table->timestamps();
        });
    }


    // "sid" => "1565933b-8939-47c5-8d85-4f4ef47c8f9f"
    // "date_created" => "Thu, 24 Oct 2024 22:08:25 +0000"
    // "date_updated" => "Thu, 24 Oct 2024 22:14:03 +0000"
    // "parent_call_sid" => null
    // "account_sid" => "341c89fe-24f0-4265-8c1f-ba993b277d0c"
    // "to" => "+13463598737"
    // "formatted_to" => "346-359-8737"
    // "to_formatted" => "346-359-8737"
    // "from" => "+525657009130"
    // "formatted_from" => "+525657009130"
    // "from_formatted" => "+525657009130"
    // "phone_number_sid" => "33a196f6-7879-4451-8411-8aecdd08f3bc"
    // "status" => "completed"
    // "start_time" => "Thu, 24 Oct 2024 22:08:25 +0000"
    // "end_time" => "Thu, 24 Oct 2024 22:08:46 +0000"
    // "duration" => 22
    // "price" => 0.00928
    // "price_unit" => "USD"
    // "direction" => "inbound"
    // "answered_by" => null
    // "api_version" => "2010-04-01"
    // "forwarded_from" => null
    // "caller_name" => null
    // "uri" => "/api/laml/2010-04-01/Accounts/341c89fe-24f0-4265-8c1f-ba993b277d0c/Calls/1565933b-8939-47c5-8d85-4f4ef47c8f9f"
    // "subresource_uris" => array:2 [▼
    //   "notifications" => null
    //   "recordings" => "/api/laml/2010-04-01/Accounts/341c89fe-24f0-4265-8c1f-ba993b277d0c/Calls/1565933b-8939-47c5-8d85-4f4ef47c8f9f/Recordings"
    // ]
    // "annotation" => null
    // "group_sid" => null
    // "audio_in_mos" => "4.5"
    // "sip_result_code" => null
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('callhistories');
    }
};
