<?php
// Dans le modèle WorkMinute.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkMinute extends Model
{
    use HasFactory;

    protected $table = 'work_minutes';

    protected $fillable = [
        'employee_id',
        'minutes_worked',
        'day',
    ];

    const DAYS_OF_WEEK = [
        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 
        'Friday', 'Saturday', 'Sunday'
    ];

    // Définir la méthode statique pour récupérer les minutes de travail par jour
    public static function getWorkMinutesByDay()
    {
        $data = self::selectRaw('day, SUM(minutes_worked) as total_minutes')
                    ->groupBy('day')
                    ->orderByRaw('FIELD(day, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday")')
                    ->get();

        // Initialisation des données pour chaque jour de la semaine
        $workMinutesData = [];
        $daysOfWeek = self::DAYS_OF_WEEK;

        foreach ($daysOfWeek as $day) {
            $minutes = $data->firstWhere('day', $day);
            $workMinutesData[] = $minutes ? $minutes->total_minutes : 0;
        }

        return [$workMinutesData, $daysOfWeek];
    }

    // Relation vers le modèle Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function setDayAttribute($value)
    {
        if (!in_array($value, self::DAYS_OF_WEEK)) {
            throw new \InvalidArgumentException("Jour invalide.");
        }
        $this->attributes['day'] = $value;
    }
}
