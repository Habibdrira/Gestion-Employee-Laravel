<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\StatusUser;


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

    // Mettre à jour le statut dans la table `status_user`
    $status_user->status = $request->status;
    $status_user->save();

    // Mettre à jour la colonne `status_user` dans la table `users`
    $user->status_user = $request->status;
    $user->save();

    // Retourner un message de succès
    return back()->with('success', 'Statut mis à jour avec succès!');
}
    

}
