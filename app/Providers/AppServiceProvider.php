<?php
namespace App\Providers;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Models\StatusUser;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Écouter l'événement de déconnexion
        Event::listen(Logout::class, function ($event) {
            // Récupérer l'utilisateur qui se déconnecte
            $user = $event->user;

            // Mettre à jour la table status_user à 'offline'
            $statusUser = StatusUser::where('user_id', $user->id)->first();

            if ($statusUser) {
                $statusUser->status = 'offline';
                $statusUser->save();
            }

            // Mettre à jour la table users en définissant le statut à 'offline'
            $user->status_user = 'offline';
            $user->save();
        });
    }
}
