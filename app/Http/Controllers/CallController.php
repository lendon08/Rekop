<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Integrations\SignalWire;
use Illuminate\Http\Request;

class CallController extends Controller
{

    public function checkCallStatus(Request $request)
    {
        $request->validate([
            'number' => 'required|string',
        ]);

        $number = $request->input('number');
        $isInCall = SignalWire::isNumberInCall($number);

        if (is_null($isInCall)) {
            return response()->json(['error' => 'Failed to check call status'], 500);
        }

        return response()->json([
            'number' => $number,
            'in_call' => $isInCall,
        ]);
    }
}
