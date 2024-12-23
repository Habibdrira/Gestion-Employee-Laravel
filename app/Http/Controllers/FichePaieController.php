<?php

namespace App\Http\Controllers;

use App\Models\FichePaie;
use Illuminate\Http\Request;

class FichePaieController extends Controller
{

    public function salary($employeeId)
    {
        $employee = Employee::find($employeeId);

        if (!$employee) {
            return redirect()->route('fichepaie.index')->with('error', 'Employé non trouvé.');
        }

        $totalAbsenceImpact = $employee->absences->sum('impact');
        $totalPrimes = $employee->primes->sum('amount');
        $adjustedSalary = $employee->salary - $totalAbsenceImpact + $totalPrimes;

        return view('employee.fichepaies.salary', compact('employee', 'totalAbsenceImpact', 'totalPrimes', 'adjustedSalary'));
    }


    public function download(FichePaie $fichePaie)
    {
        $filePath = storage_path('app/fichepaies/' . $fichePaie->filename);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return redirect()->route('fichepaie.index')->with('error', 'Fiche de paie introuvable.');
    }
}
