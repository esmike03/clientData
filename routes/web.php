<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/submit-form', [FormController::class, 'store'])->name('form.submit');

Route::get('/client-data', [FormController::class, 'index'])->name('client.data.index');
Route::post('/approve-data', [FormController::class, 'approveData'])->name('data.approve');
Route::get('/approved-clients', [FormController::class, 'clients'])->name('data.approve');
Route::post('/delete-data', [FormController::class, 'deleteData']);

Route::delete('/delete-datax', [FormController::class, 'deleteDatax']);

Route::get('/foo', function () {
    Artisan::call('storage:link');
});
