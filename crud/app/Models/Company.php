<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // --------------------------------- Mutator... store data into database ------------------------------------------

    public function setNameAttribute($data){
        $this->attributes['name']= ucwords($data);
    }

    // --------------------------------- Accessor.... get data into database ------------------------------------------

    public function getNameAttribute($data){
        return strtoupper($data);
    }
}

