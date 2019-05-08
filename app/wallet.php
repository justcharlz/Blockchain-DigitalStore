<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wallet extends Model
{
    //
    protected $fillable = ['wallet','user_id'];

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
