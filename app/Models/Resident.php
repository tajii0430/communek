<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $fillable = [

        'full_name',
        'contact_number',
        'age',
        'gender',
        'birthdate',
        'civil_status',
        'address',
        'barangay',
        'profile_photo',
        'resident_id_number',

    ];
}
