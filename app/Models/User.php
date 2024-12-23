<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'password','status', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        if (is_null($this->lastname)) {
            return "{$this->name}";
        }

        return "{$this->name} {$this->lastname}";
    }

    /**
     * Set the user's password.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Relation avec le rôle (un utilisateur appartient à un rôle).
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id'); // Modifier la clé primaire si nécessaire
    }



    public function status()
    {
        return $this->hasOne(Status::class);
    }

    public function internationalMissions()
    {
        return $this->hasMany(InternationalMission::class);
    }

    /**
     * Récupérer les utilisateurs avec le rôle spécifié.
     */
    public static function getUsersByRole($roleName)
    {
        return self::whereHas('role', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })->get();
    }

    // Dans le modèle User
public function fichePaies()
{
    return $this->hasMany(FichePaie::class);
}
public function employee()
{
    return $this->hasOne(Employee::class, 'user_id', 'id');
}



}
