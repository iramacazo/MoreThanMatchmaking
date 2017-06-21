<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Herolink extends Model
{
    protected $primaryKey = 'username';
    protected $table = 'herolink';
    public $timestamps = false;
}
