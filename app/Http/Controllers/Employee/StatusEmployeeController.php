<?php
namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\StatusEmployee;
use App\Models\WorkMinute;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class StatusEmployeeController extends Controller
{
    public function updateStatus(Request $request)
    {
        // Valider la requête
        $request->validate([
            'status' => 'required|in:active,offline,busy',
        ]);

        // Récupérer l'employé connecté
        $employee = auth()->user()->employee; // Récupérer l'instance Employee liée à l'utilisateur connecté

        // Vérifier si l'employé existe
        if (!$employee) {
            return back()->with('error', 'L\'employé n\'existe pas.');
        }

        // Récupérer ou créer le statut de l'employé
        $status_employee = StatusEmployee::firstOrCreate(
            ['employee_id' => $employee->employee_id],
            ['status' => 'offline', 'start_time' => null, 'end_time' => null]
        );

        // Si l'employé passe de "active" à un autre statut, calculer les minutes travaillées
        if ($status_employee->status == 'active' && $request->status != 'active') {
            $this->calculateAndStoreMinutes($employee, $status_employee->start_time, now());
            $status_employee->start_time = null; // Réinitialiser l'heure de début
        }

        // Si le statut passe à "active", enregistrer l'heure de début
        if ($request->status == 'active') {
            $status_employee->start_time = now();
        } else {
            $status_employee->end_time = now(); // Enregistrer l'heure de fin pour "offline" ou "busy"
        }

        // Mise à jour du statut dans la table status_employee
        $status_employee->status = $request->status;
        $status_employee->save();

        // Mise à jour du statut dans la table employees, si nécessaire
        if ($employee->status !== $request->status) {
            Log::info("Mise à jour du statut de l'employé ID " . $employee->employee_id . " : " . $employee->status . " => " . $request->status);
            $employee->status = $request->status;  // Mise à jour du statut de l'employé
            $employee->save(); // Sauvegarder dans la table employees
        }

        return back()->with('success', 'Statut mis à jour avec succès !');
    }

    /**
     * Calculer les minutes travaillées et les enregistrer dans la table `work_minutes`.
     */
    private function calculateAndStoreMinutes($employee, $start_time, $end_time)
    {
        if (!$employee) {
            return;
        }

        if ($start_time && $end_time) {
            $start_time = Carbon::parse($start_time);
            $end_time = Carbon::parse($end_time);

            // Calculer la différence en minutes
            $minutes_worked = $start_time->diffInMinutes($end_time);

            // Enregistrer les minutes travaillées dans `work_minutes`
            WorkMinute::create([
                'employee_id' => $employee->employee_id,
                'minutes_worked' => $minutes_worked,
                'day' => $start_time->format('l'), // Jour de la semaine
            ]);
        }
    }
}
