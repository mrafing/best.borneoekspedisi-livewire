<?php

use App\Livewire\Manifest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/manifest', Manifest::class)->lazy();
