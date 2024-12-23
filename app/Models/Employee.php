<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // La table associée à ce modèle
    protected $table = 'employees';

    // Clé primaire de la table
    protected $primaryKey = 'employee_id';

    // Attributs assignables en masse
    protected $fillable = ['user_id', 'address', 'city', 'position', 'salary'];

    /**
     * Relation avec le modèle User.
     * Un employé appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relation avec Absences.
     * Un employé peut avoir plusieurs absences.
     */
    public function absences()
{
    return $this->hasMany(Absence::class, 'employee_id', 'employee_id');
}

    /**
     * Relation avec Primes.
     * Un employé peut recevoir plusieurs primes.
     */
    public function primes()
{
    return $this->hasMany(Prime::class, 'employee_id', 'employee_id');
}


    /**
     * Relation avec Missions Locales.
     */
    public function localMissions()
    {
        return $this->hasMany(LocalMission::class, 'employee_id');
    }

    /**
     * Relation avec Missions Internationales.
     */
    public function internationalMissions()
    {
        return $this->hasMany(InternationalMission::class, 'employee_id');
    }

    // Suppression des relations en cascade
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($employee) {
            $employee->absences()->delete();
            $employee->primes()->delete();
        });
    }
}
