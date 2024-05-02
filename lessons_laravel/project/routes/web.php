<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PollTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\RestrictMozillaAccess;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::middleware(RestrictMozillaAccess::class)->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::prefix('poll-types')->name('poll-types.')->group(function () {
    Route::get('/', [PollTypeController::class, 'index'])->name('index');
    Route::get('/create', [PollTypeController::class, 'create'])->name('create');
    Route::post('/', [PollTypeController::class, 'store'])->name('store');
    Route::get('/edit/{pollType}', [PollTypeController::class, 'edit'])->name('edit');
    Route::put('/{pollType}', [PollTypeController::class, 'update'])->name('update');
    Route::delete('/{pollType}', [PollTypeController::class, 'destroy'])->name('destroy');
});

Route::resource('products', ProductController::class);

// Database: Query Builders - SELECT statements
Route::get('/db-test-select', function () {
    $q1 = DB::table('products')
        ->orderBy('price', 'desc')
        ->limit(3);

    $q2 = DB::table('products')
        ->select('product_name', 'price')
        ->where('price', '>', 100);

    $q3 = DB::table('products')
        ->select('category', DB::raw('AVG(price) AS average_price'))
        ->groupBy('category');

    $q4 = DB::table('users')
        ->leftJoin('orders', 'users.user_id', '=', 'orders.user_id')
        ->select('users.username', DB::raw('COUNT(orders.order_id) AS total_orders'))
        ->groupBy('users.user_id');

    dump($q1->toRawSql(), $q2->toRawSql(), $q3->toRawSql(), $q4->toRawSql());
});

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
