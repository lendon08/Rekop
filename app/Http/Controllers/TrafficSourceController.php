<?php

namespace App\Http\Controllers;

use App\Integrations\SignalWire;
use Illuminate\Http\Request;
use App\Models\Traffic;


class TrafficSourceController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'source' => 'required|string|max:255',
            'url' => 'required',
            'medium' => 'required',
            'campaign' => 'required',
            'term' => 'required',
            'content' => 'required',
            'referrer' => 'nullable|url',
        ]);

        // Store the data in the database
        Traffic::create($validatedData);

        // Return a JSON response
        return response()->json([
            'message' => 'Traffic source data stored successfully',
            'status' => 'success',
        ]);
    }
    public function checkPhoneNumber(Request $request)
    {

        // You can validate the parameters if needed
        $request->validate([
            'phoneNumber' => 'required|string'
        ]);

        $data = [];
        $phoneNumber = $request->query('phoneNumber'); // Gets the value of 'param1'

        $data = SignalWire::http('/api/laml/2010-04-01/Accounts/' . env('SIGNALWIRE_PROJECTID') . '/Calls?To=' . $phoneNumber);

        if (!empty($data['calls'])) {
            // Extract the first call's status
            $firstCallStatus = $data['calls'][0]['status'];

            // Define the statuses that indicate the number is callable
            $callableStatuses = ['completed', 'failed', 'canceled', 'no-answer'];

            // Check if the first call's status is in the callable statuses
            if (in_array($firstCallStatus, $callableStatuses)) {

                return response()->json([
                    'status' => 'success',
                    'message' => 'The number is callable.',
                    'phoneStatus' => 'available',
                ]);
            } else {
                return response()->json([
                    'status' => 'success',
                    'message' => 'The number is callable.',
                    'phoneStatus' => 'unavailable',
                ]);
            }
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'The number is callable.',
                'phoneStatus' => 'available',
            ]);
        }
    }
}
