<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeConge extends Model
{
    use HasFactory;

    protected $table = 'demande_conges';
    protected $primaryKey = 'id_conge';
    public $timestamps = true;

    protected $fillable = [
        'employee_id',
        'date_debut',
        'date_fin',
        'type',
        'commentaire',
        'statut',
    ];
    protected $dates = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
    ];

    /**
     * Relation : une demande de congé appartient à un employé.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    
}
