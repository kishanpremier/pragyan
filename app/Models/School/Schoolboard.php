<?php

namespace App\Models\School;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Schoolboard extends Model {

    use Notifiable;

    protected $table = 'state_board';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state_board_name', 'created_at', 'updated_at'];

}
