<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use Carbon\Carbon;

class AbsenceController extends Controller
{
    public function showAbsences()
    {
        // Récupérer les absences de la semaine
        $absences = Absence::where('employee_id', auth()->user()->employee->employee_id)
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();

        // Organiser les absences par semaine et calculer la somme des durées d'absences
        $weeklyAbsenceData = $absences->groupBy(function($absence) {
            return Carbon::parse($absence->date)->format('W'); // Récupère la semaine de l'année
        });

        // Calculer la somme des durées des absences par semaine
        $weeklyAbsenceData = $weeklyAbsenceData->map(function ($week) {
            return $week->sum('duration'); // Somme des durées d'absences par semaine
        });

        return view('employee.absences', compact('weeklyAbsenceData'));
    }
}
