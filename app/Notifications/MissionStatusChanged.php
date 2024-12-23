<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\LocalMission;

class MissionStatusChanged extends Notification
{
    use Queueable;

    protected $mission;
    protected $status;

    public function __construct(LocalMission $mission, $status)
    {
        $this->mission = $mission;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];  // On envoie uniquement dans la base de données
    }


    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Le statut de votre mission locale ' . $this->mission->mission_id . ' a été mis à jour : ' . $this->status,
            'mission_id' => $this->mission->mission_id,
            'status' => $this->status,
        ];
    }

    // Méthode toArray pour une version générique de la notification
    public function toArray($notifiable)
    {
        return $this->toDatabase($notifiable);  // Réutilisation de toDatabase
    }
}
