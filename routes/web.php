<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

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

// Route::redirect('/', 'http://richardot.fr');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/auteurs', [AuthorController::class, 'welcome'])->name('auteurs');
Route::get('/auteurs/{a}', [AuthorController::class, 'page']);
Route::get('/auteurs/index/{a}', [AuthorController::class, 'index']);
Route::get('/auteurs/pays/{a}', [AuthorController::class, 'pays']);

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
Route::get('/annonces', function () {
    return view('annonces');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        if (Auth::user()->role == 'user') {
            return Redirect::route('welcome');
        }
        else {
            return view('dashboard');
        }
    })->name('dashboard');
});
