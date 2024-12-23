<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    // Autoriser ces colonnes à être remplies en masse
    protected $fillable = ['user_id', 'amount', 'reason', 'status', 'admin_id'];

    /**
     * Relation avec le modèle User.
     * Un prêt appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Clé étrangère user_id
    }

    /**
     * Relation avec le modèle Admin.
     * Un prêt peut être approuvé ou rejeté par un admin.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id'); // Spécifie que admin_id dans loans correspond à admin_id dans admins
    }
}
