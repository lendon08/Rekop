<?php

namespace App\Http\Controllers;

use App\Integrations\SignalWire;
use Illuminate\Http\Request;
use App\Models\TrafficSource;


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
        TrafficSource::create($validatedData);

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

        if (empty($data['calls'])) {
            return response()->json(['status' => 'success', 'message' => 'The number is callable.', 'phoneStatus' => 'available',]);
        } else if ($data['calls'][0]['status'] === "completed" || $data['calls'][0]['status'] === "failed" || $data['calls'][0]['status'] === "canceled" || $data['calls'][0]['status'] === "no-answer") {
            return response()->json(['status' => 'success', 'message' => 'The number is callable1.', 'phoneStatus' => 'available',]);
        } else {
            return response()->json(['status' => 'success', 'message' => 'The number is callable1.', 'phoneStatus' => 'unavailable',]);
        }
    }
}
