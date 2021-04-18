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

Route::get('/legacy', function () {
    return view('legacy');
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/auteurs', function () {
    return view('auteurs');
});
Route::get('/textes', function () {
    return view('textes');
});
Route::get('/ouvrages', function () {
    return view('ouvrages');
});
Route::get('/series', function () {
    return view('series');
});
Route::get('/collections', function () {
    return view('collections');
});
Route::get('/editeurs', function () {
    return view('editeurs');
});
Route::get('/prix', function () {
    return view('prix');
});
Route::get('/festivals', function () {
    return view('festivals');
});
Route::get('/forums', function () {
    return view('forums');
});
Route::get('/annonces', function () {
    return view('annonces');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
