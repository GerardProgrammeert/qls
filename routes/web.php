<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function (): \Illuminate\Http\RedirectResponse {
    return redirect()->route('order.index');
});

Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
Route::redirect('/orders/index', '/orders');
Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
Route::get('/orders/', [OrderController::class, 'index'])->name('order.index');
Route::get('/orders/create', [OrderController::class, 'create'])->name('order.create');
Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('order.edit');
Route::post('/orders/store', [OrderController::class, 'store'])->name('order.store');
Route::post('/orders/{order}/update', [OrderController::class, 'update'])->name('order.update');
