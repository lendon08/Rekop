<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Integrations\SignalWire;
use Illuminate\Http\Request;
use SignalWire\LaML;
use SignalWire\Rest\Client;


class CallController extends Controller
{

    public function dialCall()
    {
        // project ID, token
        $client = new Client(env('SIGNALWIRE_PROJECTID'), env('SIGNALWIRE_TOKEN'), ['signalwireSpaceUrl' => env('SIGNALWIRE_SPACE_URL')]);

        // Dynamic variable for tracking number name
        $trackingNumberName = "John Doe"; // Example name for the tracking number

        // Validate tracking number name
        if (empty($trackingNumberName) || !is_string($trackingNumberName)) {
            $trackingNumberName = "Unknown Caller"; // Fallback name
        }

        // Generate SWML with the whisper message dynamically
        $swml = <<<YAML
version: 1.0.0
sections:
  main:
    - answer: {}
    - execute:
        dest: play_message
  play_message:
    - say:
        text: "This call is being forwarded and recorded for quality purposes."
    - execute:
        dest: forward_call
  forward_call:
    - dial:
        target: "+13464604501"
        record:
          direction: "both"
          trim: "do-not-trim"
          dual_channel: true
        whisper:
          tts:
            text: "This call is from $trackingNumberName."
    - say:
        text: |
          All this is suppose to be an AI, lucky I can record this and play it back. Hope it ends up well.
          Thank you for staying with this recording.
          Thank you! Goodbye. See you.
YAML;

        // Fallback SWML in case the primary fails
        $fallbackSwml = <<<YAML
version: 1.0.0
sections:
  main:
    - answer: {}
    - say:
        text: "We encountered an issue. Please try your call again later. Goodbye."
YAML;
        // +19413375538 //caller
        // +19413243994 //tracker
        // +13464604501 //business

        // Place the call
        $call = $client->calls->create(
            '+19413243994', // tracking
            '+19413375538', // caller
            [
                'twiml' => $swml // Primary SWML
            ]
        );

        echo "Call SID: " . $call->sid;
        // } catch (\Exception $e) {
        //     // Log the error for debugging
        //     error_log("Call failed: " . $e->getMessage());

        //     // Attempt fallback SWML
        //     try {
        //         // $fallbackCall = $client->calls->create(
        //         //     '+19413243994', // tracking
        //         //     '+19413375538', // caller
        //         //     [
        //         //         'twiml' => $fallbackSwml // Fallback SWML
        //         //     ]
        //         // );
        //         // echo "Fallback Call SID: " . $fallbackCall->sid;
        //         echo "Goes to fallback";
        //     } catch (\Exception $fallbackException) {
        //         // Log the fallback failure
        //         error_log("Fallback call failed: " . $fallbackException->getMessage());
        //         echo "Both primary and fallback calls failed.";
        //     }
        // }
    }

    public function forwardCall(Request $request)
    {
        $response = new LaML();

        // Message to the caller before forwarding
        $response->say("Thank you for calling. Please hold while we connect you.");

        // Number to forward the call to
        $forwardToNumber = '+1234567890';

        // Forward the call with a short message to the receiver
        $dial = $response->dial([
            'callerId' => $request->input('From'),
            'record' => 'record-from-answer'
        ]);

        // Message to play to the recipient before they are connected
        $dial->number($forwardToNumber, ['url' => url('/play-message')]);

        return response($response)->header('Content-Type', 'text/xml');
    }

    // Separate function for the message to the recipient
    public function playMessage()
    {
        $response = new LaML();
        $response->say("This call is being forwarded from another number.");

        return response($response)->header('Content-Type', 'text/xml');
    }

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
