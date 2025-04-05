<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\FormController;

Route::get('/', function () {

        // Check if the session has 'code_verified' set
        if (!Session::has('code_verified') || !Session::get('code_verified')) {
            return redirect()->route('data.verify');
        }

        return view('welcome');
})->name('home');

Route::post('/submit-form', [FormController::class, 'store'])->name('form.submit');

Route::get('/client-data', [FormController::class, 'index'])->name('client.data.index');
Route::post('/approve-data', [FormController::class, 'approveData'])->name('data.approve');
Route::get('/approved-clients', [FormController::class, 'clients'])->name('data.approve');
Route::post('/delete-data', [FormController::class, 'deleteData']);
Route::get('/verify', [FormController::class, 'verifys'])->name('data.verify');
Route::delete('/delete-datax', [FormController::class, 'deleteDatax']);
Route::post('/verify-code', [FormController::class, 'verify'])->name('verify.code');
Route::get('/foo', function () {
    Artisan::call('storage:link');
});
