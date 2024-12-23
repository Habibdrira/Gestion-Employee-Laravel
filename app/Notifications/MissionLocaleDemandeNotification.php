<?php

namespace App\Notifications;

use App\Models\LocalMission;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MissionLocaleDemandeNotification extends Notification
{
    use Queueable;

    public $mission;

    public function __construct(LocalMission $mission)
    {
        $this->mission = $mission;
    }

    /**
     * Définir les canaux de notification.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Transformer la notification en structure pour le stockage en base de données.
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => "Une mission locale a été soumise.",
            'employee_name' => $this->mission->employee->user->getFullNameAttribute(),
            'region' => $this->mission->region,
            'status' => $this->mission->status,
            'mission_id' => $this->mission->id,
            'view_url' => route('admin.local_missions.index'),
        ];
    }



    /**
     * Transformer la notification en structure générique (optionnel si utilisé ailleurs).
     */
    public function toArray($notifiable)
    {
        return $this->toDatabase($notifiable); // Réutilisation de toDatabase
    }
}
