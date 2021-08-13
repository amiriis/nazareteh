<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Headqoarter\UserController as HeadquarterUsers;
use App\Http\Controllers\Headqoarter\RoleController as HeadquarterRoles;
use App\Http\Controllers\Questioner\DashboardController as QuestionerDashboard;

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

Route::prefix('headquarter')->name('headquarter.')->middleware(['role:Super Admin'])->group( function () {
    Route::get('/' , function () {
        return 'hello Super Admin';
    });
    Route::resource('users', HeadquarterUsers::class)->except(['show']);
    Route::resource('roles', HeadquarterRoles::class)->except(['show']);
});

Route::prefix('control-center')->name('controlcenter.')->middleware(['role:Expert'])->group( function () {
    Route::get('/' , function () {
        return 'hello Expert';
    });
});

Route::name('questioner.')->middleware(['role:Member'])->resource('/questioner', QuestionerDashboard::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
