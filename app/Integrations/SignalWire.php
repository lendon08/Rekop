<?php

namespace App\Integrations;


use Exception;
use Illuminate\Support\Facades\Http;



class SignalWire
{
    //Goal: to be only use to update database
    //Current: used to display all the necessary values of the software
    public static function http(string $endpoint)
    {
        $url = 'https://' . env('SIGNALWIRE_SPACE_URL') . '' . $endpoint;

        $headers = [
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
        ];

        try {
            $response = Http::withHeaders($headers)
                ->withBasicAuth(env('SIGNALWIRE_PROJECTID'), env('SIGNALWIRE_TOKEN'))
                ->withOptions([
                    'verify' => true
                ])
                ->get($url);

            if ($response->failed()) {
                throw new Exception('SIGNAL WIRE ERROR: ' . $response->body());
            }
            return $response->json();
        } catch (\Exception $ex) {
            // throw new Exception('HTTP ERROR: ' . $ex->getMessage());
        }
    }



    public static function updateForwarding(string $endpoint, string $externalUrl){

        $url = 'https://' . env('SIGNALWIRE_SPACE_URL') . '' .$endpoint;

        $headers = [
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
            '--data-raw \'{"call_handler": "laml_webhooks","call_request_url": "'.$externalUrl.'"}',
        ];

        try {
            $response = Http::withHeaders($headers)
                ->withBasicAuth(env('SIGNALWIRE_PROJECTID'), env('SIGNALWIRE_TOKEN'))
                ->put($url,
                [ 
                    'call_handler' => "laml_webhooks",
                    'call_request_url' => $externalUrl
                ]
            );
            if ($response->failed()) {
                throw new Exception('SIGNAL WIRE ERROR: ' . $response->body());
            }
        } catch (\Exception $ex) {
           
            throw new Exception('HTTP ERROR: ' . $ex->getMessage());
        }
    }
}
