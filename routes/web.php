<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/add-device', function () {
    return view('add-device');
});

Route::get('/edit-device', function () {
    return view('edit-device');
});
