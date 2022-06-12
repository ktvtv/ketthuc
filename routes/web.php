<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;


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



Route::get('/mainpage',[PageController::class,'mainpage']);

Route::get('/login',[PageController::class,'LoginController'])->name('login');
// Route::post('/login', [PageController::class, 'customLogin'])->name('Custom.Login')->middleware('checklogin::class');
Route::post('/login', [PageController::class, 'customLogin'])->name('Custom.Login');

Route::get('/Register',[PageController::class,'RegisterController'])->name('register');
Route::post('/Register',[PageController::class,'customRegistration'])->name('custom.Register');


Route::get('/cart',[PageController::class,'cart']);
Route::get('/wishlist',[PageController::class,'wishlist']);
Route::get('/shop',[PageController::class,'shop']);

Route::get('signout', [PageController::class, 'signOut'])->name('signout');

