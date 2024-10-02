<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\phone_tracking;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    /**
     * Create a Dynamic Number Insertion js to be use by the each company
     * Note to self: 1 company will have 1 js that will have mutliple numbers
     */
    public function createJavaScriptFile()
    {
        $user = Auth::user()->load('company.phoneNumbers'); //Eager load all details in user
        $phoneNumbers = $user->company->phoneNumbers;


        $data = [];

        $jsContent = "(function (numberPairs) {'use strict'; const phoneRegex = /(\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4})/g; const replaceDigits = (match, newDigits) => {let digitIndex = 0;return match.replace(/\d/g, () => newDigits[digitIndex++]);}; function traverseAndReplace(node) { if (node.nodeType === Node.TEXT_NODE) { node.textContent = node.textContent.replace(phoneRegex, (match) => { const matchDigits = match.replace(/\D/g, ''); for (let [original, newNumber] of numberPairs) { const originalDigits = original.replace(/\D/g, ''); const newDigits = newNumber.replace(/\D/g, ''); if (matchDigits === originalDigits) { return replaceDigits(match, newDigits); }} return match; });} else { for (let child of node.childNodes) { traverseAndReplace(child);}}} traverseAndReplace(document.body);})([";
        foreach ($phoneNumbers as $phoneNumber) {
            $data[] = phone_tracking::where('phonenumbers_id', $phoneNumber->id)->pluck('swaptarget')[0];
            $data[] = $phoneNumber->number;
            $jsContent .= "['" . implode("','", $data) . "'],";
            $data = [];
        }

        $jsContent .= "]);";

        $path = "js/{$user->company->id}/swap.js";

        Storage::disk('public')->put($path, $jsContent);
        return redirect('dashboard');
    }
}
