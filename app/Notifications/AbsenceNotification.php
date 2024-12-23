<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AbsenceNotification extends Notification
{
    use Queueable;

    protected $absence;
    protected $action;

    public function __construct($absence, $action)
    {
        $this->absence = $absence;
        $this->action = $action; // "added" pour un ajout, "updated" pour une modification
    }

    // On enlève le mail et on garde uniquement la base de données
    public function via($notifiable)
    {
        return ['database'];  // On envoie uniquement dans la base de données
    }

    public function toDatabase($notifiable)
    {
        $actionMessage = $this->action === 'added'
            ? "Une nouvelle absence a été ajoutée pour " . $this->absence->employee->user->name
            : "L'absence de " . $this->absence->employee->user->name . " a été modifiée.";

        return [
            'absence_id' => $this->absence->id_absence,
            'employee_name' => $this->absence->employee->user->name,
            'message' => $actionMessage,
        ];
    }

}
