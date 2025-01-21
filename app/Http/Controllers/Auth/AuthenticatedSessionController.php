<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\StatusUser; // Ajouter le modèle StatusUser
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Http\Controllers\StatusController;
use App\Models\WorkMinute;
use Carbon\Carbon;
use App\Models\user;

class AuthenticatedSessionController extends Controller
{
    /**
     * Afficher la vue de connexion.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Gérer la requête d'authentification entrante.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authentifier l'utilisateur
        $request->authenticate();
        
        // Régénérer la session pour éviter les attaques par fixation de session
        $request->session()->regenerate();

        // Enregistrer le nom de l'utilisateur dans la session pour l'affichage
        session(['name' => Auth::user()->name]);

        // Redirection personnalisée en fonction du rôle de l'utilisateur
        $user = Auth::user(); // Récupérer l'utilisateur authentifié

        // Vérifier le rôle de l'utilisateur et rediriger en conséquence
        if ($user->role_id == 1) {
            // Rediriger l'administrateur vers le tableau de bord admin
            return redirect()->route('admin.dashboard')->with('success', 'Bienvenue Administrateur, ' . $user->name);
        }

        // Rediriger les employés vers leur tableau de bord
        return redirect()->route('employee.dashboard')->with('success', 'Bienvenue Employé, ' . $user->name);
    }

    /**
     * Détruire une session authentifiée et mettre à jour le statut de l'utilisateur.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        if ($user) {
            // Mettre à jour le statut de l'utilisateur en "offline"
            $status_user = StatusUser::where('user_id', $user->id)->first();

           /* if ($status_user->status == 'active') {
                $this->calculateAndStoreMinutes($user, $status_user->start_time, now());
                $status_user->start_time = null; // Réinitialiser l'heure de début
            }
*/
            if ($status_user) {
                $status_user->status = 'offline';
                $status_user->end_time = now(); // Enregistrer l'heure de fin
                $status_user->save();
            }
        }

        // Déconnecter l'utilisateur
        Auth::guard('web')->logout();

        // Invalider la session et régénérer le token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Rediriger vers la page d'accueil ou de connexion
        return redirect('/')->with('success', 'Vous êtes déconnecté.');
    }

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
