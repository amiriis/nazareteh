<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Headqoarter\UserController as HeadquarterUsers;
use App\Http\Controllers\Headqoarter\RoleController as HeadquarterRoles;
use App\Http\Controllers\Questioner\DashboardController as QuestionerDashboard;
use App\Http\Controllers\Questioner\SheetController as QuestionerSheets;
use App\Http\Controllers\Responder\SheetController as ResponderSheets;
use Illuminate\Support\Facades\Auth;

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
})->name('welcome');

Route::prefix('headquarter')->name('headquarter.')->middleware(['role:Super Admin'])->group(function () {
    Route::get('/', function () {
        return 'hello Super Admin';
    });
    Route::resource('users', HeadquarterUsers::class)->except(['show']);
    Route::resource('roles', HeadquarterRoles::class)->except(['show']);
});

Route::prefix('control-center')->name('controlcenter.')->middleware(['role:Expert'])->group(function () {
    Route::get('/', function () {
        return 'hello Expert';
    });
});

Route::prefix('questioner')->name('questioner.')->middleware(['role:Member'])->group(function () {
    Route::get('/', [
        QuestionerDashboard::class,
        'index'
    ]);
    Route::resource('sheets', QuestionerSheets::class)->except(['show']);
    Route::match(['put', 'patch'], 'sheets/{sheet}/start', [QuestionerSheets::class, 'start'])->name('sheets.start');
    Route::match(['put', 'patch'], 'sheets/{sheet}/end', [QuestionerSheets::class, 'end'])->name('sheets.end');
    Route::get('sheets/{sheet}/report', [QuestionerSheets::class, 'report'])->name('sheets.report');
    Route::get('sheets/{sheet}/report/responder/{responder}', [QuestionerSheets::class, 'reportResponder'])->name('sheets.report.responder');
    Route::get('sheets/{sheet}/report/question/{question}', [QuestionerSheets::class, 'reportQuestion'])->name('sheets.report.question');
});

Route::prefix('r')->name('reponder.')->group(function () {
    Route::get('{sheet:token}', [ResponderSheets::class, 'index'])->name('index');
    Route::get('{sheet:token}/thanks', [ResponderSheets::class, 'thanks'])->name('thanks');
    Route::post('{sheet:token}', [ResponderSheets::class, 'login'])->name('login');
    Route::get('{sheet:token}/{responder:token}', [ResponderSheets::class, 'show'])->name('show');
    Route::post('{sheet:token}/{responder:token}', [ResponderSheets::class, 'store'])->name('store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
