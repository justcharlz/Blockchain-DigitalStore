<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoresController extends Controller
{

    public function Index()
    {
      return view('stores.index');
    }

    public function Create()
    {
      $store = new App/stores;
    return request()->all();
      //return redirect('/stores');
    }
}
