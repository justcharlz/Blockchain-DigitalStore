<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Stores;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class StoresController extends Controller
{


    public function Marketplace()
    {
      $stores = Stores::all();

      return view('stores.marketplace', compact('stores'));
    }

    public function Index()
    {

      $stores = auth()->user()->stores;

      return view('stores.index', compact('stores'));
    }

    public function Create()
    {

      return view('stores.create');
    }

    public function Store($promoted = false)
    {


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
        //$file = request()->file('cover');
        $file = Image::make($file)->resize(255, 170)->encode();
        $filedir = request()->file($file)->store('public/cover');

         $imagedir = explode('/', $filedir);
         $imagedir = 'storage/cover/'.$imagedir[2];
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
      $store->cover = $imagedir;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $stores = Stores::find($id);
      //$stores = Stores::where('id',$id)->where('user_id', auth()->user()->id)->get();
      if ($stores->user_id == auth()->user()->id)
      {
        return view('stores.edit')->with('stores', $stores);
      } else {
        return redirect('stores')->with('message','You do not have authorisation');
      }

      return redirect('stores');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stores = Stores::find($id);

        return view('stores.show')->with('stores', $stores);
    }

    /**
     * marketplace beat detail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $stores = Stores::find($id);

        return view('stores.detail')->with('stores', $stores);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        try {
          $store = Stores::find($id);
          //update cover path in db
          if(request()->hasfile('cover')&&
          request()->validate([
                      'cover' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                  ])
          )
          {
            $imagedir = explode('/', $store->cover);
            $imagedir = 'public/cover/'.$imagedir[2];

            Storage::delete($imagedir);
            //cover image
            $file = Image::make($file)->resize(255, 170)->encode();
            $filedir = request()->file($file)->store('public/cover');

             $imagedir = explode('/', $filedir);
             $imagedir = 'storage/cover/'.$imagedir[2];

          }else{
            $imagedir = $store->cover;
          }

          //update beat path in db
          if(request()->hasfile('beat')&&
          request()->validate([
                      'beat' => 'required|file|mimetypes:audio/mpeg|max:7048',
                  ])
          )
          {
          $beatdir = explode('/', $store->path);
          $beatdir = 'public/beats/'.$beatdir[2];
          Storage::delete($beatdir);

          //beat
          $beat = request()->file('beat');
          $beatdir = request()->file('beat')->store('upload/beats');
        }else{
          $beatdir = $store->path;
        }
        //dd(request());

          $store->user_id = auth()->user()->id;
          $store->cover = $imagedir;
          $store->name = request('name');
          $store->music_genre = request('music_genre');
          $store->bpm = request('bpm');
          $store->length = request('length');
          $store->beat_price = request('beat_price');
          $store->size = Storage::size($beatdir);
          $store->type = Storage::mimeType($beatdir);
          $store->path = $beatdir;
          $store->promoted = $store->promoted;
          $result = $store->save();

            if ($result) {
                return back()->with('message', 'Successfully updated');
            }

            return back()->with('message', 'Failed to update');
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $stores = Stores::find($id);
      //dd($stores);
      if ($stores->user_id == auth()->user()->id) {
        try {
            $result = $stores->delete($id);

            //delete cover image
            $coverdir = explode('/', $stores->cover);
            $coverdir = 'public/cover/'.$coverdir[2];
            Storage::delete($coverdir);

            //delete beat
            $beatdir = explode('/', $stores->path);
            $beatedir = 'public/cover/'.$beatdir[2];
            Storage::delete($beatdir);

            if ($result) {
                return redirect('stores.index')->with('message', 'Successfully deleted');
            }

            return back()->with('message', 'Failed to delete');
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
      }
        return back();
    }


}
