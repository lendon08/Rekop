<?php

use App\Http\Controllers\PhonenumberController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//fix routing
Route::middleware('auth')->group(function () {
    Route::get('dashboard', App\Http\Livewire\Pages\Dashboard::class)->name('dashboard');
    Route::get('companies', App\Http\Livewire\Pages\Companies\CompanyIndex::class)->name('companies');
    Route::get('phone-settings', App\Http\Livewire\Pages\PhoneTrackings\PhoneTrackingIndex::class)->name('phone-settings');

    Route::get('phone-trackings-seed', [PhonenumberController::class, 'seedPhoneNunber']);
    
    // Route::get('phone-trackings/{company}/reports', App\Http\Livewire\Pages\PhoneTrackings\PhoneTrackingReport::class)->name('report-phone-trackings');
    Route::get('call-histories', App\Http\Livewire\Pages\PhoneNumbers\CallHistory::class)->name('call-histories');
});
//still need more work to create invoice
Route::get('call-histories/{company}/reports', App\Http\Livewire\Pages\PhoneNumbers\CallHistoryReport::class, function (Request $request) {
    if (!$request->hasValidSignature()) {
        abort(401);
    }
})->name('call-history-reports');



require __DIR__ . '/auth.php';
