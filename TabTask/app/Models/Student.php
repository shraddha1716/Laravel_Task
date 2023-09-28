<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'address', 'class', 'teacher', 'cast'];

    public function class_relation()
    {
        return $this->belongsTo(Classe::class,'class', 'id'); // Replace with your foreign key column name
    }

    public function teacher_relation()
    {
        return $this->belongsTo(Teacher::class,'teacher', 'id'); // Replace with your foreign key column name
    }
}
