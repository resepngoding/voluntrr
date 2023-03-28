<?php

use App\Http\Livewire\Accounts\AccountsIndex;
use App\Http\Livewire\Dashboard\DashboardIndex;
use App\Http\Livewire\Donations\DonationsEditBarang;
use App\Http\Livewire\Donations\DonationsEditUang;
use App\Http\Livewire\Donations\DonationsFormBarang;
use App\Http\Livewire\Donations\DonationsFormUang;
use App\Http\Livewire\Donations\DonationsIndex;
use App\Http\Livewire\Donations\DonationsList;
use App\Http\Livewire\Donors\DonorsIndex;
use App\Http\Livewire\Teams\TeamIndex;
use App\Http\Livewire\Users\UsersIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/home', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['dataEntryAndAdmin'])->group(function () {
        // dataentry , admin & superadmin only
        Route::get('/dashboard', DashboardIndex::class)->name('dashboard');
        Route::get('/admin/donatur', DonorsIndex::class)->name('admin.donors');
        Route::get('/admin/donasi/{id}', DonationsIndex::class)->name('admin.donations');
        Route::get('/admin/form-donasi-uang/{id}', DonationsFormUang::class)->name('admin.donations-form-uang');
        Route::get('/admin/form-donasi-barang/{id}', DonationsFormBarang::class)->name('admin.donations-form-barang');
        Route::get('/admin/form-donasi-uang/{donation}/edit', DonationsEditUang::class)->name('admin.donations.edit-uang');
        Route::get('/admin/form-donasi-barang/{donation}/edit', DonationsEditBarang::class)->name('admin.donations.edit-barang');
        Route::get('/admin/list-donasi/', DonationsList::class)->name('admin.donations-list');

        Route::middleware(['admin'])->group(function () {
            // admin & superadmin only
            Route::get('/admin/users', UsersIndex::class)->name('admin.users');
            Route::get('/admin/teams', TeamIndex::class)->name('admin.teams');
            Route::get('/admin/rekening', AccountsIndex::class)->name('admin.accounts');
        });
    });
});
