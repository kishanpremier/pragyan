<?php

namespace App\Models\School;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class videocount extends Model
{
     use Notifiable;
       
   protected $table = 'video_count';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chapter_content_id','user_id','count', 'created_at', 'updated_at','view_time'];
}
