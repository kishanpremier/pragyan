<?php

namespace App\Models\School;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Chaptercontent extends Model
{
     use Notifiable;
       
   protected $table = 'chapter_content';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'chapter_id', 'class_id','subject_id','content_title','content_type','content_short_desc','content_link', 'created_at', 'updated_at'];
}
