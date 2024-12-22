<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $table = 'user_logs'; // Nom de la table

    protected $primaryKey = 'id'; // Clé primaire

    public $timestamps = true; // Active automatiquement created_at et updated_at

    protected $fillable = [
        'user_id',   // ID de l'utilisateur
        'status',    // Statut (Online, Offline, Pause)
        'logged_in_at', // Date et heure de connexion
        'logged_out_at', // Date et heure de déconnexion
    ];

    /**
     * Relation avec le modèle User.
     * Chaque log appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
