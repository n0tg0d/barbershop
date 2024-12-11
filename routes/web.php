<?php

use App\Livewire\DataCard;
use App\Livewire\BarberPage;
use App\Livewire\ServicesPage;
use App\Livewire\Pages\ShowHome;
use App\Livewire\AppointmentPage;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\ShowAbout;
use App\Livewire\Pages\ShowContact;
use App\Livewire\Pages\ShowServices;



// Public Routes
Route::get('/', ShowHome::class)->name('home');
Route::get('/service', ShowServices::class)->name('service');
Route::get('/about', ShowAbout::class)->name('about');
Route::get('/contact', ShowContact::class)->name('contact');

// Admin Routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', DataCard::class)->name('dashboard');
    Route::get('/appointments', AppointmentPage::class)->name('appointments');
    Route::get('/services', ServicesPage::class)->name('services');
    Route::get('/barbers', BarberPage::class)->name('barbers');
});
