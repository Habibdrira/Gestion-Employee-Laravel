<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PerformanceController;

Route::get('/', function () {
    return redirect()->route('login'); // Redirige directement vers la page de connexion
});


use App\Http\Controllers\ChartController;

Route::get('/chart', [ChartController::class, 'index'])->name('chart.index');







require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/employee.php';
