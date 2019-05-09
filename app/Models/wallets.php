<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class wallets extends Model
{
  protected $fillable = ['wallet','user_id'];

  public function users()
  {
      return $this->belongsTo('App\User');
  }
}
