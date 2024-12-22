<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absence extends Model
{
    use HasFactory;

    protected $table = 'absences';
    protected $primaryKey = 'id_absence';
    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'date', 
        'reason',
        'duration',
    ];

    // Relation avec l'employé
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}


