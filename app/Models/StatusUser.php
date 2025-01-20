<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusUser extends Model
{
    use HasFactory;

    protected $table = 'status_user';
    protected $fillable = ['user_id', 'status', 'start_time', 'end_time'];

   

    /**
     * Relation avec l'utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
