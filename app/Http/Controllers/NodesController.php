<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NodesController extends Controller
{
    public function Index($value='')
    {
      return view('Nodes.index');
    }
}
