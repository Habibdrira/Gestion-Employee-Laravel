<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\StatusUser;
use App\Models\WorkMinute;
use Carbon\Carbon;

class StatusController extends Controller
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
        // Valider la requête
        $request->validate([
            'status' => 'required|in:active,offline,busy',
        ]);

        // Récupérer l'utilisateur connecté
           // Récupérer l'utilisateur connecté
           $user = auth()->user();

        // Trouver ou créer le statut de l'utilisateur
        $status_user = StatusUser::firstOrCreate(
            ['user_id' => $user->id],
            ['status' => 'offline', 'start_time' => null, 'end_time' => null]
        );

        // Si l'utilisateur passe de "active" à un autre statut, calculer les minutes travaillées
        if ($status_user->status == 'active' && $request->status != 'active') {
            $this->calculateAndStoreMinutes($user, $status_user->start_time, now());
            $status_user->start_time = null; // Réinitialiser l'heure de début
        }

        // Si le statut passe à "active", enregistrer l'heure de début
        if ($request->status == 'active') {
            $status_user->start_time = now();
        } else {
            $status_user->end_time = now(); // Enregistrer l'heure de fin pour "offline" ou "busy"
        }

        // Mettre à jour le statut de l'utilisateur
        $status_user->status = $request->status;
        $status_user->save();

        return back()->with('success', 'Statut mis à jour avec succès !');
    }

    /**
     * Calculer les minutes travaillées et les enregistrer dans la table `work_minutes`.
     */
    private function calculateAndStoreMinutes($user, $start_time, $end_time)
    {
        if ($start_time && $end_time) {
            $start_time = Carbon::parse($start_time);
            $end_time = Carbon::parse($end_time);

            // Calculer la différence en minutes
            $minutes_worked = $start_time->diffInMinutes($end_time);

            // Enregistrer les minutes travaillées dans `work_minutes`
            WorkMinute::create([
                'user_id' => $user->id,
                'minutes_worked' => $minutes_worked,
                'day' => $start_time->day,
            ]);
        }
    }
}
