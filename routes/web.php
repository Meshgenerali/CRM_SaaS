<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\InvitesController;
use App\Http\Middleware\SelectBusiness;
use App\Livewire\Business\Roles;
use App\Livewire\Business\Invite;
use App\Livewire\Business\Subscriptions;
use App\Livewire\Business\Users;
use Laravel\Jetstream\Role;
use App\Livewire\Notifications;

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


    Route::get('/roles', Roles::class)->name('business.roles')->can('view roles');
    Route::get('/users', Users::class)->name('business.users')->can('view users');
    Route::get('/invites', Invite::class)->name('business.invites')->can('invite users');
    Route::get('/subscriptions', Subscriptions::class)->name('business.subscriptions')->can('manage subscriptions');
    Route::get('/notifications', Notifications::class)->name('notifications');
    Route::post('/mpesa/callback', [PaymentController::class, 'mpesaCallback'])->name('mpesa.callback');


    Route::controller(LeadController::class)->group(function () {
        Route::get('leads', 'index')->name('leads.index');
        Route::get('leads/create', 'create')->name('leads.create');
        Route::get('leads/imports/uploads', 'leads_upload')->name('leads.upload');
        Route::post('leads/import', 'leads_import')->name('leads.import')->middleware('check.business');
        Route::get('leads/export', 'leads_export')->name('leads.export');
        Route::post('leads/store', 'store')->name('leads.store');
        Route::post('leads/{lead}/show', 'show')->name('leads.show');
        Route::get('leads/{lead}/edit', 'edit')->name('leads.edit');
        Route::delete('leads/{lead}/destroy', 'destroy')->name('leads.destroy');
        Route::put('leads/{lead}/update', 'update')->name('leads.update');
        Route::get('leads/{lead}/contact', 'contact')->name('leads.contact');
        Route::post('leads/{lead}/sendemail', 'sendemail')->name('leads.sendemail')->middleware('check.business');
        Route::post('lead/analyze', 'analyze')->name('lead.analyze')->middleware('check.business');
    });

});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::controller(InvitesController::class)->group(function () {
    Route::get('accept/invite/{token}', 'accept')->name('invite.accept');
    Route::post('invite/register', 'register')->name('invite.register');
});





