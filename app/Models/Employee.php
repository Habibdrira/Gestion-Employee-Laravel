<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'employee_id';
    protected $fillable = ['user_id', 'address', 'city', 'position', 'salary', 'status'];



    public function fichepaies()
    {
        return $this->hasMany(Employee::class, 'employee_id', 'employee_id');

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // Relie `user_id` de `employees` à `id` de `users`
    }

    public function statusEmployee()
    {
        return $this->hasOne(StatusEmployee::class, 'employee_id', 'employee_id');
    }

    public function absences()
    {
        // Indiquez explicitement la clé étrangère et la clé primaire
        return $this->hasMany(Absence::class, 'employee_id', 'employee_id');
    }


    public function localMissions()
    {
        return $this->hasMany(LocalMission::class, 'employee_id', 'employee_id');
    }


    public function primes()
{
    return $this->hasMany(Prime::class, 'employee_id', 'employee_id');
}

    public function internationalMissions()
    {
        return $this->hasMany(InternationalMission::class, 'employee_id');
    }

    // Suppression des relations en cascade
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($employee) {
            $employee->absences()->delete();
            $employee->primes()->delete();
        });
    }

    public function demandesConge()
    {
        return $this->hasMany(DemandeConge::class, 'employee_id');
    }
    
    public function performances()
    {
        return $this->hasMany(Performance::class, 'employee_id', 'employee_id');
    }
   



}




