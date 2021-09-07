<?php
namespace App\Http\Controllers;
	use Illuminate\Http\Request;
	use App\Models\user;
	use Illuminate\Support\Facades\Hash;
	use Illuminate\Support\Facades\Validator;
	use JWTAuth;
	use Tymon\JWTAuth\Exceptions\JWTException;
	use Illuminate\Support\Facades\DB;

	class usercontroller extends Controller
	{
		//
			function RegisterUser(Request $req)
			{	
					$validator = Validator::make($req->all(), [
					'name' => 'required|string|max:50',
					'email' => 'required|string|email|max:255|unique:users',
					'businessname' => 'required|string|max:40',
					'password' => 'string|max:8|min:8',
				]);
			if($validator->fails()){
			return response()->json($validator->errors());
				}
			{
				$user=new User;
				if($req->hasFile('profile_image'))
				{
					$data=$req->file('profile_image')->store('Images');
					$user->image_url = $data;
				}
				else{
					return response()->json([
						'message' => 'User profile_image is required',
						'status' => false,
						'data' => null,
					]);
				}
			
			$user->name=$req->name;
			$user->image=$data;
			$user->email=$req->email;
			$user->password= Hash::make($req->password);
			$user->businessname=$req->businessname;
			$user->fcmtoken=$req->fcmtoken;
			$result=$user->save();
			$token = JWTAuth::fromUser($user);
		   if($result)	   
			 {  
				return response()->json([
					'message' => 'User registered',
						'status' => true,
					'data' => compact('user','token'),
				]);
			 }
		   else
			 {
				 return response()->json([
						'message' => 'User could not be registered',
						'status' => false,
				]);
		
			 }
			
			}
	   }
		function login(Request $req)
		{  
		
			$credentials = $req->only('email', 'password');

		  try {
		  if (! $token = JWTAuth::attempt($credentials)) {
						 return response()->json([
						'message' => 'Invalid_Credentials',
						'status' => false,
						]);
					}
					
				}
		 catch (JWTException $e)
				{
					 return response()->json([
						'message' => 'Could not create token',
						'status' => false,
						]);
				}
					 $data= User::where('email', $req->email)->first();
				 
		 
					return response()->json([
						'message' => 'User login',
						'status' => true,
						'data'=> $data,
						'access_token' => compact('token')
						]);	
						}
	   function Delete(Request $req)
		{
			$data= User::where('id', $req->id);
			$result=$data->delete();
				
				if($result)
				{ 
		   return response()->json([
						'message' => 'User Deleted',
						'status' => true,
						]);	
						}
			else
				{
				return response()->json([
						'message' => 'User not Deleted',
						'status' => false,
						]);	
				}
				 }
	function UpdateUser(Request $req)
		    {
			if($req->hasFile('image')) 
			{	
				$data=$req->file('image')->store('Images');
				User::where('id',$req->id)->update(['image' => $data]);
			}
		   $result=User::where('id',$req->id)->update([
		   'name' => $req->name,
		   'email' => $req->email,
		   'password' =>Hash::make($req->password),
		   'businessname' => $req->businessname
		    ]);
				 
		   $data=User::where('id',$req->id)->get();
				
				if($result)	  	   
			   {  
				return response()->json([
						'message' => 'User updated',
						'status' => true,
						'data'=>$data
				]);
			   }
			   else
				   {  
				return response()->json([
						'message' => 'User not updated',
						'status' => false,
						
				]);
			       }
				   }

		function Get(Request $req)
		{
			
		 $result=User::where("id",$req->id)->get();
			   if($result)	   
			   {  
				return response()->json([
						'message' => 'User geted',
						'status' => true,
						'data'=>$result
				]);
			 }
		   else
			  {
				 return response()->json([
						'message' => 'User not exit',
						'status' => false,
						
						]);
			
			  }
		 
		}
		function addData(Request $req)
		{
			$data=$req->file('file')->store('images');
			$user=new User;
			$user->name=$req->name;
			$user->email=$req->email;
			$user->password=$req->password;
			$user->businessname=$req->businessname;
			$user->image=$req->$data;
			$result=$user->save();
			if($result)
			{ 
		          return response()->json([
						'message' => 'User not exit',
						'status' => false,
						
						]);}
			else
			{
				 return response()->json([
						'message' => 'User not exit',
						'status' => false,
						
						]);
			
			
		}
		}
	 
	}