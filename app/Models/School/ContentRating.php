<?php

namespace App\Models\School;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ContentRating extends Model
{
     use Notifiable;
       
   protected $table = 'content_rating';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'content_id', 'rating','created_at', 'updated_at'];
}
