<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\ProfileEmployeeController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Employee\DemandeCongeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\Employee\PerformanceChartController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AbsenceController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MissionInternationalleController;
use App\Http\Controllers\LocalMissionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;

use App\Http\Controllers\PrimeController;

use App\Http\Controllers\Employee\FichePaieController;

use App\Http\Controllers\Employee\StatusEmployeeController;


Route::post('/employee/status/update', [StatusEmployeeController::class, 'updateStatus'])->name('update.status');

Route::prefix('employee')->group(function () {
    Route::get('/dashboard', [EmployeeController::class,'index'])->middleware(['auth', 'verified'])->name('employee.dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileEmployeeController::class, 'edit'])->name('employee.profile.edit');
        Route::patch('/profile', [ProfileEmployeeController::class, 'update'])->name('employee.profile.update');
        Route::delete('/profile', [ProfileEmployeeController::class, 'destroy'])->name('employee.profile.destroy');
    });
});
// Sections des Notifications

Route::get('/notifications', [NotificationController::class, 'showNotifications'])->name('notifications.show');
Route::get('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');



// Dashboard Employee
Route::middleware('auth')->prefix('employee')->name('employee.')->group(function () {
    // Afficher le formulaire de demande de congé
    Route::get('/demande-conge/create', [DemandeCongeController::class, 'create'])->name('demande_conge.create');

    // Afficher la liste des demandes de congé
    Route::get('/demande-conge/index', [DemandeCongeController::class, 'index'])->name('demande_conge.index');

    // Enregistrer une nouvelle demande de congé
    Route::post('/demande-conge/store', [DemandeCongeController::class, 'store'])->name('demande_conge.store');

    // Mettre à jour le statut de la demande de congé
    Route::put('/demande-conge/update-status/{id}', [DemandeCongeController::class, 'updateStatus'])->name('demande_conge.updateStatus');
});




// ajout de la route pour les employés
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('admin.employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('admin.employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('admin.employees.store');
});



// Middleware pour les routes utilisateur
    // Routes pour les absences
    Route::get('/status', [StatusController::class, 'index'])->name('status.index');
    Route::put('/status', [StatusController::class, 'update'])->name('status.update');

    // Routes utilisateur - Missions internationales
    Route::get('/missions/international', [MissionInternationalleController::class, 'userIndex'])->name('missions.international.user.index');
    Route::get('/missions/international/create', [MissionInternationalleController::class, 'create'])->name('missions.international.create');
    Route::post('/missions/international/store', [MissionInternationalleController::class, 'store'])->name('missions.international.store');
    Route::get('/missions/international/create-report/{id}', [MissionInternationalleController::class, 'createMissionReportInternational'])->name('missions.international.report.create');
    Route::post('/missions/international/submit-report/{id}', [MissionInternationalleController::class, 'submitInternationalMissionReport'])->name('missions.international.report.submit');

    // Routes utilisateur - Missions locales
    Route::get('/missions/local/create', [LocalMissionController::class, 'createMissionLocale'])->name('local_missions.create');
    Route::post('/missions/local', [LocalMissionController::class, 'store'])->name('local_missions.store');
    Route::get('/missions/local', [LocalMissionController::class, 'index'])->name('local_missions.index');
    Route::get('/missions/local/report/{id}', [LocalMissionController::class, 'createReport'])->name('local_missions.create_report');
    Route::post('/missions/local/report/{id}', [LocalMissionController::class, 'submitReport'])->name('local_missions.submit_report');
    Route::get('/mission/local/{id}/edit', [LocalMissionController::class, 'edit'])->name('local_missions.edit');
    Route::put('/mission/local/{id}', [LocalMissionController::class, 'update'])->name('local_missions.update');
    Route::delete('/missions/local/{id}', [LocalMissionController::class, 'destroy'])->name('local_missions.destroy');



        // Routes des prêts pour les utilisateurs
        Route::prefix('loans')->name('loans.')->group(function () {
            Route::get('/', [LoanController::class, 'index'])->name('index'); // Liste des prêts
            Route::get('/create', [LoanController::class, 'create'])->name('create'); // Formulaire de création de prêt
            Route::post('/', [LoanController::class, 'store'])->name('store'); // Soumettre une nouvelle demande de prêt
        });



   
  //performaces
  Route::prefix('employee')->group(function () {
    Route::get('/performance-chart', [PerformanceChartController::class, 'index'])->name('performance.chart');
});



Route::middleware('auth')->prefix('employee')->name('employee.')->group(function () {
    Route::get('/primes/index', [EmployeeController::class, 'Prime'])->name('primes.index');
    Route::get('/performance/index', [EmployeeController::class, 'performance'])->name('performance.index');
});



Route::middleware('auth')->prefix('fichepaie')->name('employee.')->group(function () {
    Route::get('/fichepaies', [FichePaieController::class, 'index'])->name('fichepaie.index');

    Route::get('/fichepaies/salary/{employeeId}', [FichePaieController::class, 'salary'])->name('fichepaie.salary');
    Route::get('/fichepaies/download/{employeeId}', [FichePaieController::class, 'download'])
    ->name('fichepaie.downloadSalary');
});