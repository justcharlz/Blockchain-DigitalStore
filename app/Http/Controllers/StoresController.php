<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Stores;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class StoresController extends Controller
{

    public function Index()
    {

      return view('stores.index');
    }

    public function Create()
    {

      return view('stores.create');
    }

    public function Store($promoted = false)
    {

      //$stores = auth()->user()->stores;

      request()->validate([
        'name' => 'required',
        'music_genre' => 'required',
        'bpm' => 'required',
        'length' => 'required',
        'beat_price' => 'required',
              ]);

      if(request()->hasfile('cover')
      &&
      request()->validate([
                  'cover' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
              ])
      )
      {
        //cover image
        $file = request()->file('cover');
        $filedir = request()->file('cover')->store('upload/covers');
      }

        if( request()->hasfile('beat')
        &&
        request()->validate([
                    'beat' => 'required|file|mimetypes:audio/mpeg|max:7048',
                ])
        )
        {
        //beat
        $beat = request()->file('beat');
        $beatdir = request()->file('beat')->store('upload/beats');
      }

      $store = new Stores();
      $store->user_id = auth()->user()->id;
      $store->cover = $filedir;
      $store->name = request('name');
      $store->music_genre = request('music_genre');
      $store->bpm = request('bpm');
      $store->length = request('length');
      $store->beat_price = request('beat_price');
      $store->size = Storage::size($beatdir);
      $store->type = Storage::mimeType($beatdir);
      $store->path = $beatdir;
      $store->promoted = $promoted;
      $store->save();

      return redirect()->action('StoresController@create')->with('message','Beat Succefully uploaded to Decent Blockchain!');
    }
}
