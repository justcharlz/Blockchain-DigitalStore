<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class stores extends Model
{
  public function users()
  {
      return $this->belongsTo('App\User');
  }
}
