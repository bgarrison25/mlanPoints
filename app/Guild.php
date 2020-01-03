<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    protected $fillable = [
        'name', 'points'
    ];
}