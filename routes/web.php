<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return ['Welcome to Bookstore API using Laravel' => app()->version()];
});

require __DIR__.'/auth.php';
