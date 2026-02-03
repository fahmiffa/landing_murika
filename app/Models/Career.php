<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Career extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($career) {
            if (empty($career->slug)) {
                $career->slug = Str::slug($career->name) . '-' . Str::random(5);
            }
        });
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now()->startOfDay());
    }
}
