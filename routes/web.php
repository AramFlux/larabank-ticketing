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

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\TransactionsController;

Route::get('/', function () {
    return redirect('/accounts');
});

Route::middleware('auth')->group(function () {
    Route::resource('accounts', AccountsController::class);
    Route::resource('events', EventsController::class);
    Route::get('transactions', [TransactionsController::class, 'index']);

    Route::middleware('eventPermission')->group(function () {
        Route::post('events/{eventId}/ticketTypes', 'App\Http\Controllers\TicketTypesController@create')->name('ticketTypes.create');
        Route::get('events/{eventId}/ticketType/{ticketTypeId}', 'App\Http\Controllers\TicketTypesController@get')->name('ticketType.get');
        Route::put('events/{eventId}/ticketType/{ticketTypeId}', 'App\Http\Controllers\TicketTypesController@update')->name('ticketTypes.update');
        Route::post('events/{eventId}/ticketType/{ticketTypeId}/buy', 'App\Http\Controllers\TicketTypesController@buy')->name('ticketTypes.buy');
        Route::post('events/{eventId}/ticket/{ticketId}/pay', 'App\Http\Controllers\TicketsController@pay')->name('ticket.pay');
        Route::post('events/{eventId}/ticket/{ticketId}/refund', 'App\Http\Controllers\TicketsController@refund')->name('ticket.refund');
    });
});
