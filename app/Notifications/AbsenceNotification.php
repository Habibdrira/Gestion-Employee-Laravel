<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class AbsenceNotification extends Notification
{
    use Queueable;

    protected $absence;

    /**
     * Create a new notification instance.
     */
    public function __construct($absence)
    {
        $this->absence = $absence;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database']; // Storing in the database
    }

    /*
      Get the array representation of the notification.
     
    public function toArray($notifiable)
    {
        return [
            'message' => "Une nouvelle absence a été ajoutée pour le {$this->absence->date}.",  // Ensure 'message' is included here
            'date' => $this->absence->date,
            'reason' => $this->absence->reason,
            'duration' => $this->absence->duration,
        ];
    }
       */
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
