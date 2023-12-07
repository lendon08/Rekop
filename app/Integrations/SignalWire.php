<?php

namespace App\Integrations;

use App\Models\Company;
use Exception;
use Illuminate\Support\Facades\Http;



class SignalWire
{
    //
    public static function http(?Company $company, string $endpoint, string $method = 'GET', array $postData = [])
    {
        if (!isset($company->id)) {
            return ['data' => [], 'message' => 'No company found'];
        }

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
}
