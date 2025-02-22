<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Admin\AdminDemandeCongeController;
use App\Http\Controllers\Admin\AdminCongeAnalyseController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\AbsenceController;
use App\Http\Controllers\MissionInternationalleController;
use App\Http\Controllers\LocalMissionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PerformanceController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PrimeController;



Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class,'index'])->middleware(['auth', 'verified'])->name('admin.dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileAdminController::class, 'edit'])->name('admin.profile.edit');
        Route::patch('/profile', [ProfileAdminController::class, 'update'])->name('admin.profile.update');
        Route::delete('/profile', [ProfileAdminController::class, 'destroy'])->name('admin.profile.destroy');
    });
});

// Routes Admin protégées par l'authentification
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Gestion des employés
    Route::prefix('gereEmpl')->name('gereEmpl.')->group(function () {
        Route::get('/index', [EmployeeController::class, 'indexAdmin'])->name('index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        Route::post('/', [EmployeeController::class, 'store'])->name('store');
        Route::get('/{employee_id}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::put('/{employee_id}', [EmployeeController::class, 'update'])->name('update');
        Route::delete('/{employee_id}', [EmployeeController::class, 'destroy'])->name('destroy');
    });

    // Gestion des demandes de congés
    Route::get('/demande_conge/conges', [AdminDemandeCongeController::class, 'conges'])->name('demande_conge.conges');
    Route::put('/demande_conge/update/{id}', [AdminDemandeCongeController::class, 'update'])->name('demande_conge.update');
    Route::get('/demande_conge/analyser-congees', [AdminCongeAnalyseController::class, 'analyserConges'])->name('demande_conge.analyser_congees');
});



Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Définir les routes pour les notifications administrateur
    Route::get('/notifications', [NotificationController::class, 'adminShowNotifications'])->name('admin.notifications.show');
    Route::get('/notifications/mark-all-read', [NotificationController::class, 'adminMarkAllAsRead'])->name('admin.notifications.markAllAsRead');
});

    // Routes administrateur - Missions internationales
    Route::get('/admin/missions/international', [MissionInternationalleController::class, 'adminIndex'])->name('missions.international.admin.index');
    Route::post('/admin/missions/international/approve/{id}', [MissionInternationalleController::class, 'approveMission'])->name('missions.international.approve');
    Route::post('/admin/missions/international/reject/{id}', [MissionInternationalleController::class, 'rejectMission'])->name('missions.international.reject');

    // Routes administrateur - Missions locales
    Route::get('/admin/missions/local', [LocalMissionController::class, 'adminIndex'])->name('admin.local_missions.index');
    Route::post('/admin/missions/local/{id}/approve', [LocalMissionController::class, 'approve'])->name('admin.local_missions.approve');
    Route::post('/admin/missions/local/{id}/reject', [LocalMissionController::class, 'reject'])->name('admin.local_missions.reject');

    // Middleware pour les routes administrateur
    // Routes administrateur - Absences

    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
        Route::get('absences', [AbsenceController::class, 'index'])->name('absences');
        Route::get('absences/create', [AbsenceController::class, 'create'])->name('absences.create');
        Route::post('absences', [AbsenceController::class, 'store'])->name('absences.store');
        Route::get('absences/{id}/edit', [AbsenceController::class, 'edit'])->name('absences.edit');
        Route::put('absences/{id_absence}', [AbsenceController::class, 'update'])->name('absences.update');
        Route::delete('absences/{id_absence}', [AbsenceController::class, 'destroy'])->name('absences.destroy');
    });
    

    Route::middleware('auth')->group(function () {
        // Administration des prêts (Admin)
        Route::prefix('admin/loans')->name('admin.loans.')->group(function () {
            Route::get('/', [LoanController::class, 'adminIndex'])->name('index');
            Route::post('/{loan}/approve', [LoanController::class, 'approve'])->name('approve');
            Route::post('/{loan}/reject', [LoanController::class, 'reject'])->name('reject');

            // Historique des prêts
            Route::get('/history', [LoanController::class, 'loanHistory'])->name('history');

            // Téléchargement CSV des prêts
            Route::get('/downloadCSV', [LoanController::class, 'downloadCSV'])->name('downloadCSV');
        });
    });

     // Administration des prêts (Admin)
Route::prefix('admin/loans')->name('admin.loans.')->group(function () {
    // Route pour les prêts en attente
    Route::get('/pending', [LoanController::class, 'pending'])->name('pending');

    Route::get('/', [LoanController::class, 'adminIndex'])->name('index');
    Route::post('/{loan}/approve', [LoanController::class, 'approve'])->name('approve');
    Route::post('/{loan}/reject', [LoanController::class, 'reject'])->name('reject');

    // Historique des prêts
    Route::get('/history', [LoanController::class, 'loanHistory'])->name('history');

    // Téléchargement CSV des prêts
    Route::get('/downloadCSV', [LoanController::class, 'downloadCSV'])->name('downloadCSV');
});


  Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
      // Afficher les employés
      Route::get('primes/index', [PrimeController::class, 'index'])->name('primes.index');
      
      // Formulaire pour créer une prime
      Route::get('primes/create', [PrimeController::class, 'create'])->name('primes.create');
      
      // Enregistrer une prime
      Route::post('primes', [PrimeController::class, 'store'])->name('primes.store');
      Route::get('primes/show', [PrimeController::class, 'show'])->name('primes.show');
      // Dans routes/web.php
      Route::delete('primes/{prime:id_prime}', [PrimeController::class, 'destroy'])->name('primes.destroy');


  });




Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    // Afficher les performances
    Route::get('/performances/index', [PerformanceController::class, 'index'])->name('performances.index');
    Route::get('/performances/create/{employeeId}', [PerformanceController::class, 'create'])->name('performances.create');
    Route::get('/performances/creationperformances', [PerformanceController::class, 'createcreationperformances'])->name('performances.creationperformances');
    Route::post('/performances', [PerformanceController::class, 'store'])->name('performances.store');
    Route::delete('performances/{id_performance}', [PerformanceController::class, 'destroy'])->name('performances.destroy');
    
});
