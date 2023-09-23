<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MailController;

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

Route::get('/', [ProjectsController::class, 'index'])->name('homepage');
Route::post('/request/store', [RequestController::class, 'store'])->name('request.store');
Route::post('/email/send', [MailController::class, 'send'])->name('email.send');

Route::get('/loginPage', [LoginController::class, 'index'])->name('loginPage');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/product/add', [ProjectsController::class, 'create'])->name('product.add');
Route::delete('/product/delete', [ProjectsController::class, 'delete'])->name('product.delete');
Route::post('/product/edit', [ProjectsController::class, 'edit'])->name('product.edit');

Route::middleware(['auth:admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/edit/product', [DashboardController::class, 'edit'])->name('edit.product');
    Route::get('/logout', [LoginController::class, 'logout']);

});


