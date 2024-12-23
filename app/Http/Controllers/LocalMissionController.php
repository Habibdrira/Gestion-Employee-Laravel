<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocalMission;
use App\Models\Employee;
use App\Notifications\MissionStatusChanged;
use App\Notifications\MissionLocaleDemandeNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;


class LocalMissionController extends Controller
{
    /**
     * Affiche la page de création de mission locale.
     */
    public function createMissionLocale()
    {
        return view('employee.missions.local.create'); // Vue du formulaire
    }
    public function index()
    {
        $missions = LocalMission::all(); // Liste complète des missions
        return view('employee.missions.local.index', compact('missions'));
    }
   /*
     * Soumet une nouvelle mission locale.
*/
// app/Http/Controllers/LocalMissionController.php


public function store(Request $request)
{
    $request->validate([
        'superviseur' => 'required|string|max:255',
        'region' => 'required|string|max:255',
        'purpose' => 'required|string',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'accompanying_person' => 'nullable|string|max:255',
        'license_plate' => 'nullable|string|max:20',
        'car_type' => 'nullable|string|max:255',
        'fuel_type' => 'nullable|string|max:50',
        'carte_carburant' => 'nullable|string|max:255',
        'distance_traveled' => 'nullable|numeric',
        'fuel_cost' => 'nullable|numeric',
        'toll_expenses' => 'nullable|numeric',
        'hotel' => 'nullable|string|max:255',
        'indemnity' => 'nullable|numeric',
        'total_cost' => 'nullable|numeric',
        'receipt_path' => 'nullable|file|mimes:jpg,png,pdf|max:10240',
    ]);

    $missionId = uniqid('mission_', true);

    $employee = Employee::where('user_id', auth()->user()->id)->first();

    if (!$employee) {
        return redirect()->back()->withErrors('Employé non trouvé pour cet utilisateur.');
    }

    $employeeId = $employee->employee_id;

    $localMission = new LocalMission();
    $localMission->employee_id = $employeeId;
    $localMission->mission_id = $missionId;
    $localMission->superviseur = $request->superviseur;
    $localMission->region = $request->region;
    $localMission->purpose = $request->purpose;
    $localMission->start_date = $request->start_date;
    $localMission->end_date = $request->end_date;
    $localMission->accompanying_person = $request->accompanying_person;
    $localMission->license_plate = $request->license_plate;
    $localMission->car_type = $request->car_type;
    $localMission->fuel_type = $request->fuel_type;
    $localMission->carte_carburant = $request->carte_carburant;
    $localMission->distance_traveled = $request->distance_traveled;
    $localMission->fuel_cost = $request->fuel_cost;
    $localMission->toll_expenses = $request->toll_expenses;
    $localMission->hotel = $request->hotel;
    $localMission->indemnity = $request->indemnity;
    $localMission->total_cost = $request->total_cost;

    if ($request->hasFile('receipt_path')) {
        $path = $request->file('receipt_path')->store('receipts', 'public');
        $localMission->receipt_path = $path;
    }

    $localMission->save();

    // Identifier les administrateurs
// Récupérer les administrateurs (selon le rôle "admin")
$admins = User::getUsersByRole('admin');

// Envoyer une notification à chaque administrateur
foreach ($admins as $admin) {
    $admin->notify(new MissionLocaleDemandeNotification($localMission));
}

    return redirect()->route('local_missions.index')->with('success', 'Mission locale créée avec succès');
}




    /**
     * Affiche la liste des missions locales.
     */



    /**
     * Affiche la page pour soumettre un rapport de mission.
     */
    public function createReport($id)
    {
        $mission = LocalMission::findOrFail($id);

        return view('missions.local.create_report', compact('mission'));
    }

    /**
     * Soumet un rapport de mission.
     */
    public function submitReport(Request $request, $id)
    {
        $validatedData = $request->validate([
            'reportDetails' => 'required|string',
            'reportDate' => 'required|date',
            'receipt' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $mission = LocalMission::findOrFail($id);

        // Gère le fichier de réception (si fourni)
        if ($request->hasFile('receipt')) {
            $path = $request->file('receipt')->store('local_receipts', 'public');
            $mission->receipt_path = $path;
        }

        $mission->report_details = $validatedData['reportDetails'];
        $mission->report_date = $validatedData['reportDate'];
        $mission->status = 'Reported'; // Changez le statut si nécessaire
        $mission->save();

        return redirect()->route('local_missions.index')->with('success', 'Rapport soumis avec succès.');
    }
    /**
 * Affiche les missions locales pour l'administrateur.
 */
public function adminIndex()
{
    $missions = LocalMission::all(); // Liste complète des missions
    return view('admin.local_missions.index', compact('missions'));
}

/**
 * Approuve une mission locale.
 */
public function approve($id)
{
    $mission = LocalMission::findOrFail($id);
    $mission->status = 'Approved';
    $mission->save();

    // Envoyer une notification à l'employé
    $employee = $mission->employee;  // Assurez-vous que la relation est correctement définie
    $employee->user->notify(new MissionStatusChanged($mission, 'Approuvée')); // Notification envoyée à l'utilisateur associé à l'employé

    return redirect()->route('admin.local_missions.index')->with('success', 'Mission approuvée avec succès.');
}

/**
 * Rejette une mission locale.
 */
public function reject($id)
{
    $mission = LocalMission::findOrFail($id);
    $mission->status = 'Rejected';
    $mission->save();

    // Envoyer une notification à l'employé
    $employee = $mission->employee;
    $employee->user->notify(new MissionStatusChanged($mission, 'Rejetée')); // Notification envoyée à l'utilisateur associé à l'employé

    return redirect()->route('admin.local_missions.index')->with('success', 'Mission rejetée avec succès.');
}


public function edit($id)
{
    $mission = LocalMission::findOrFail($id); // Récupérer la mission avec l'ID
    return view('missions.local.edit', compact('mission'));
}
public function update(Request $request, $id)
{
    // Valider les données
    $request->validate([
        'region' => 'required|string|max:255',
        'purpose' => 'required|string|max:500',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'license_plate' => 'required|string|max:20',
        'car_type' => 'required|string|max:50',
        'fuel_type' => 'required|string|max:50',
        'carte_carburant' => 'required|numeric',
        'distance_traveled' => 'required|numeric',
        'fuel_cost' => 'nullable|numeric',
    ]);

    // Récupérer la mission et la mettre à jour
    $mission = LocalMission::findOrFail($id);
    $mission->update($request->all());

    // Rediriger après la mise à jour
    return redirect()->route('local_missions.index')->with('success', 'Mission mise à jour avec succès.');
}

public function destroy($id)
{
    // Trouver la mission par ID
    $mission = LocalMission::findOrFail($id);

    // Supprimer la mission
    $mission->delete();

    // Rediriger avec un message de succès
    return redirect()->route('local_missions.index')->with('success', 'Mission supprimée avec succès.');
}

}
