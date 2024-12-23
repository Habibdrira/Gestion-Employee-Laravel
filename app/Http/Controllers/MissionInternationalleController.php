<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InternationalMission;
use App\Notifications\MissionStatusInternationnaleChanged;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MissionInternationalleController extends Controller
{
    // Vue pour les utilisateurs
    public function userIndex()
    {
        $user = Auth::user();

        // Récupérer les missions internationales associées à cet utilisateur
        $missions = InternationalMission::where('user_id', $user->id)->get();
            return view('employee.missions.international.user.index', compact('missions'));
    }

    public function create()
    {
        return view('employee.missions.international.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mission_id' => 'required|unique:international_missions,mission_id',
            'superviseur' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'destination' => 'required|string|max:255',
            'expenses' => 'required|numeric',
            'interim' => 'nullable|string|max:255',
        ]);

        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Vérifier si l'utilisateur est associé à un employé
        $employee = Employee::where('user_id', $user->id)->first();

        if (!$employee) {
            return redirect()->back()->withErrors('Aucun employé associé à cet utilisateur.');
        }

        $mission = new InternationalMission();
        $mission->employee_id = $employee->employee_id; // ID de l'employé associé
        $mission->user_id = $user->id; // ID de l'utilisateur
        $mission->mission_id = $request->mission_id;
        $mission->superviseur = $request->superviseur;
        $mission->purpose = $request->purpose;
        $mission->start_date = $request->start_date;
        $mission->end_date = $request->end_date;
        $mission->destination = $request->destination;
        $mission->expenses = $request->expenses;
        $mission->interim = $request->interim;
        $mission->status = 'pending'; // Statut par défaut
        $mission->save();

        // Notifications aux administrateurs
        /*$admins = User::where('role', 'admin')->get();*/

        /*foreach ($admins as $admin) {
            $admin->notify(new NewInternationalMissionNotification($mission));
        }
*/
        return redirect()->route('missions.international.user.index')->with('success', 'Demande de mission internationale créée avec succès.');
    }






    // Afficher le formulaire de modification d'une mission
    public function edit($id)
    {
        $mission = InternationalMission::findOrFail($id);
        return view('employee.missions.international.user.edit', compact('mission'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'mission_id' => 'required',
            'superviseur' => 'required',
            'purpose' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'destination' => 'required',
            'expenses' => 'required|numeric',
        ]);

        $mission = InternationalMission::findOrFail($id);
        $mission->mission_id = $request->mission_id;
        $mission->superviseur = $request->superviseur;
        $mission->purpose = $request->purpose;
        $mission->start_date = $request->start_date;
        $mission->end_date = $request->end_date;
        $mission->destination = $request->destination;
        $mission->expenses = $request->expenses;
        $mission->interim = $request->interim;
        $mission->save();

        return redirect()->route('missions.international.user.index')->with('success', 'Mission mise à jour avec succès.');
    }

    // Supprimer la demande de mission
    public function destroy($id)
    {
        $mission = InternationalMission::findOrFail($id);
        $mission->delete();
        return redirect()->route('missions.international.user.index')->with('success', 'Mission supprimée avec succès.');
    }





    // Vue pour les administrateurs
    public function adminIndex()
    {
        $missions = InternationalMission::all(); // Tous les missions

        return view('admin.internationale_misssion.index', compact('missions'));
    }

    // Créer un rapport pour une mission approuvée
    public function createMissionReportInternational($id)
    {
        $mission = InternationalMission::findOrFail($id);

        // Vérifier si la mission est approuvée
        if ($mission->status !== 'approved') {
            return redirect()->route('missions.international.user.index')->with('error', 'Vous ne pouvez créer un rapport que pour une mission approuvée.');
        }

        return view('missions.international.user.report.create', compact('mission'));
    }

    // Soumettre un rapport
    public function submitInternationalMissionReport(Request $request, $id)
    {
        $validatedData = $request->validate([
            'reportDetails' => 'required|string',
            'reportDate' => 'required|date',
            'receipt' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $mission = InternationalMission::findOrFail($id);

        if ($request->hasFile('receipt')) {
            $path = $request->file('receipt')->store('international_receipts', 'public');
            $mission->receipt_path = $path;
        }

        $mission->report_details = $validatedData['reportDetails'];
        $mission->report_date = $validatedData['reportDate'];
        $mission->save();

        return redirect()->route('missions.international.user.index')->with('success', 'Rapport soumis avec succès.');
    }

    // Approuver une mission
    public function approveMission($id)
{
    $mission = InternationalMission::findOrFail($id);
    $mission->status = 'approved';
    $mission->save();

    // Envoyer une notification à l'employé
    $employee = $mission->employee; // Assurez-vous que la relation est correctement définie
    $employee->user->notify(new MissionStatusInternationnaleChanged($mission, 'Approuvée'));

    return redirect()->route('missions.international.admin.index')->with('success', 'Mission approuvée avec succès.');
}

public function rejectMission($id)
{
    $mission = InternationalMission::findOrFail($id);
    $mission->status = 'rejected';
    $mission->save();

    // Envoyer une notification à l'employé
    $employee = $mission->employee;
    $employee->user->notify(new MissionStatusInternationnaleChanged($mission, 'Rejetée'));

    return redirect()->route('missions.international.admin.index')->with('success', 'Mission rejetée avec succès.');
}



}
