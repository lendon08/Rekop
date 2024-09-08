<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Integrations\SignalWire;
use Illuminate\Support\Facades\DB;

class PhonenumberController extends Controller
{
    public function updatePhoneNumber(){
        return;
    }

    public function seedPhoneNunber(){
        $phoneNumbers = SignalWire::http('/api/relay/rest/phone_numbers');

        foreach($phoneNumbers['data'] as $value){
            extract($value);
                DB::insert('insert into phonenumbers (id, name, number, call_handler, call_request_url, message_handler, message_request_url)
                values (?,?,?,?,?,?,?)',
                [
                    $id,
                    $name,
                    $number,
                    $call_handler,
                    $call_request_url,
                    $message_handler,
                    $message_request_url
                ]);
        }
        return to_route('dashboard');
    }
}
