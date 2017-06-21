<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dotadetail extends Model
{
    protected $primaryKey = 'username';
    protected $fillable = [
        'username',
    ];

    public function user()
    {
        return $this->belongsTo('App/User', 'username', 'username');
    }
}
