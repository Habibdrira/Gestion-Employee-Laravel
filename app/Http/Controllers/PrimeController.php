<?php

namespace App\Http\Controllers;

use App\Models\Prime;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PrimeController extends Controller
{
    public function index()
    {
        // Récupérer tous les employés
        $employees = Employee::all();
        return view('admin.primes.index', compact('employees'));
    }

    public function show()
    {
        // Récupérer tous les employés ayant des primes
        $employeesWithPrimes = Employee::has('primes')->with('primes')->get();

        // Passer les employés et leurs primes à la vue
        return view('admin.primes.show', compact('employeesWithPrimes'));
    }

    public function create()
    {
        // Récupérer tous les employés pour les afficher dans la vue
        $employees = Employee::all();
        return view('admin.primes.create', compact('employees'));
    }
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',  // Utilisez 'employee_id' au lieu de 'id'
            'absence_days' => 'nullable|integer|min:0', // Absences peuvent être nulles, mais doivent être un entier
            'performance_rating' => 'nullable|numeric|min:0|max:10', // Performance est optionnelle
            'base_amount' => 'required|numeric|min:0', // Le montant de base est requis
        ]);
    
        // Récupérer l'employé avec son ID
        $employee = Employee::findOrFail($request->employee_id);
    
        // Calcul des facteurs (absence et performance)
        $absenceDays = $request->absence_days ?? 0;  // Si pas d'absences, 0
        $absenceFactor = $this->calculateAbsenceFactor($absenceDays);
    
        // Vérifier s'il existe des performances et calculer le facteur
        $performanceRating = $request->performance_rating ?? 0;  // Si pas de performance, 0
        $performanceFactor = $this->calculatePerformanceFactor($performanceRating);
    
        // Montant de la prime de base
        $baseAmount = $request->base_amount;
        $finalAmount = $baseAmount * $absenceFactor * $performanceFactor;
    
        // Déboguer les données avant d'insérer
        Log::info('Prime Data:', [
            'employee_id' => $employee->employee_id, // Utilisez 'employee_id' au lieu de 'id'
            'amount' => $finalAmount,
            'date_awarded' => Carbon::now(),
            'absence_factor' => $absenceFactor,
            'performance_factor' => $performanceFactor,
        ]);
    
        // Création de la prime
        Prime::create([
            'employee_id' => $employee->employee_id,  // Utilisez 'employee_id' ici également
            'amount' => $finalAmount,
            'date_awarded' => Carbon::now(),  // Utilisez Carbon pour insérer la date actuelle
            'absence_factor' => $absenceFactor,
            'performance_factor' => $performanceFactor,
        ]);
        
        return redirect()->route('admin.primes.index')->with('success', 'Prime attribuée avec succès.');
    }
    

    public function destroy($primeId)
    {
        // Trouver la prime par ID en utilisant la clé primaire 'id_prime'
        $prime = Prime::where('id_prime', $primeId)->firstOrFail();
    
        // Supprimer la prime
        $prime->delete();
    
        // Retourner un message de succès
        return redirect()->route('admin.primes.show')->with('success', 'La prime a été supprimée avec succès.');
    }
    
    

    protected function calculateAbsenceFactor($absenceDays)
    {
        if ($absenceDays === 0) {
            return 1.00;
        } elseif ($absenceDays <= 3) {
            return 0.90;
        } elseif ($absenceDays <= 5) {
            return 0.75;
        } else {
            return 0.50;
        }
    }

    protected function calculatePerformanceFactor($rating)
    {
        if ($rating >= 9) {
            return 1.20;
        } elseif ($rating >= 7) {
            return 1.10;
        } else {
            return 1.00;
        }
    }
}
