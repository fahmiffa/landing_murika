<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'application_date' => 'date',
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
