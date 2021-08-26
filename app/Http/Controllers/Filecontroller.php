<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Filecontroller extends Controller
{
    //
	function Upload(Request $req)
	{
		
		return $req->file('file')->store('images');
		
	}
}
