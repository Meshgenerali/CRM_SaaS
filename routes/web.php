<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Middleware\SelectBusiness;
use App\Livewire\Business\Roles;
use App\Livewire\Business\Invite;
use App\Livewire\Business\Subscriptions;
use Laravel\Jetstream\Role;

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
    })->name('dashboard')->middleware(SelectBusiness::class);


    Route::get('/roles', Roles::class)->name('business.roles');
    Route::get('/invites', Invite::class)->name('business.invites');
    Route::get('/subscriptions', Subscriptions::class)->name('business.subscriptions');
    Route::controller(LeadController::class)->group(function () {
        Route::get('leads', 'index')->name('leads.index');
        Route::get('leads/create', 'create')->name('leads.create');
        Route::post('leads/store', 'store')->name('leads.store');
        Route::post('leads/{lead}/show', 'show')->name('leads.show');
        Route::get('leads/{lead}/edit', 'edit')->name('leads.edit');
        Route::delete('leads/{lead}/destroy', 'destroy')->name('leads.destroy');
        Route::put('leads/{lead}/update', 'update')->name('leads.update');
    
    });

});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');



