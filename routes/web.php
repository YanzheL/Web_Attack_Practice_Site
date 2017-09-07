<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/SHRmMFA1UkpZcnZsTU1hWUNcL1N3PT0iLCJ2YWx1ZSI6', 'HomeController@index')->name('home');

Route::get('message', function () {
    return view('message');
});

Route::get('login', function () {
    return view('fakelogin');
})->name('fakelogin');

Route::get('search', function () {
    return view('search');
})->name('search');

Route::post('search', 'FrontCtl@processor');

Route::post('upload', 'UploadCtl@processor');

Route::post('templateview', 'TemplateCtl@processor');
