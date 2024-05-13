<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{

    public $timestamps = false ;
    public function users()
    {
        return $this->belongsToMany(User::class ,'cours_users', 'cours_id', 'user_id');
    }


    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function planning()
    {
        return $this->hasMany(Planning::class);
    }

}
