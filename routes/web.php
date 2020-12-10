<?php

use App\Http\Controllers\ActionLogController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Redirect;
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
  return Redirect::to('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
  return view('dashboard');
})->name('dashboard');

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
  Route::get('users', [UsersController::class, 'index'])->name('users');
  Route::get('domains', [DomainController::class, 'index'])->name('domains');
  Route::post('domains', [DomainController::class, 'store'])->name('domains');
  Route::get('action-logs', [ActionLogController::class, 'index'])->name('action-logs');
});
