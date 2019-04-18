<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DCorePHP\Model\ChainObject;

class WalletController extends Controller
{


    public function Index()
    {
      return view('wallet.create');
    }

    public function Create()
    {
      $dcoreApi = new \DCorePHP\DCoreApi('https://testnet-api.dcore.io/','wss://testnet-api.dcore.io');
      $brainkey = 'gunl undy imbibe betrail bottler queasom untruly suist wether epipial dablet craw achene dinette communa unbraid';
      $name = 'accountname';
      $accountname = new ChainObject("1.2.35");
      $registrarid = 'DCT5sgksw3bNxQTLMQy5G84or283Padw9xRQpowt9PrgxFzxajNMm';
      $prikey = '5JNvSJebNUu2fsCfc3PzVuCiLQ9iXhtFmNb82JcqocES3jGACjn';
      $broadcast = false;

      $wallet = $dcoreApi->getAccountApi()->createAccountWithBrainKey( 'dw-charliejustcga', 'dw-charliejustcga',new ChainObject("1.2.35"),$prikey,$broadcast);


      echo $wallet;
      return view('wallet.create');
    }
}
