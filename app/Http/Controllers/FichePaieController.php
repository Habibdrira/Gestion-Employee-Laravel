<?php

namespace App\Http\Controllers;

use App\Models\FichePaie;
use Illuminate\Http\Request;

class FichePaieController extends Controller
{

    public function salary($employeeId)
    {

        if (auth()->check()) {
            // Récupérer l'employé lié à l'utilisateur connecté
            $employee = auth()->user()->employee;

        if ($employee) {

        $totalAbsenceImpact = $employee->absences->sum('impact');
        $totalPrimes = $employee->primes->sum('amount');
        $adjustedSalary = $employee->salary - $totalAbsenceImpact + $totalPrimes;

        return view('employee.fichepaies.salary', compact('employee', 'totalAbsenceImpact', 'totalPrimes', 'adjustedSalary'));
    }
    return redirect()->route('employee.dashboard')->with('error', 'Aucun employé trouvé.');


}
    }

    public function download($employeeId)
    {
        // Rechercher la fiche de paie associée à cet employé
        $fichePaie = FichePaie::where('employee_id', $employeeId)->first();
    
        if (!$fichePaie) {
            return redirect()->route('fichepaie.index')->with('error', 'Fiche de paie introuvable.');
        }
    
        $filePath = storage_path('app/fichepaies/' . $fichePaie->filename);
    
        // Vérifier si le fichier existe
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
    
        return redirect()->route('fichepaie.index')->with('error', 'Fichier introuvable.');
    }
 
    


    public function index()
{
    // Si vous voulez que l'employé connecté voit ses propres fiches de paie
    $employee = auth()->user()->employee;
    $fichepaies = $employee ? $employee->fichepaies : [];

    return view('employee.fichepaies.index', compact('fichepaies'));
}

}
