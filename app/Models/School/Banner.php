<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Banner extends Model
{
    use Notifiable;

    protected $table = 'banner';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doc_type','video_link','image_name','document', 'created_at', 'updated_at'];
}
