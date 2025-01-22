<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;

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

 
 
    


    public function index()
    {
        // Récupérer l'employé connecté
        $employee = auth()->user()->employee;
    
        // Récupérer les fiches de paie de l'employé
        $fichePaies = $employee ? $employee->fichepaies : [];
    
        // Passer les fiches de paie à la vue
        return view('employee.fichepaies.index', compact('fichePaies'));
    }
    

}
