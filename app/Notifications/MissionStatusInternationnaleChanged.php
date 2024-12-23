<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\InternationalMission;

class MissionStatusInternationnaleChanged extends Notification
{
    use Queueable;

    protected $mission;
    protected $status;

    public function __construct(InternationalMission $mission, $status)
    {
        $this->mission = $mission;
        $this->status = $status;
    }

    /**
     * Définir les canaux de notification.
     */
    public function via($notifiable)
    {
        return ['database'];  // On envoie uniquement dans la base de données
    }

    /**
     * Transformer la notification en structure pour le stockage en base de données.
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Le statut de votre mission internationale ' . $this->mission->mission_id . ' a été mis à jour : ' . $this->status,
            'mission_id' => $this->mission->mission_id,
            'status' => $this->status,
            'employee_name' => $this->mission->employee->user->getFullNameAttribute(),
        ];
    }

}
