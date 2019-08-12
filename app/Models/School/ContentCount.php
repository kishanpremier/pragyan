<?php

namespace App\Models\School;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ContentCount extends Model
{
    use Notifiable;
       
   protected $table = 'content_count';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'content_id', 'user_id','view_time','created_at', 'updated_at'];
}
