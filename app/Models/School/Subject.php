<?php

namespace App\Models\School;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    
    use Notifiable;
       
   protected $table = 'subject';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_name','subject_image', 'created_at', 'updated_at'];
}
