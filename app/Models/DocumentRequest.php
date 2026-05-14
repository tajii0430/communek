<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DocumentRequest extends Model
{
    protected $fillable = [

        'user_id',

        'resident_name',

        'barangay',

        'document_type',

        'purpose',

        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
