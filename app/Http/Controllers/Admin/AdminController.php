<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Performance;
use App\Models\Employee;
use App\Models\Absence;
use App\Models\Prime;
use App\Models\WorkMinute;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function index()
{
    // Appel des méthodes pour obtenir les données nécessaires
    $cards = $this->getCardData();
    $employees = $this->getEmployees();
    list($absenceData, $daysOfWeek) = $this->getAbsencesByWeek();
    $performanceData = $this->getPerformanceByWeek();
    list($workMinutesData, $daysOfWeek) = WorkMinute::getWorkMinutesByDay();  // Appel à la méthode pour récupérer les minutes de travail
    
    // Générer les semaines de l'année (par exemple, 52 semaines)
    $weeks = range(1, 52);  // Génère un tableau de 1 à 52 pour les semaines de l'année
    
    // Transmettre les données à la vue
    return view('admin.dashboard', compact('cards', 'employees', 'absenceData', 'daysOfWeek', 'performanceData', 'workMinutesData', 'weeks'));
}

// Dans le modèle WorkMinute.php



    /**
     * Récupérer les données pour les cartes principales (total des employés, absences, primes, performance)
     *
     * @return array
     */
    

    /**
     * Récupérer les employés avec leurs relations (primes, performances, absences)
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getEmployees()
    {
        return Employee::with(['primes', 'performances', 'absences'])->get();
    }

    /**
     * Récupérer les absences des 7 derniers jours et les agréger par jour de la semaine
     *
     * @return array
     */
    private function getAbsencesByWeek()
    {
        // Récupérer les absences des 7 derniers jours
        $startOfWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfWeek = Carbon::now()->subWeek()->endOfWeek();
        $absences = Absence::whereBetween('date', [$startOfWeek, $endOfWeek])->get();

        // Agréger les absences par jour de la semaine
        $absenceCountsByDay = $absences->groupBy(function($date) {
            return Carbon::parse($date->date)->format('l'); // Récupère le jour de la semaine
        });

        // Calculer le nombre d'absences par jour
        $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $absenceData = [];
        
        foreach ($daysOfWeek as $day) {
            $absenceData[] = $absenceCountsByDay->has($day) ? $absenceCountsByDay->get($day)->count() : 0;
        }

        return [$absenceData, $daysOfWeek];
    }


    private function getPerformanceByWeek()
    {
        // Récupérer les performances des 7 derniers jours
        $startOfWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfWeek = Carbon::now()->subWeek()->endOfWeek();
        $performances = Performance::whereBetween('date', [$startOfWeek, $endOfWeek])->get();

        // Agréger les performances par jour de la semaine
        $performanceCountsByDay = $performances->groupBy(function($performance) {
            return Carbon::parse($performance->date)->format('l'); // Récupère le jour de la semaine
        });

        // Calculer la moyenne des performances par jour
        $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $performanceData = [];
        
        foreach ($daysOfWeek as $day) {
            $performancesOnDay = $performanceCountsByDay->has($day) ? $performanceCountsByDay->get($day) : collect();
            $performanceData[] = $performancesOnDay->avg('rating'); // Calcul de la moyenne des performances
        }

        return $performanceData;
    }










    private function getCardData()
    {
        // Calcul des données principales
        $totalEmployees = Employee::count();
        $totalAbsences = Absence::count();
        $totalPrimes = Prime::sum('amount');
        $averagePerformance = Performance::avg('rating');

        // Retourner les données sous forme de tableau
        return [
            [
                'color' => 'primary',
                'value' => $totalEmployees,
                'label' => 'Total Employees',
            ],
            [
                'color' => 'info',
                'value' => $totalAbsences,
                'label' => 'Total Absences',
            ],
            [
                'color' => 'success',
                'value' => $totalPrimes . 'DT',
                'label' => 'Total Primes',
            ],
            [
                'color' => 'danger',
                'value' => round($averagePerformance, 2),
                'label' => 'Average Performance',
            ],
        ];
    }
}







