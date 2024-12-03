<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Phonetracking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    /**
     * Create a Dynamic Number Insertion js to be use by the each company
     * Note to self: 1 company will have 1 js that will have mutliple numbers
     */
    public $jsContent;

    public function createJavaScriptFile()
    {
        $user = Auth::user()->load('company'); //Eager load all details in user

        $phoneNumbers = $user->company->phoneNumbers;


        $data = [];

        $this->jsContent = "document.addEventListener('DOMContentLoaded', function () { const numberPools = [";

        foreach ($phoneNumbers as $phoneNumber) {
            $phonetracking = Phonetracking::select(
                'phonenumber_id',
                'search_engine as searchEngine',
                'URL as url',
                'traffic',
                'swaptarget as swapTargets',
                'tracking_options as trackingSource'
            )
                ->where('phonenumber_id', $phoneNumber->id)
                ->first();



            $numbers = $phonetracking->phonenumber->getAttributes()['number'] ?? [];
            $numbers = preg_replace('/\D/', '', $numbers);
            $this->jsContent .= "{";
            $this->jsContent .= "trackingSource: '" . addslashes($phonetracking->trackingSource) . "',";
            $this->jsContent .= "swapTargets: '" . addslashes($phonetracking->swapTargets) . "',";
            $this->jsContent .= "numbers: [" . json_encode($numbers) . "],";
            $this->jsContent .= "url: '" . addslashes($phonetracking->url) . "',";
            $this->jsContent .= "searchEngine: " . ($phonetracking->searchEngine ? "'" . addslashes($phonetracking->searchEngine) . "'" : "null") . ",";
            $this->jsContent .= "traffic: " . ($phonetracking->traffic ? "'" . addslashes($phonetracking->traffic) . "'" : "null") . ",";
            $this->jsContent .= "},";
        }


        $this->jsContent .= "]; async function fetchAndCachePhoneNumberStatus(phoneNumber) {

        const cachedStatus = sessionStorage.getItem(
             `phoneStatus_\${phoneNumber}`
        );
        if (cachedStatus) {
            return cachedStatus;
        }

        try {
            const response = await fetch(
                \"https://rekop.test/api/test-phone-number?phoneNumber=\${phoneNumber}\"
            );

            if (!response.ok) {
                throw new Error(`HTTP error! status: \${response . status}`);
            }

            const data = await response.json();
            const phoneStatus = data.phoneStatus;

            sessionStorage.setItem(`phoneStatus_\${phoneNumber}`, phoneStatus);
            return phoneStatus;
        } catch (error) {
            console.error('Error fetching phone number status:', error);
            return 'error';
        }
    }


    async function determinePhoneNumber() {
        const urlParams = new URLSearchParams(window.location.search);
        const source = urlParams.get('utm_source');
        const medium = urlParams.get('utm_medium') || 'organic';
        const currentUrl = window.location.href;


        const pool = numberPools.find((item) => {
            return (
                (item.trackingSource === 'Landing Page' &&
                    currentUrl.includes(item.url)) ||
                (item.trackingSource === 'Search' &&
                    item.searchEngine === source &&
                    (item.traffic === medium || item.traffic === 'all')) ||
                item.trackingSource === 'All Visitors'
            );
        });


        if (pool) {
            for (const candidateNumber of pool.numbers) {
                const status = await fetchAndCachePhoneNumberStatus(
                    candidateNumber
                );
                if (status === 'available') {
                    return candidateNumber;
                }
            }
        }

        return null;
    }


    async function updateDynamicPhoneNumbers() {
        const dynamicPhoneNumber = await determinePhoneNumber();
        if (dynamicPhoneNumber !== null) {

            document.querySelectorAll('.dynamic-number').forEach((element) => {
                const originalFormat = element.textContent;
                const formattedNumber = formatPhoneNumber(
                    originalFormat,
                    dynamicPhoneNumber
                );

                element.textContent = formattedNumber;
                element.setAttribute('href', `tel:\${dynamicPhoneNumber}`);
            });
        } else {
            console.warn(
                'No available phone number found for the current configuration.'
            );
        }
    }


    function formatPhoneNumber(originalFormat, newNumber) {

        const numberWithoutCountryCode = newNumber.substring(1);


        const newDigits = numberWithoutCountryCode.split('');


        let digitIndex = 0;
        const formattedNumber = originalFormat.replace(/\d/g, () => {
            return newDigits[digitIndex++] || '';
        });


        return formattedNumber;
    }


    function startPhoneNumberUpdateSchedule() {
        updateDynamicPhoneNumbers();
        setInterval(() => {
            updateDynamicPhoneNumbers();
        }, 30 * 60 * 1000);
    }

    let isTrafficDataSending = false;
 async function sendTrafficData() {
        if (isTrafficDataSending) return;
        isTrafficDataSending = true;
        const urlParams = new URLSearchParams(window.location.search);
        const csrfToken =
            document.querySelector(\"meta[name='csrf-token']\")?.content || null;
        const trafficData = {
            source: getTrafficSource(),
            medium: urlParams.get('utm_medium') || 'unknown',
            campaign: urlParams.get('utm_campaign') || 'unknown',
            term: urlParams.get('utm_term') || 'unknown',
            content: urlParams.get('utm_content') || 'unknown',
            url: window.location.host,
            referrer: document.referrer || 'unknown',
        };

        const headers = {
            'Content-Type': 'application/json',
            Accept: 'application/json',
        };
        if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;

        const response = await fetch('https://rekop.test/api/traffic-source', {
            method: 'POST',
            headers: headers,
            body: JSON.stringify(trafficData),
        })
            .then(async (response) => {
                if (!response.ok) {
                    const error = await response.json();
                    console.error('Validation error:', error);
                    return;
                }

                const data = await response.json();
                console.log('Response:', data);
                isTrafficDataSending = false;
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }


    function getTrafficSource() {
        return (
            new URLSearchParams(window.location.search).get('utm_source') ||
            'organic'
        );
    }

    function getLocalData(key) {
        return localStorage.getItem(key);
    }

    function setLocalData(key, value) {
        localStorage.setItem(key, value);
    }

    function createLocalData() {
        const data = getLocalData('isoncall');
        if (!data) {
            setLocalData('isoncall', 'done');
        }
        return data;
    }

    if (!createLocalData()) {
        sendTrafficData();
    }


    startPhoneNumberUpdateSchedule();
});

";
        $this->jsContent = preg_replace('/\s+/', ' ', $this->jsContent);
        $this->jsContent = str_replace(["\r", "\n"], '', $this->jsContent);
        $this->jsContent = rtrim($this->jsContent, ',');

        // dd($this->jsContent);
        $path = "js/{$user->company->id}/swap.js";

        Storage::disk('public')->put($path, $this->jsContent);
    }
}
