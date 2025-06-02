<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Linkuser extends Model
{
    public $timestamps = false;
    public $fillable = ['code', 'userid', 'email'];
}
