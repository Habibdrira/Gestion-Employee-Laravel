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

    /*
      Get the array representation of the notification.
     
    public function toArray($notifiable)

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

       
        public function toArray($notifiable)
{
    if ($this->absence === null) {
        return [
            'message' => "Aucune absence définie.",
            'date' => null,
            'reason' => null,
            'duration' => null,
        ];
    }

    return [
        'message' => "Une nouvelle absence a été ajoutée pour le {$this->absence->date}.",
        'date' => $this->absence->date,
        'reason' => $this->absence->reason,
        'duration' => $this->absence->duration,
    ];
}


}
