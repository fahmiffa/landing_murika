<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($footer) {
            $footer->slug = \Illuminate\Support\Str::slug($footer->title);
        });
        static::updating(function ($footer) {
            $footer->slug = \Illuminate\Support\Str::slug($footer->title);
        });
    }
}
