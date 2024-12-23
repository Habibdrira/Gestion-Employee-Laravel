<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\DemandeConge;
use App\Models\Employee;
use App\Notifications\DemandeCongeNotification;
use Carbon\Carbon;

class AdminDemandeCongeController extends Controller
{
    public function conges()
    {
       
       $demandes = DemandeConge::with('employee')->get(); // Charge la relation employee
       if ($demandes->isEmpty()) {
        // Handle no data scenario
        $demandes = []; // or send a custom message
    }
        return view('admin.demande_conge.conges', compact('demandes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:En attente,Approuvé,Rejeté'
        ]);
    
        try {
            $demande = DemandeConge::findOrFail($id);
            $demande->statut = $request->input('statut');
    
            if ($demande->statut === 'Approuvé') {
                $employee = $demande->employee;
    
                if (!$employee) {
                    return redirect()->back()->with('error', 'Aucun employé associé à cette demande.');
                }

    
                $date_debut = Carbon::parse($demande->date_debut);
                $date_fin = Carbon::parse($demande->date_fin);
                $jours_utilises = $date_debut->diffInDays($date_fin) + 1; // Inclure le dernier jour
    
                $jours_totaux = 30; // Le nombre total de jours alloués pour les congés annuels.

                $jours_disponibles = $jours_totaux - $employee->nbrjconge; // Jours restants.

                if ($jours_utilises <= $jours_disponibles) {
                 $employee->nbrjconge += $jours_utilises; // Ajoute les jours utilisés.
                 $employee->save();
                } else {
                 return redirect()->back()->with('error', 'Pas assez de jours disponibles.');
                }                
            }
    
            $demande->save();
            
            return redirect()->route('admin.demande_conge.conges')->with('success', 'Demande mise à jour.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }

        

        
    }
   
    
}


