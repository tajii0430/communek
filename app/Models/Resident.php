<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{

    protected $fillable = [

        'user_id',
        'full_name',
        'age',
        'gender',
        'birthdate',
        'civil_status',
        'address',
        'barangay',

    ];
}
