<?php

use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SupplierController;

Route::get('/', [ProjectController::class, 'index'])->name('index');

Route::controller(ProjectController::class)
    ->prefix('projetos')
    ->name('projects.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/novo', 'create')->name('create');
        Route::post('/', 'store')->name('store');

        Route::get('/{id}/editar', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');

        Route::delete('/{id}', 'destroy')->name('destroy');
    });

Route::controller(ExpenseController::class)
    ->prefix('projetos/{project}/gastos')
    ->name('expenses.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/novo', 'create')->name('create');
        Route::post('/', 'store')->name('store');

        Route::get('/{id}/editar', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');

        Route::delete('/{id}', 'destroy')->name('destroy');
    });

Route::controller(SupplierController::class)
    ->prefix('fornecedores')
    ->name('suppliers.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/novo', 'create')->name('create');
        Route::post('/', 'store')->name('store');

        Route::get('/{id}/editar', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');

        Route::delete('/{id}', 'destroy')->name('destroy');
    });
