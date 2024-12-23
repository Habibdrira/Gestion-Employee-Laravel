<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // La table associée à ce modèle
    protected $table = 'employees';

    // La clé primaire de la table
    protected $primaryKey = 'employee_id';

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'user_id', 'address', 'city', 'position', 'salary',
    ];

    /**
     * Relation avec le modèle User.
     * Un employé appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function localMissions()
    {
        return $this->hasMany(LocalMission::class);
    }

    public function internationalMissions()
    {
        return $this->hasMany(InternationalMission::class);
    }
}
