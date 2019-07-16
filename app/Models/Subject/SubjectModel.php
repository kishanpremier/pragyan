<?php

namespace App\Models\Subject;

use Illuminate\Database\Eloquent\Model;

class SubjectModel extends Model
{
    protected $table = 'class';
    protected $fillable = [
        'class_name'
    ];
}
