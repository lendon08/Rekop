

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function createJavaScriptFile(): never
    {

        $jsContent = "(function (original, newNumber) {'use strict';const startTime = performance.now();const originalDigits = original.replace(/\D/g, '');const newDigits = newNumber.replace(/\D/g, '');const phoneRegex = /(\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4})/g;const replaceDigits = (match) => {let digitIndex = 0;return match.replace(/\d/g, () => newDigits[digitIndex++]);};function traverseAndReplace(node) {if (node.nodeType === Node.TEXT_NODE) {node.textContent = node.textContent.replace(phoneRegex, (match) => {const matchDigits = match.replace(/\D/g, '');if (matchDigits === originalDigits) {return replaceDigits(match); }return match; });} else {for (let child of node.childNodes) {traverseAndReplace(child);}}}traverseAndReplace(document.body);})('1112223333', '4445556666'); 
        ";


        $path = 'js/swap.js'; // stored in storage/app/js/generated-script.js

        // Save the file using the Storage facade
        Storage::disk('public')->put($path, $jsContent);
        dd("done");
        // return response()->json(['message' => 'JavaScript file created successfully!', 'path' => $path]);
    }
}
