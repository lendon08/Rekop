<?php

namespace App\Integrations;


use Exception;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class SignalWire
{
    //Goal: to be only use to update database
    //Current: used to display all the necessary values of the software
    public static function http(string $endpoint)
    {
        $url = 'https://' . env('SIGNALWIRE_SPACE_URL') . '' . $endpoint;

        try {
            $response = Http::asForm()
                ->withBasicAuth(env('SIGNALWIRE_PROJECTID'), env('SIGNALWIRE_TOKEN'))
                ->withToken(env('SIGNALWIRE_TOKEN'))
                ->get($url);

            if ($response->failed()) {
                throw new Exception('SIGNAL WIRE ERROR: ' . $response->body());
            }
            return $response->json();
        } catch (\Exception $ex) {
            throw new Exception('HTTP ERROR: ' . $ex->getMessage());
        }
    }

    public static function purchasePhoneNumber($number)
    {
        $url = 'https://' . env('SIGNALWIRE_SPACE_URL') . '' . '/api/relay/rest/phone_numbers';

        try {

            $response = Http::withBasicAuth(env('SIGNALWIRE_PROJECTID'), env('SIGNALWIRE_TOKEN'))
                ->withToken(env('SIGNALWIRE_AUTH_TOKEN'))
                ->post($url, [
                    'number' => $number
                ]);

            if ($response->failed()) {
                throw new Exception('SIGNAL WIRE ERROR: ' . $response->body());
            }
            return $response->json();
        } catch (\Exception $ex) {
            throw new Exception('HTTP ERROR: ' . $ex->getMessage());
        }
    }

    // $client->sendAsync($request)->wait(); // TO TRY next time
    //Search Number using Areacode
    public static function searchNumber(int $number)
    {
        $url = 'https://' . env('SIGNALWIRE_SPACE_URL') . '' . '/api/laml/2010-04-01/Accounts/' . env('SIGNALWIRE_PROJECTID') . '/AvailablePhoneNumbers/us/Local??';

        try {
            $response = Http::asForm()
                ->withBasicAuth(env('SIGNALWIRE_PROJECTID'), env('SIGNALWIRE_TOKEN'))
                ->withToken(env('SIGNALWIRE_TOKEN'))
                ->get(
                    $url,
                    [
                        'AreaCode' => $number
                    ]
                );

            if ($response->failed()) {
                throw new Exception('SIGNAL WIRE ERROR: ' . $response->body());
            }
            return $response->json();
        } catch (\Exception $ex) {
            throw new Exception('HTTP ERROR: ' . $ex->getMessage());
        }
    }

    public static function updateForwarding(string $endpoint, string $externalUrl)
    {

        $url = 'https://' . env('SIGNALWIRE_SPACE_URL') . '' . $endpoint;
        // $externalUrl = 'https://'.env('SIGNALWIRE_SPACE_URL').'/laml-bins/'.$externalUrl;
        try {
            $response = Http::asForm()
                ->withBasicAuth(env('SIGNALWIRE_PROJECTID'), env('SIGNALWIRE_TOKEN'))
                ->put(
                    $url,
                    [
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
