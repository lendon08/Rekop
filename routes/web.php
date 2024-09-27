<?php


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


Route::middleware('auth')->group(function () {
    Route::get('dashboard', App\Livewire\Pages\Dashboard::class)->name('dashboard');
    Route::get('companies', App\Livewire\Pages\Companies\CompanyIndex::class)->name('companies');
    Route::get('settings/create-number', App\Livewire\Pages\Settings\CreateNumber\CreateNumberIndex::class)->name('wizard');



    // Route::get('phone-trackings/{company}/reports', App\Livewire\Pages\PhoneTrackings\PhoneTrackingReport::class)->name('report-phone-trackings');
    Route::get('call-histories', App\Livewire\Pages\PhoneNumbers\CallHistory::class)->name('call-histories');

    Route::get('phone-settings', App\Livewire\Pages\PhoneTrackings\PhoneTrackingIndex::class)->name('phone-settings');
    Route::get('phone-settings/add-schedule/{id}', App\Livewire\Pages\PhoneTrackings\AddSchedule::class)->name('add-schedule');
    Route::get('phone-settings/edit-schedule/{id}', App\Livewire\Pages\PhoneTrackings\EditSchedule::class)->name('edit-schedule');

    // Route::get('phone-settings/buy-number', App\Livewire\Pages\PhoneTrackings\AddPhonenumber::class)->name('buy-phone-number');


});
//still need more work to create invoice
Route::get('call-histories/reports/{calls}', App\Livewire\Pages\PhoneNumbers\CallHistoryReport::class, function (Request $request) {
    if (!$request->hasValidSignature()) {
        abort(401);
    }
})->name('call-history-reports');




require __DIR__ . '/auth.php';
