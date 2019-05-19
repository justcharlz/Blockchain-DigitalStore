<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class stores extends Model
{
  protected $fillable = [
    'user_id', 'cover', 'name', 'music_genre', 'bpm', 'length', 'beat_price', 'transactionid', 'size', 'type', 'path', 'promoted'
  ];

  public function users()
  {
      return $this->belongsTo('App\User');
  }
}
