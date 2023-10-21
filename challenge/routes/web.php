<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountActivationController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'checkRegularRole'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin-dashboard');
})->middleware(['auth', 'verified', 'checkAdminRole'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/validation/{email}/{code}', [AccountActivationController::class, 'activate'])->name('account.activation');
Route::get('/generate-activation-link/{email}', [AccountActivationController::class, 'generateActivationLink'])->name('generate.activation.link');
Route::get('/link', function () {
    return view('link-expired');
});

require __DIR__.'/auth.php';
