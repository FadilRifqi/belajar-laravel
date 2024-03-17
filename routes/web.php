<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('page.home', [
        "page" => "home",
    ]);
});
Route::get('/shop', function () {
    return view('page.shop', [
        "page" => "shop",
    ]);
});
Route::get('/inventory', function () {
    return view('page.inventory', [
        "page" => "inventory",
    ]);
});
