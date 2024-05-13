<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    public $timestamps = false;

    protected $hidden = ['mdp'];

    protected $fillable = ['login', 'mdp', 'type'];

    protected $attributes = [
        'type' => 'NULL'
    ];


    public function getAuthPassword(){
        return $this->mdp;
    }

    public function isAdmin(){
        return $this->type == 'admin';
    }


    public function formations()
    {
        return $this->belongsToMany(Formation::class);
    }


    public function cours()
    {
        return $this->belongsToMany(Cours::class ,'cours_users', 'user_id', 'cours_id');
    }


}
