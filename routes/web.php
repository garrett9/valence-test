<?php

use App\Http\Controllers\TestsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [TestsController::class, 'show']);
Route::post('tests/{test}/submit', [TestsController::class, 'submit'])->name('tests.submit');

Route::get('tests/{test}/results/{user}', [TestsController::class, 'results'])->name('tests.result');
