<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckToken;
Route::get('/', function () {
    $locations = App\Models\centers::get()->all();
    return view('form',['locations' => $locations]);
});

Route::post('/submit-ticket', [App\Http\Controllers\EmployeeController::class, 'SubmitTicket'])->name('submit.ticket')->middleware(CheckToken::class);
