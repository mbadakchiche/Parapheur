<?php

use App\Http\Controllers\CirculationController;
use App\Http\Controllers\searchableMailController;
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
    return redirect(route('login'));
});

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes(['register'=>false]);

Route::resource('administration/users', App\Http\Controllers\UserController::class);


Route::resource('administration/actions', App\Http\Controllers\ActionController::class);


Route::resource('administration/services', App\Http\Controllers\ServiceController::class);


Route::resource('administration/registers', App\Http\Controllers\RegisterController::class);

Route::get('circulation/record/{id}', action: [CirculationController::class, 'recordInRegister'])->name('circulation.record');

Route::patch('circulation/record/{id}', action: [CirculationController::class, 'storeRecorded'])->name('circulation.record.store');

Route::get('circulation/send/{id}', action: [CirculationController::class, 'send'])->name('circulation.send');

Route::patch('circulation/send/{id}', action: [CirculationController::class, 'storeSended'])->name('circulation.send.store');

Route::get('circulation/SendProcessing/{id}', action: [CirculationController::class, 'SendProcessing'])->name('circulation.SendProcessing');

Route::patch('circulation/SendProcessing/{id}', action: [CirculationController::class, 'storeSendProcessing'])->name('circulation.SendProcessing.store');

Route::get('circulation/processing/{id}', action: [CirculationController::class, 'processing'])->name('circulation.processing');

Route::patch('circulation/processing/{id}', action: [CirculationController::class, 'storeProcessing'])->name('circulation.processing.store');

Route::get('circulation/attach/{id}', action: [CirculationController::class, 'attach'])->name('mails.attach');

Route::patch('circulation/attach/{id}', action: [CirculationController::class, 'updateAttach'])->name('circulation.attach.store');
/**
 * Get arrived mails
 */
Route::get('mails/arrived', action: [searchableMailController::class, 'index'])->name('mails.search.arrived');


/**
 * Get Income mails
 */
Route::get('mails/income', action: [searchableMailController::class, 'income'])->name('mails.search.income');
/**
 * Get processed  mails with the aim to dispatch
 */
Route::get('mails/needDispatch', action: [searchableMailController::class, 'needDispatch'])->name('mails.search.needdispatch');
/**
 * Get needsProcessing mails
 */
Route::get('mails/needProcess', action: [searchableMailController::class, 'needprocess'])->name('mails.search.needprocess');
/**
 * Get Outcomes mails
 */
Route::get('mails/outcome', action: [searchableMailController::class, 'outcome'])->name('mails.search.outcome');




Route::resource('mails', App\Http\Controllers\MailController::class);

Route::resource('dossiers', App\Http\Controllers\DossierController::class);

Route::resource('etablissements', App\Http\Controllers\EtablissementController::class);

Route::resource('parafeures', App\Http\Controllers\ParafeureController::class);