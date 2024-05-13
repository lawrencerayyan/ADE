<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    public $timestamps = false ;
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function cours()
    {
        return $this->hasMany(Cours::class  );
    }
}
