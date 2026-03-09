<?php

// use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Str;

use App\Models\Expenses;
use App\Mail\ExpensesPostedDaily;

Route::get('/test', function () {

    $expenses = Expenses::limit(10)->get();
    // return new ExpensesPostedDaily($expenses);
     Mail::to('expenses@example.com')->send(new ExpensesPostedDaily($expenses));
    return 'Email został wysłany';
});
// Route::get('test', function () {
//     // return new \App\Mail\ExpensesPosted();
//     Mail::to('expenses@example.com')->send(new \App\Mail\ExpensesPosted());
//     return 'Email został wysłany';
// });

// Strona główna przekierowuje na wydatki
Route::get('/', function () {
    return redirect('/expenses');
});

// Grupa tras dla wydatków
Route::controller(FormController::class)->group(function () {
    Route::get('/expenses', 'index')->name('expenses.index');
    Route::get('/expenses/create', 'create')->name('expenses.create');
    Route::post('/expenses', 'store')->name('expenses.store');
    Route::get('/expenses/{expense}/edit', 'edit')->name('expenses.edit')->middleware('auth')->can('update', 'expense');
    Route::patch('/expenses/{expense}', 'update')->name('expenses.update')->middleware('auth')->can('update', 'expense');
    Route::delete('/expenses/{expense}', 'destroy')->name('expenses.destroy')->middleware('auth')->can('destroy', 'expense');
});


//Index
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('/register', [UserController::class, 'create']);
Route::post('/register', [UserController::class, 'store']);


//Test Form
Route::get('/form', function () {
    return view('form');
});

Route::post('/form', function () {
    request()->validate([
        'name' => ['required', 'string', 'min:3', 'max:255']
    ]);
    @dd(request()->all());

    return view('form');
});

Route::get('/statistics', [StatisticsController::class, 'index'])->middleware('auth');