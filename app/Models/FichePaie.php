<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichePaie extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'montant',
        'filename',  // Assurez-vous que c'est bien 'filename'
        'penalite_absence', // Ajouter ce champ pour représenter la pénalité des absences

    ];


   // Relation avec l'utilisateur
   public function user()
   {
       return $this->belongsTo(User::class);
   }

   // Relation avec les primes
   public function primes()
   {
       return $this->hasMany(Prime::class, 'fiche_paie_id');
   }
}
