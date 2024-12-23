<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Performance;
use Illuminate\Support\Facades\Auth;

class PerformanceChartController extends Controller
{
    public function index()
    {
        // Récupérer les performances de l'employé connecté
        $performances = Performance::where('employee_id', Auth::id())
            ->orderBy('date')
            ->get();

        // Préparer les données pour le diagramme
        $dates = $performances->pluck('date')->toArray(); // Dates
        $ratings = $performances->pluck('rating')->toArray(); // Évaluations

        return view('employee.performance.chart', compact('dates', 'ratings'));
    }
}
