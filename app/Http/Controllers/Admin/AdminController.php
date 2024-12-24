<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Performance;
use App\Models\Employee;
use App\Models\Absence;
use App\Models\Prime;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalEmployees = Employee::count();

        // Total des absences
        $totalAbsences = Absence::count();

        // Somme totale des primes
        $totalPrimes = Prime::sum('amount');

        // Moyenne des performances
        $averagePerformance = Performance::avg('rating');

        // Préparer les données des cartes
        $cards = [
            [
                'color' => 'primary',
                'value' => $totalEmployees,
                'percentage' => '',
                'arrow' => '',
                'label' => 'Total Employees',
                'chart_id' => 'card-chart1',
            ],
            [
                'color' => 'info',
                'value' => $totalAbsences,
                'percentage' => '',
                'arrow' => '',
                'label' => 'Total Absences',
                'chart_id' => 'card-chart2',
            ],
            [
                'color' => 'success',
                'value' => $totalPrimes . ' $',
                'percentage' => '',
                'arrow' => '',
                'label' => 'Total Primes',
                'chart_id' => 'card-chart3',
            ],
            [
                'color' => 'danger',
                'value' => round($averagePerformance, 2),
                'percentage' => '',
                'arrow' => '',
                'label' => 'Average Performance',
                'chart_id' => 'card-chart4',
            ],
        ];
        $employees = Employee::with(['primes', 'performances', 'absences'])->get();


        return view('admin.dashboard', compact('cards') ,compact('employees'));
    }

}
