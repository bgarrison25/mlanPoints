<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointLog extends Model
{
    protected $fillable = [
        'user_id', 'guild_id', 'amount', 'reason'
    ];

    public function guild()
    {
        return $this->belongsTo('App\Guild');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}