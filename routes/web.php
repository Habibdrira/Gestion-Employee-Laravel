<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\Admin\PerformanceController;

Route::get('/', function () {
    return redirect()->route('login'); // Redirige directement vers la page de connexion
});
Route::post('/user/status/update', [StatusController::class, 'updateStatus'])->name('update.status');

// routes/web.php

use App\Http\Controllers\WorkHoursController;

Route::middleware(['auth'])->group(function () {
    // Mettre à jour les heures de travail après un changement de statut
    Route::post('/update-work-hours', [WorkHoursController::class, 'updateWorkHours'])->name('updateWorkHours');
    
    // Afficher les heures de travail d'un utilisateur
    Route::get('/work-hours/{userId}', [WorkHoursController::class, 'showWorkHours'])->name('workHours.show');
});


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/employee.php';
