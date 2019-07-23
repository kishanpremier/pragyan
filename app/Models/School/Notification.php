<?php

namespace App\Models\School;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use Notifiable;

    protected $table = 'notification';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'image', 'desc'];


}
