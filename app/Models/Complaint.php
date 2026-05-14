<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{

    protected $fillable = [

        'complainant_name',
        'category',
        'description',
        'status',
        'barangay',
        'image',
        'latitude',
        'longitude'

    ];
}
