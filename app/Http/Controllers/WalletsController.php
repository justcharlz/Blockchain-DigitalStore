<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallets;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class WalletsController extends Controller
{

      public function Index()
      {
        $wallet = Wallets::all();
        //dd($wallet);
        return view('wallet.index', $wallet);
      }


      public function Create()
      {
        $wallet;
        $wallet = auth()->user()->wallets;
        //dd($wallet);
        return view('wallet.create', compact('wallet'));
      }


      public function Store(Wallets $upwallet)
      {
            request()->validate([
              'wallet' => 'required',
            ]);

            if(
            request()->hasfile('walletkey')
            &&
            request()->validate(
              [
                        'walletkey' => 'required|max:4096',
                    ]))
            {

              $walletdir = request()->walletkey->storeAs('wallet', SHA1(microtime('m')).'.json');
              //dd($filedir);
              // $filepath = Storage::putFile('wallet', new File($filedir));
              // //dd($filepath);
              //  $walletdir = explode('/', $filedir);
              //  $wallet = 'storage/wallet/'.$walletdir[2];
            }

            $wallet = auth()->user()->wallets;
//dd(['user_id' =>  auth()->user()->id, 'wallet' => $wallet->walletkey ]);
            if (isset($wallet->walletkey)) {

                $result = $upwallet->updateOrInsert(
                  ['user_id' =>  auth()->user()->id ],
                  ['walletkey' => $walletdir, 'wallet' => request()->wallet]);

            }
            else {
              Wallets::create(
                request(['wallet'])+([
                  'user_id'=> auth()->user()->id,
                  'walletkey' => $walletdir
                ])
              );
            }



            return redirect('wallet/create')->with('wallet',$wallet)->with('message','Wallet has been saved');
      }
}
