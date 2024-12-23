<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Définir la table associée à ce modèle
    protected $table = 'roles';

    // Les attributs qui sont assignables en masse
    protected $fillable = ['name'];
    protected $primaryKey = 'role_id';


    /**
     * Relation avec les utilisateurs (un rôle peut avoir plusieurs utilisateurs).
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
