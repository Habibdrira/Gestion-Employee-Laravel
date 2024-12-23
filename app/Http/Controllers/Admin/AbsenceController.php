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

        $absence = Absence::create($request->all());

        // Notify the employee if they have a user associated with them
       // $employee = Employee::findOrFail($request->employee_id);
       //$employee = Employee::with('user')->get();
        //if ($employee->user) {
           // $employee->user->notify(new AbsenceNotification($absence));  // This should trigger the notification
       // }
        // Récupérer l'employé par son employee_id
        $employee = Employee::where('employee_id', $request->employee_id)->with('user')->first();

        if ($employee && $employee->user) {
            // Notifier l'utilisateur
            $employee->user->notify(new AbsenceNotification($request->absence));
        }


        return redirect()->route('admin.absences.absences')->with('success', 'Absence ajoutée et notification envoyée.');
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

public function update(Request $request, $id)
{
    $request->validate([
        'date' => 'required|date',
        'reason' => 'required|string|max:200',
        'duration' => 'required|integer|min:1',
        'employee_id' => 'required|exists:employees,id',
    ]);

    $absence = Absence::findOrFail($id);
    $absence->update([
        'date' => $request->date,
        'reason' => $request->reason,
        'duration' => $request->duration,
        'employee_id' => $request->employee_id,
    ]);

    return redirect()->route('admin.absences')->with('success', 'Absence mise à jour avec succès');
}
public function create()
{
    $employees = Employee::all(); // Assurez-vous que le modèle Employee existe
    return view('admin.absences.create_absence', compact('employees'));
}
public function edit($id)
{
    $absence = Absence::findOrFail($id); // Recherche de l'absence par son ID
    $employees = Employee::all(); // Charger les employés pour la liste déroulante

    return view('admin.absences.edit_absence', compact('absence', 'employees'));
}



}
