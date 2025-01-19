<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Performance;
use App\Models\Employee;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {
        // Récupérer les performances avec les informations des employés et de l'utilisateur associé
        $performances = Performance::with('employee.user')->get();
        return view('admin.performances.index', compact('performances'));
    }

    public function create($employeeId)
    {
        // Récupérer l'employé spécifique en fonction de son ID
        $employee = Employee::findOrFail($employeeId);
        // Passer l'employé à la vue pour créer une performance
        return view('admin.performances.create', compact('employee'));
    }

    public function createCreationPerformances()
    {
        // Récupérer tous les employés avec leurs utilisateurs associés
        $employees = Employee::with('user')->get();
        return view('admin.performances.creationperformances', compact('employees'));
    }

    public function store(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id', // Validation pour l'ID de l'employé
            'date' => 'required|date',
            'rating' => 'required|numeric|min:0|max:5',
        ]);
        
        // Créer une nouvelle performance dans la base de données
        Performance::create([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'rating' => $request->rating,
        ]);
        
        // Redirection avec un message de succès
        return redirect()->route('admin.performances.index')->with('success', 'Performance ajoutée avec succès.');
    }

    public function destroy($id)
    {
        $performance = Performance::findOrFail($id);
        $performance->delete();
    
        return redirect()->route('admin.performances.index')->with('success', 'Performance supprimée avec succès.');
    }

}