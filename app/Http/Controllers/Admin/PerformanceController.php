<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Performance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PerformanceController extends Controller
{
public function index()
{
    $performances = Performance::with('employee')->get();
    return view('admin.performances.index', compact('performances'));
}

public function create()
{
    $employees = Employee::all();
    return view('admin.performances.create', compact('employees'));
}

public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id_employee',
        'date' => 'required|date',
        'rating' => 'required|numeric|min:0|max:5',
    ]);

    Performance::create($request->all());

    return redirect()->route('admin.performances.index')->with('success', 'Performance ajoutée avec succès.');
}

public function destroy(Performance $performance)
{
    $performance->delete();
    return redirect()->route('admin.performances.index')->with('success', 'Performance supprimée avec succès.');
}
}
