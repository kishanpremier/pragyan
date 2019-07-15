<?php

namespace App\Models\School;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
   use Notifiable;
       
   protected $table = 'chapter';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_id','subject_id','chapter_name', 'created_at', 'updated_at'];
   
}
