<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Performance;
use App\Models\Employee;
use App\Models\Absence;
use App\Models\Prime;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Calcul des données principales pour les cartes
        $totalEmployees = Employee::count();
        $totalAbsences = Absence::count();
        $totalPrimes = Prime::sum('amount');
        $averagePerformance = Performance::avg('rating');

        // Préparer les données pour les cartes
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

        // Charger les employés avec les relations
        $employees = Employee::with(['primes', 'performances', 'absences'])->get();

        // Récupérer les absences des 7 derniers jours
        $startOfWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfWeek = Carbon::now()->subWeek()->endOfWeek();
        $absences = Absence::whereBetween('date', [$startOfWeek, $endOfWeek])->get();

        // Agréger les absences par jour de la semaine
        $absenceCountsByDay = $absences->groupBy(function($date) {
            return Carbon::parse($date->date)->format('l'); // Récupère le jour de la semaine
        });

        // Calcul des performances moyennes par jour
        $performanceCountsByDay = Performance::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->get()
            ->groupBy(function($performance) {
                return Carbon::parse($performance->created_at)->format('l');
            });

            $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            $absenceData = [];
            $performanceData = [];
            
            // Exemple de simulation de données
            foreach ($daysOfWeek as $day) {
                $absenceData[] = rand(0, 10); // Absences aléatoires
                $performanceData[] = rand(50, 100); // Performances aléatoires
            }
            
            



            // Transmettre les données à la vue
            return view('admin.dashboard', compact('cards', 'employees', 'absenceData', 'performanceData', 'daysOfWeek'));
}
}


