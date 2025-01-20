<?php

// App/Http/Controllers/WorkHoursController.php

namespace App\Http\Controllers;

use App\Models\StatusUser;
use App\Models\WorkHour;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkHoursController extends Controller
{
    /**
     * Calculer et enregistrer les heures de travail après un changement de statut.
     */
    public function updateWorkHours(Request $request)
    {
        // Récupérer l'utilisateur connecté
        $user = auth()->user();

        // Trouver le dernier statut de l'utilisateur
        $status_user = StatusUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        // Si l'utilisateur a changé son statut à "offline" ou "busy" et a un début et une fin
        if ($status_user && $status_user->start_time && $status_user->end_time) {
            // Calculer la durée en heures entre start_time et end_time
            $worked_hours = Carbon::parse($status_user->start_time)->diffInHours($status_user->end_time);

            // Récupérer le jour de la semaine actuel (en format 'monday', 'tuesday', etc.)
            $dayOfWeek = Carbon::now()->format('l'); // Par exemple 'Monday'

            // Vérifier si une entrée existe déjà pour ce jour dans la table work_hours
            $workHour = WorkHour::where('user_id', $user->id)
                                ->where('day', strtolower($dayOfWeek))
                                ->first();

            if ($workHour) {
                // Si une entrée existe déjà, on ajoute les heures travaillées
                $workHour->hours_worked += $worked_hours;
                $workHour->save();
            } else {
                // Sinon, créer une nouvelle entrée dans la table work_hours
                WorkHour::create([
                    'user_id' => $user->id,
                    'day' => strtolower($dayOfWeek),
                    'hours_worked' => $worked_hours,
                ]);
            }

            return back()->with('success', 'Heures de travail mises à jour avec succès!');
        }

        // Si pas de temps de début ou de fin, retourner un message d'erreur
        return back()->with('error', 'Impossible de calculer les heures de travail. Assurez-vous que les heures de début et de fin sont définies.');
    }

    /**
     * Afficher les heures de travail d'un utilisateur.
     */
    public function showWorkHours($userId)
    {
        $workHours = WorkHour::where('user_id', $userId)->get();
        return view('work_hours.index', compact('workHours'));
    }
}
