<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public $casts = [
        'submitted' => 'boolean',
        'locked' => 'boolean'
    ];

}
