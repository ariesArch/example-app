<?php

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunityCategoryController;
use Filament\FilamentManager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/community_categories', CommunityCategoryController::class)->name('*', 'community_categories');
