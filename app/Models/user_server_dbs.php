<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_server_dbs extends Model
{
    use HasFactory;
    protected $filable = [
        'url_name','user_id','date_down','date_up','date_time_reset'
    ];
}
