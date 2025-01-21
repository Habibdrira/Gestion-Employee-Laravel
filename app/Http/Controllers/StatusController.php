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

}
