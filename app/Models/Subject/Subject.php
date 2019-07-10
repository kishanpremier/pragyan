<?php

namespace App\Models\Subject;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'class';
    protected $fillable = [
        'class_name'
    ];
}
