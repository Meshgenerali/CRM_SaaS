<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::controller(LeadController::class)->group(function () {
    Route::get('leads', 'index')->name('leads.index');
    Route::get('leads/create', 'create')->name('leads.create');
    Route::post('leads/store', 'store')->name('leads.store');
    Route::post('leads/{lead}/show', 'show')->name('leads.show');
    Route::get('leads/{lead}/edit', 'edit')->name('leads.edit');
    Route::delete('leads/{lead}/destroy', 'destroy')->name('leads.destroy');
    Route::put('leads/{lead}/update', 'update')->name('leads.update');

});

