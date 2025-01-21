<?php
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

    // Définir les valeurs possibles pour le champ 'day'
    const DAYS_OF_WEEK = [
        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 
        'Friday', 'Saturday', 'Sunday'
    ];

    /**
     * Relation vers le modèle Employee.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    /**
     * Vérifier si la valeur du jour est valide.
     */
    public function setDayAttribute($value)
    {
        if (!in_array($value, self::DAYS_OF_WEEK)) {
            throw new \InvalidArgumentException("Jour invalide.");
        }
        $this->attributes['day'] = $value;
    }
}
