<?php

use App\Http\Controllers\UrlShortenerController;
use Illuminate\Support\Facades\Auth;
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
    return view('urlshortner');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('url')->name('url.')->group(function(){
    Route::post('/shorten',[UrlShortenerController::class, 'store']);
    Route::get('/u/{any}' , [UrlShortenerController::class, 'handle']);
    Route::get('/getUrl' , [UrlShortenerController::class, 'getUrl']);
    Route::get('/page' , function() {
        return view('urls');
    });
});