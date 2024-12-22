<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DemandeConge;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\CongeStatusUpdated;
use App\Notifications\DemandeCongeNotification;

class DemandeCongeController extends Controller
{
    // Afficher le formulaire de demande de congé
    public function create()
    {
        return view('employee.demande_conge.create');
    }

    // Stocker la demande de congé
    public function store(Request $request)
    {
        $request->validate([
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'type' => 'required|string',
            'commentaire' => 'nullable|string',
        ]);

        // Récupérer l'employé lié à l'utilisateur connecté
        $employee = Employee::where('user_id', Auth::id())->firstOrFail();

        // Créer une nouvelle demande de congé
        DemandeConge::create([
            'employee_id' => $employee->employee_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'type' => $request->type,
            'commentaire' => $request->commentaire,
            'statut' => 'En attente',
        ]);

        // Rediriger vers la liste des demandes de congé avec un message de succès
        return redirect()->route('employee.demande_conge.index')->with('success', 'Demande de congé soumise.');
    }

    // Afficher la liste des demandes de congé
    public function index()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Récupérer l'employé associé à l'utilisateur
        $employee = $user->employee;

        // Vérifier si l'employé existe
        if (!$employee) {
            return redirect()->back()->with('error', 'Aucun employé associé à cet utilisateur.');
        }

        // Récupérer les demandes de congé
        $demandes = $employee->demandesConge;

        // Nombre de jours de congé utilisés
        $nbrjcongeUtilise = $employee->nbrjconge;

        // Nombre total de jours de congé
        $nbrjcongeTotal = 30;

        // Passer les données à la vue
        return view('employee.demande_conge.index', [
            'demandes' => $demandes,
            'nbrjcongeUtilise' => $nbrjcongeUtilise,
            'nbrjcongeTotal' => $nbrjcongeTotal,
        ]);
    }

    // Mettre à jour le statut de la demande de congé
    public function updateStatus(Request $request, $id)
    {
        // Récupérer la demande de congé
        $demandeConge = DemandeConge::findOrFail($id);

        // Valider le statut
        $request->validate([
            'status' => 'required|in:acceptée,refusée',
        ]);

        // Mettre à jour le statut de la demande
        $status = $request->input('status'); // "acceptée" ou "refusée"
        $demandeConge->statut = $status;
        $demandeConge->save();

        // Notifier l'utilisateur
        $employee = Employee::findOrFail($demandeConge->employee_id);
        if ($employee->user) {
            $employee->user->notify(new DemandeCongeNotification($demandeConge, $status));  // Déclenche la notification
        }

        // Rediriger avec un message de succès
        return redirect()->route('employee.demande_conge.index')->with('success', 'Le statut de la demande a été mis à jour.');
    }
}
