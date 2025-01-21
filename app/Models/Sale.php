<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // Si nécessaire, spécifiez la table correspondante (par défaut, Laravel s'attend à ce que la table soit `sales`)
    protected $table = 'sales'; 

    // Si vous souhaitez autoriser uniquement certaines colonnes à être modifiées
    protected $fillable = ['amount', 'created_at'];
}
