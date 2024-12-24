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
        // Indiquez explicitement la clé étrangère et la clé primaire
        return $this->hasMany(Absence::class, 'employee_id', 'employee_id');
    }


    public function localMissions()
    {
        return $this->hasMany(LocalMission::class, 'employee_id', 'employee_id');
    }


    public function primes()
{
    return $this->hasMany(Prime::class, 'employee_id', 'employee_id');
}

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

    public function demandesConge()
    {
        return $this->hasMany(DemandeConge::class, 'employee_id');
    }
    
    public function performances()
    {
        return $this->hasMany(Performance::class, 'employee_id', 'employee_id');
    }
    

}




