<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stores;
use App\Models\Wallets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


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
      $wallet =   auth()->user()->wallets;
      return view('stores.create', compact('wallet'));
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

        $filedir = request()->file('cover')->store('public/cover');
        //$file = Image::make($filedir)->resize(255, 170)->save();
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
        //$beatdir = request()->file('beat');
        $beatdir = request()->file('beat')->store('upload/beats');
      }

      $arweave = new \Arweave\SDK\Arweave('http', '209.97.142.169', 1984);

      //send to arweave blockchain

          $wallet =   auth()->user()->wallets;
          $jwk = json_decode(Storage::disk('local')->get($wallet->walletkey), true);

          $wallet =  new \Arweave\SDK\Support\Wallet($jwk);
          $tx = $arweave->createTransaction($wallet, [
          'data' => $beatdir,
          'tags' => [
              'Content-Type' => 'audio/mpeg'
          ],
          'quantity' => '0'
          ]);


          $tx->verify();

      // commit() sends the transaction to the network, once sent this can't be undone.
           $arweave->api()->commit($tx);

           sleep(10);
           //dd($tx->getAttribute('id'));
          $status = $arweave->api()->getTransactionData($tx->getAttribute('id'));


      //save data to database
      Stores::create(request([
        'name',
        'music_genre',
        'bpm',
        'length',
        'beat_price'])
        +
        [
        'transactionid' => $tx->getAttribute('id'),
        'user_id' => auth()->user()->id,
        'cover' => $imagedir,
        'size' => Storage::size($beatdir),
        'type' => Storage::mimeType($beatdir),
        'path' => $beatdir,
        'promoted' => $promoted
      ]);



      return redirect()->action('StoresController@create')->with('message','Beat Succefully uploaded to Arweave Blockchain!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Stores $store)
    {

      if ($store->user_id == auth()->user()->id)
      {
        return view('stores.edit')->with('stores', $store);
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
    public function show(Stores $store)
    {

        return view('stores.show')->with('stores', $store);
    }

    /**
     * marketplace beat detail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail(Stores $store)
    {
        return view('stores.detail')->with('stores', $store);
    }

    /**
     * checkout.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkout(Stores $store)
    {
        return view('stores.checkout')->with('stores', $store);
    }

    /**
     * Token Transfer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tokentransfer(Stores $store)
    {

      //get buyer's address
      $buyer = auth()->user()->wallets;

        if ($buyer != null) {
          //get seller's address
          $seller = Wallets::where('user_id',$store->user_id)->first();

          //Do the transfer
                $arweave = new \Arweave\SDK\Arweave('http', '209.97.142.169', 1984);
          //send to arweave blockchain

              $jwk = json_decode(Storage::disk('local')->get($buyer->walletkey), true);

              $wallet =  new \Arweave\SDK\Support\Wallet($jwk);
              $tx = $arweave->createTransaction($wallet, [
              'target' => $seller->wallet,
              'data' => $store->name,
              'tags' => [
                  'Digital Content' => $store->description
              ],
              'quantity' => $store->beat_price
              ]);

              $tx->verify();

              // commit() sends the transaction to the network, once sent this can't be undone.
                 $arweave->api()->commit($tx);

               sleep(20);
               //dd($tx->getAttribute('id'));
              $status = $arweave->api()->getTransactionData($tx->getAttribute('id'));
              return view('stores.checkout')->with('message', $status)->with('stores', $store);
        }
        else {
          return view('stores.checkout')->with('message', 'Add a Wallet to make a purchase');
        }

        return view('stores.checkout')->with('stores', $store);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Stores $store)
    {
        try {

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

            $filedir = request()->file('cover')->store('public/cover');

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
      $result =  $store->update(
          request([
            'name',
            'music_genre',
            'bpm',
            'length',
            'beat_price'])
            +
            [
            'user_id' => auth()->user()->id,
            'cover' => $imagedir,
            'size' => Storage::size($beatdir),
            'type' => Storage::mimeType($beatdir),
            'path' => $beatdir,
            'promoted' => $promoted
          ]
        );


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
    public function destroy(Stores $stores)
    {
      //dd($stores);
      if ($stores->user_id == auth()->user()->id) {
        try {
            $result = $stores->delete();

            //delete cover image
            $coverdir = explode('/', $stores->cover);
            $coverdir = 'public/cover/'.$coverdir[2];
            Storage::delete($coverdir);

            //delete beat
            $beatdir = explode('/', $stores->path);
            $beatedir = 'public/cover/'.$beatdir[2];
            Storage::delete($beatdir);

            if ($result) {
                return redirect('/stores')->with('message', 'Successfully deleted');
            }

            return back()->with('message', 'Failed to delete');
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
      }
        return back();
    }


}
