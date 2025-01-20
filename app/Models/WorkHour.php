<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WorkHour extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'day', 'hours_worked'];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Calculer les heures travaillées en fonction du statut
    public function calculateWorkHours()
    {
        // Récupérer le statut de l'utilisateur
        $statusUser = StatusUser::where('user_id', $this->user_id)
            ->whereDate('start_time', '<=', Carbon::now())
            ->whereDate('end_time', '>=', Carbon::now())
            ->first();

        // Si l'utilisateur est actif
        if ($statusUser && $statusUser->status == 'active') {
            // Calculer la différence entre start_time et end_time
            $startTime = Carbon::parse($statusUser->start_time);
            $endTime = Carbon::parse($statusUser->end_time);

            // Calculer le nombre d'heures travaillées
            $this->hours_worked = $endTime->diffInHours($startTime);

            // Enregistrer les heures travaillées dans la base de données
            $this->save();
        }
    }
}
