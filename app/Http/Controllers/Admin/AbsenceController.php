<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\Employee;
use App\Notifications\AbsenceNotification;

class AbsenceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'reason' => 'required|string|max:200',
            'duration' => 'required|integer|min:1',
            'employee_id' => 'required|exists:employees,employee_id',
        ]);

        $absence = Absence::create($request->all());

        // Envoyer la notification à l'utilisateur si disponible
        $employee = Employee::with('user')->find($request->employee_id);
        if ($employee && $employee->user) {
            $employee->user->notify(new AbsenceNotification($absence, 'added'));
        }

        return redirect()->route('admin.absences')->with('success', 'Absence ajoutée avec succès.');
    }

    public function index()
    {
        $absences = Absence::with('employee.user')->get();
        $employees = Employee::all();

        $stats = [
            'total_absences' => $absences->count(),
            'average_duration' => $absences->avg('duration'),
            'reasons' => $absences->groupBy('reason')->map->count(),
        ];

        return view('admin.absences.absences', compact('absences', 'stats', 'employees'));
    }

    public function destroy($id)
    {
        $absence = Absence::findOrFail($id);
        $absence->delete();

        return redirect()->route('admin.absences')->with('success', 'Absence supprimée avec succès.');
    }

    public function update(Request $request, $id_absence)
    {
        $request->validate([
            'date' => 'required|date',
            'reason' => 'required|string|max:200',
            'duration' => 'required|integer|min:1',
            'employee_id' => 'required|exists:employees,employee_id',
        ]);

        $absence = Absence::findOrFail($id_absence);
        $absence->update($request->all());

        $employee = Employee::with('user')->find($request->employee_id);
        if ($employee && $employee->user) {
            $employee->user->notify(new AbsenceNotification($absence, 'updated'));
        }

        return redirect()->route('admin.absences')->with('success', 'Absence mise à jour avec succès.');
    }

    public function create()
    {
        $employees = Employee::all();
        return view('admin.absences.create_absence', compact('employees'));
    }

    public function edit($id_absence)
    {
        $absence = Absence::findOrFail($id_absence);
        $employees = Employee::all();

        return view('admin.absences.edit_absence', compact('absence', 'employees'));
    }
}
