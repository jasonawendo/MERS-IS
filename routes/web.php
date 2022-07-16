<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

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
    return view('home');
});


/*Route::get('/login.blade.php', function () {
    return view('login.blade.php');
});

Route::get('/register.blade.php', function () {
    return view('register.blade.php');
});*/

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


#Route for user role based login
Route::get('/redirect', [HomeController::class,'redirect']);