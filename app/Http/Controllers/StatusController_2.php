<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\StatusUser;
use App\Models\WorkHour;

class StatusController_2 extends Controller
{
    public function index()
    {
        // Pour cet exemple, nous utilisons un user_id statique (1)
        $userId = 1;

        // Récupérer le dernier statut de l'utilisateur
        $status = Status::where('user_id', $userId)->latest()->first();

        // Passer les données à la vue
        return view('status.index', compact('status'));
    }

    public function update(Request $request)
    {
        // Valider les données envoyées depuis le formulaire
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        // Utiliser un user_id statique pour cet exemple
        $userId = 1;

        // Récupérer ou créer un statut
        $status = Status::where('user_id', $userId)->latest()->first();

        if ($status) {
            // Mettre à jour un statut existant
            $status->update([
                'status' => $request->status,
            ]);
        } else {
            // Créer un nouveau statut
            Status::create([
                'user_id' => $userId,
                'status' => $request->status,
            ]);
        }

        // Rediriger avec un message de succès
        return redirect()->route('status.index')->with('success', 'Statut mis à jour avec succès !');
    }


    public function updateStatus(Request $request)
    {
        // Valider la requête pour s'assurer que le statut est correct
        $request->validate([
            'status' => 'required|in:active,offline,busy',
        ]);
    
        // Récupérer l'utilisateur connecté
        $user = auth()->user();
    
        // Trouver ou créer le statut associé à cet utilisateur
        $status_user = StatusUser::firstOrCreate(
            ['user_id' => $user->id], // Si le statut existe déjà pour cet utilisateur, le récupérer
            ['status' => 'offline']    // Sinon, initialiser avec le statut par défaut
        );
    
        // Initialiser une variable pour l'heure de début et de fin
        $start_time = $status_user->start_time;
        $end_time = now(); // L'heure actuelle est l'heure de fin
    
        // Si le statut est "active", on définit le start_time si c'est un changement de statut
        if ($request->status == 'active' && $status_user->status != 'active') {
            $status_user->status = 'active';
            $status_user->start_time = now();  // Définir l'heure de début quand l'utilisateur devient actif
            $status_user->end_time = null;    // Réinitialiser l'heure de fin
        }
    
        // Si le statut est "offline", on définit l'heure de fin
        if ($request->status == 'offline' && $status_user->status != 'offline') {
            $status_user->status = 'offline';
            $status_user->end_time = now();   // Définir l'heure de fin quand l'utilisateur devient offline
            // Calculer les heures travaillées
            $hours_worked = $start_time ? $end_time->diffInHours($start_time) : 0;
            // Enregistrer les heures travaillées dans la table work_hours
            $this->storeWorkHours($user, $hours_worked);
        }
    
        // Si le statut est "busy", on définit l'heure de début si c'est un changement
        if ($request->status == 'busy' && $status_user->status != 'busy') {
            $status_user->status = 'busy';
            $status_user->start_time = now(); // Définir l'heure de début quand l'utilisateur devient busy
            $status_user->end_time = null;    // Réinitialiser l'heure de fin
        }
    
        // Sauvegarder les modifications dans la table `status_user`
        $status_user->save();
    
        // Mettre à jour la colonne `status_user` dans la table `users`
        $user->status_user = $request->status;
        $user->save();
    
        // Retourner un message de succès
        return back()->with('success', 'Statut mis à jour avec succès!');
    }
    
    // Méthode pour stocker les heures de travail dans la table work_hours
    protected function storeWorkHours($user, $hours_worked)
    {
        // Vérifier si une entrée pour ce jour existe déjà
        $dayOfWeek = now()->format('l'); // Par exemple, 'Monday'
        
        $workHour = WorkHour::where('user_id', $user->id)
            ->where('day', strtolower($dayOfWeek))
            ->first();
        
        if ($workHour) {
            // Si une entrée existe déjà, on met à jour les heures travaillées
            $workHour->hours_worked += $hours_worked;
            $workHour->save();
        } else {
            // Sinon, on crée une nouvelle entrée
            WorkHour::create([
                'user_id' => $user->id,
                'day' => strtolower($dayOfWeek),
                'hours_worked' => $hours_worked
            ]);
        }
    }
    

}
