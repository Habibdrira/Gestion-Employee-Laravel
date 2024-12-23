<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Performance extends Model
{
    use HasFactory;

    protected $table = 'performances';
    protected $primaryKey = 'id_performance';
    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'date',
        'rating', 
    ];

    // Relation avec l'employé
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
