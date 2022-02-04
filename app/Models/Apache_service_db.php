<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apache_service_db extends Model
{
    use HasFactory;
    protected $filable = [
        'name_url','time_search','status'
    ];
}
