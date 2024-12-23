<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\Employee;
use App\Notifications\AbsenceNotification;

class AbsenceController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'reason' => 'required|string|max:200',
            'duration' => 'required|integer|min:1',
            'employee_id' => 'required|exists:employees,employee_id',
        ]);

        // Ajouter une nouvelle absence
        $absence = Absence::create([
            'date' => $request->date,
            'reason' => $request->reason,
            'duration' => $request->duration,
            'employee_id' => $request->employee_id,
        ]);

        // Envoyer la notification pour l'ajout de l'absence
        $employee = $absence->employee;
        $employee->user->notify(new AbsenceNotification($absence, 'added')); // "added" pour une nouvelle absence

        return redirect()->route('admin.absences')->with('success', 'Absence ajoutée avec succès');
    }






public function index()
{
    $absences = Absence::with('employee')->get();
    $employees = Employee::all();

    $stats = [
        'total_absences' => $absences->count(),
        'average_duration' => $absences->avg('duration'),
        'reasons' => $absences->groupBy('reason')->map->count(),
    ];

    return view('admin.absences.absences', compact('absences', 'stats','absences', 'employees'));
}
public function destroy($id)
{
    $absence = Absence::findOrFail($id);
    $absence->delete();

    return redirect()->route('admin.absences.absences')->with('success', 'Absence supprimée avec succès.');
}

public function update(Request $request, $id_absence)
{
    $request->validate([
        'date' => 'required|date',
        'reason' => 'required|string|max:200',
        'duration' => 'required|integer|min:1',
        'employee_id' => 'required|exists:employees,employee_id',
    ]);

    // Trouver l'absence et la mettre à jour
    $absence = Absence::findOrFail($id_absence);
    $absence->update([
        'date' => $request->date,
        'reason' => $request->reason,
        'duration' => $request->duration,
        'employee_id' => $request->employee_id,
    ]);

    // Envoyer la notification pour la mise à jour de l'absence
    $employee = $absence->employee;
    $employee->user->notify(new AbsenceNotification($absence, 'updated')); // "updated" pour une mise à jour

    return redirect()->route('admin.absences')->with('success', 'Absence mise à jour avec succès');
}



public function create()
{
    $employees = Employee::all(); // Assurez-vous que le modèle Employee existe
    return view('admin.absences.create_absence', compact('employees'));
}
public function edit($id_absence)
{
    $absence = Absence::findOrFail($id_absence);
    $employees = Employee::with('user')->get(); // Récupération des employés avec leur relation user

    return view('admin.absences.edit_absence', compact('absence', 'employees'));
}

}
