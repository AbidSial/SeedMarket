<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\address;
use App\Models\seed;
use App\Models\bid;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class Seedcontroller extends Controller
{
    //
		
	function addSeedadress(Request $req)
	{
	    $address=new address;
		$address->street_address=$req->street_address;
		$address->late=$req->late;
		$address->lang=$req->lang;
		$address->user_id= $req->user_id;
        $result=$address->save();
		  if($result)	   
         {  
			return response()->json([
					'message' => 'Added Address',
					'status' => true,
					'data' => compact ('address'),
			]);
         }
       else
         {
			 return response()->json([
					'message' => 'Address not added',
					'status' => false,
			]);
	
         }	
	}
	function addSeed(Request $req)
	{
		$data=$req->file('seed_image')->store('Images');
		$image=$req->file('analysis_report_image')->store('Images');
	    $seed=new seed;
		$seed->seed_image =$data;
		$seed->analysis_report_image=$image ;
		$seed->seed_kind =$req->seed_kind ;
		$seed->lot_number = $req->lot_number ;
		$seed->seed_variety  =$req->seed_variety  ;
		//$seed->total_seed_weight =$req->total_seed_weight ;
		$seed->price_per_pound =$req->price_per_pound ;
		$seed->seed_purity =$req->seed_purity ;
		$seed->other_crop_seed_percentage =$req->other_crop_seed_percentage ;
		$seed->other_crop_seed_amount =$req->other_crop_seed_amount ;
		$seed->weed_seed_percentage =$req->weed_seed_percentage ;
		$seed->germination_persontage =$req->germination_persontage ;
		$seed->address_id=$req->address_id;
		$seed->userid=$req->user_id;
        $result=$seed->save();
		  if($result)	   
         {  
			return response()->json([
					'message' => 'Added Seeds',
					'status' => true,
					'data' => $seed,
			]);
         }
       else
         {
			 return response()->json([
					'message' => 'Seeds not added',
					'status' => false,
			]);
	
         }
	}
 
	
	   function LoadSeeds(Request $req)
                   {
                    try {

                            if (! $user = JWTAuth::parseToken()->authenticate())
							{
                          return response()->json([
							'status' => false,
							'message' => 'token is not found',
                           ]);							
                            }
							} 
					catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e)
					{
					return response()->json([
							'status' => false,
							'message' => 'token is not expired',
                          ]); 

                    }
					catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e)
					{
						return response()->json([
							'status' => false,
							'message' => 'token is invalid',
						]);
                    } 
					catch (Tymon\JWTAuth\Exceptions\JWTException $e)
					{

                      return response()->json([
							'status' => false,
							'message' => 'token is absent',
						]);      

                    }
					$page = $req->PageNo;
					$offset = ($page - 1) * 5;
					$seeds = seed::offset($offset)->limit(5)->get();
					
                    return response()->json([
					'status' => true,
					'data' =>compact('seeds'),
			]);
            }
	        function GetSeed(Request $req)
	          {
		
	          return seed::where("id",$req->id)->get();	 	
	          }
		
			function UpdateSeed(Request $req)
			{
			   if($req->hasFile('seed_image')) 
				{	
			   $data=$req->file('seed_image')->store('Images');
			   User::where('seed_id',$req->id)->update(['image' => $data]);
				}
				if($req->hasFile('seed_image')) 
				{	
			   $image=$req->file('analysis_report_image')->store('Images');
			   User::where('seed_id',$req->id)->update(['analysis_report_image' => $image]);
				}
			$params = array();
			if($req->has('seed_kind')){
				$params["seed_kind"] = $req->seed_kind;
			}
			if($req->has('total_seed_weight')){
				$params["total_seed_weight"] = $req->total_seed_weight;
			}
			if($req->has('lot_number ')){
				$params["lot_number "] = $req->lot_number ;
			}
			if($req->has('seed_variety')){
				$params["seed_variety"] = $req->seed_variety;
			}
			if($req->has('price_per_pound')){
				$params["price_per_pound"] = $req->price_per_pound ;
			}
			if($req->has('seed_purity')){
				$params["seed_purity"] = $req->seed_purity ;
			}
			if($req->has('other_crop_seed_percentage')){
 
				$params["other_crop_seed_percentage"] = $req->other_crop_seed_percentage ;
			}
			if($req->has('other_crop_seed_amount')){
				$params["other_crop_seed_amount"] = $req->other_crop_seed_amount  ;
			}
			if($req->has('  weed_seed_percentage')){
				$params[" weed_seed_percentage"] = $req->weed_seed_percentage  ;
			}
			if($req->has('germination_percentage')){
				$params["germination_percentage"] = $req->germination_percentage  ;
			}
			if($req->has('address_id')){
				$params["address_id"] = $req->address_id  ;
			}
			
			
	    $result=seed::where('seed_id',$req->id)->update($params);
		$seed = seed::where('seed_id', $req->id)->first();
		
		  if($result)	   
         {  
			return response()->json([
					'message' => 'updated Seeds',
					'status' => true,
					'data' => $seed,
			]);
         }
       else
         {
			return response()->json([
					'message' => 'Seed not updated',
					'status' => false,
			]);
				
		}
			
	}
		function DeleteSeed(Request $req)
	{
		$data= seed::where('seed_id', $req->id);
		$result=$data->Delete();
			
			if($result)
			{ 
	   return response()->json([
					'message' => ' Seed Deleted',
					'status' => true,
					]);	
					}
		else
		{
			return response()->json([
					'message' => 'seed not Deleted',
					'status' => false,
					]);	
					}
    
	}
	function AddBid(Request $req)
	{
	    $bid=new bid;
		$bid->bid_amount=$req->bid_amount;
		$bid->seed_amount=$req->seed_amount;
		$bid->seed_weight=$req->seed_weight;
		$bid->seed_id=$req->seed_id;
		$bid->user_id= $req->user_id;
        $result=$bid->save();
		  if($result)	   
         {  
			return response()->json([
					'message' => 'Added Bid',
					'status' => true,
					'data' => compact ('bid'),
			]);
         }
       else
         {
			 return response()->json([
					'message' => 'Bid not added',
					'status' => false,
			]);
		
		
	}
	}
	function GetBid(Request $req)
	{
		
		$bids = bid::where("seed_id",$req->seed_id)->get();
		foreach($bids as $b ){
			$userid = $b["user_id"];
			$user = User::where('id', $userid)->first();
			$b["user"] = $user;
			$seedid = $b["seed_id"];
			$seed = seed::where('seed_id', $seedid)->first();
			$b["seed"]=$seed;
		}
		return response()->json([
					'message' => 'Bid list obtained',
					'status' => true,
					'data' => $bids
			]);
	}
	function UpdateBid(Request $req)
	{
		$result=bid::where('bid_id',$req->id)->update([
		'bid_amount'=>$req->bid_amount,
		'seed_amount'=>$req->seed_amount,
		'seed_weight'=>$req->seed_weight,
		'seed_id'=>$req->seed_id,
		'user_id'=>$req->user_id]);
		$bid = bid::where('bid_id', $req->id)->first();
		  if($result)	   
         {  
			return response()->json([
					'message' => 'Bid updated',
					'status' => true,
				    'data'=>$bid
			]);
         }
       else
         {
			 return response()->json([
					'message' => 'Bid not Updated',
					'status' => false,
					
			]);
		}	
	}
	function AcceptBid(Request $req)
	{
		$result=bid::where('bid_id',$req->id)->update(['status'=>true]);
        $bid = bid::where('bid_id', $req->id)->first(); 		
	   	  if($result)	   
         {  
			return response()->json([
					'message' => 'Accepted Bid ',
					'status' => true,
					'data'=> $bid
			]);
         }
       else
         {
			 return response()->json([
					'message' => 'Bid not Accepted',
					'status' => false,
					
			]);
		}
	
		
		
	}
	
}