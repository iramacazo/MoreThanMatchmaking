<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends_list extends Model
{
    protected $table = 'friends_list';
    protected $fillable = [
        'username',
        'friendUsername',
    ];
    public function user()
    {
        return $this->belongsTo('App/User', 'username', 'username');
    }
}
