<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalMission extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'mission_id',
        'superviseur',
        'region',
        'purpose',
        'start_date',
        'end_date',
        'accompanying_person',
        'license_plate',
        'car_type',
        'fuel_type',
        'carte_carburant',
        'distance_traveled',
        'fuel_cost',
        'toll_expenses',
        'hotel',
        'indemnity',
        'total_cost',
        'status',
        'report_details',
        'report_date',
        'receipt_path',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

}
