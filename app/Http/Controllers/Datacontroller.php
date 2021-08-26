<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\address;
use App\Models\seed;

class Datacontroller extends Controller

{
    //
	 
   
             function open() 
            {
                $data = "This data is open and can be accessed without the client being authenticated";
				return response()->json([
					'status' => true,
					'data' =>compact('data'),
			]);

            }

             function closed() 
            {
                $data = "Only authorized users can see this";
                return response()->json(compact('data'),200);
            }
}
 