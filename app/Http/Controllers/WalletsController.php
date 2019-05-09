<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DCorePHP\Model\ChainObject;
use App\Models\Wallets;

class WalletsController extends Controller
{

      public function Index()
      {
        $wallet = Wallets::all();
        //dd($wallet);
        return view('wallet.index', $wallet);
      }


      // public function Create()
      // {
      //   $dcoreApi = new \DCorePHP\DCoreApi('https://testnet-api.dcore.io/','wss://testnet-api.dcore.io');
      //   $brainkey = 'gunl undy imbibe betrail bottler queasom untruly suist wether epipial dablet craw achene dinette communa unbraid';
      //   $name = 'accountname';
      //   $accountname = new ChainObject("1.2.35");
      //   $registrarid = 'DCT5sgksw3bNxQTLMQy5G84or283Padw9xRQpowt9PrgxFzxajNMm';
      //   $prikey = '5JNvSJebNUu2fsCfc3PzVuCiLQ9iXhtFmNb82JcqocES3jGACjn';
      //   $broadcast = false;
      //
      //   $wallet = $dcoreApi->getAccountApi()->createAccountWithBrainKey( 'dw-charliejustcga', 'dw-charliejustcga',new ChainObject("1.2.35"),$prikey,$broadcast);
      //
      //
      //   echo $wallet;
      //   return view('wallet.create');
      // }

      public function Create()
      {
        $wallet = auth()->user()->wallets;
        return view('wallet.create', compact('wallet'));
      }

      public function Store()
      {
            request()->validate([
              'wallet' => 'required',
            ]);

            Wallets::create(
              request(['wallet'])+(['user_id'=>auth()->user()->id])
            );
            $wallet = auth()->user()->wallets;
            return redirect('wallet/create')->with('wallet',$wallet)->with('message','Wallet has been saved');
      }
}
