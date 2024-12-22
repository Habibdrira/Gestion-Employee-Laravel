<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'amount', 'reason', 'status', 'admin_id'];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation avec l'admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
