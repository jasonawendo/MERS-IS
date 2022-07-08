<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/registration', function () {
    return view('registration');
});

Route::get('/user', function () {
    return view('user');
});

Route::get('/cart', function () {
    return view('cart');
});

//Index Equipment
use App\Http\Controllers\EquipmentlistingController; //Added
Route::get('/equipmentlistings', [EquipmentlistingController::class, 'index']);// Displays all equipment listings

//Show Equipment
Route::get('/equipmentlistings/{equipmentID}', [EquipmentlistingController::class, 'show']);// Displays Single equipment listing based on ID
