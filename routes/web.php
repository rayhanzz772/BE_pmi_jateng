<?php
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DataController;

use Illuminate\Support\Facades\Route;


Route::get('/home', [DataController::class, 'index']);
Route::post('/checkout', [DataController::class, 'store']);

Route::post('/midtrans-token', [PaymentController::class, 'getSnapToken']);