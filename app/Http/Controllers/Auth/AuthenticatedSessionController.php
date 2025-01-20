<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
     * Détruire une session authentifiée.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Déconnecter l'utilisateur
        Auth::guard('web')->logout();

        // Invalider la session et régénérer le token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Rediriger vers la page d'accueil
        return redirect('/');
    }
}
