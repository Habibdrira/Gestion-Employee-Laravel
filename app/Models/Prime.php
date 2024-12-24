<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prime extends Model
{
    use HasFactory;

    protected $table = 'primes';
    protected $primaryKey = 'id_prime';
    public $timestamps = true;
    


    protected $fillable = [
        'employee_id',
        'amount',
        'date_awarded',
        'absence_factor',
        'performance_factor',
    ];
    

    // Relation avec l'employé
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}

