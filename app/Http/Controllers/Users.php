<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;//request is for form input values 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;//hasching
use Illuminate\Support\Facades\Auth;//auth for get logged in info

use Illuminate\Http\UploadedFile;//for upload files

use admin\User;//user model
use admin\UserDetail;//user model
use admin\Activity;//user model
use admin\Performance;//user model
class Users extends Controller
{
    public $user;
	function __construct(){
		$this->middleware('auth');
        $this->middleware(function ($request, $next) {
        $this->user = Auth::user();
            if($this->user->is_admin===1){
                return $next($request);
            }
            else{
                return redirect()->route('public');
            }
               
        });        
	}
 	function getUsers(){
 		$title= "Freelancers";
		$users = User::select()
					->where(['role'=>1,'is_admin'=>0])
		 			->orderBy('id','desc')
		 			->paginate(10);
					   
		
 		return view('admin.users')->with(['title'=>$title,'users'=>$users]);
 	}

    function getAllUsers(){
        $users= User::where(['role'=>1,'is_admin'=>0,'is_client'=>0])
                    ->orderBy('id','desc')
                    ->get();
        return $users;
    }

    function usersDetailInfo($user_id){
    	$title= "Freelancer Detail";
        $basic= User::where(['id'=>$user_id])
                    ->first();  

        $detail= UserDetail::where(['user_id'=>$user_id])->first(); 

        $activity= $this->getActivity($user_id);

        $performance= Performance::where(['user_id'=>$user_id])->get();

        return view('admin.user_detail')->with(['title'=>$title,'basic'=>$basic, 'detail'=>$detail, 'activity'=>$activity, 'performance'=>$performance]);
                                                                 	
    }

    function getActivity($user_id){
        $activities= Activity::select('activities.*','project_req.title','clients.email as clientEmail','clients.name as clientName')
            ->join('users','users.id','=','activities.user_id')
            ->join('project_req','project_req.id','=','activities.project_id')
            ->join('users as clients','clients.id','=','project_req.client_id')
            ->where('activities.user_id',$user_id)
            ->orderBy('activities.id','desc')
            ->get();
        return $activities;         
    }
    
 	function saveUser(Request $request){
        $this->validate($request, [

            'email' => 'required|email|max:255|unique:users',

        ]);
 		if($request->hasFile('image')){
 			if($request->file('image')->isValid()){
 				if( $request->file('image')->storeAs("avatars", $request->file('image')->getClientOriginalName())){
 					$user= new User([
 						'image'=>$request->file('image')->getClientOriginalName(),
 						'image_path'=>$request->file('image')->path(),
 						'name'=>$request->name,
 						'age'=>$request->age,
 						'email'=>$request->email,
 						'password'=>$request->password,
 						'address'=>$request->address,
 						'phoneNumber'=>$request->phoneNumber,
 						'region'=>$request->region,
 						'zipCode'=>$request->zipCode,
 						'role'=>1,
 						'recognitionSign'=>$request->recognitionSign,
 						'about'=>$request->about
 						]);
 				
 					if($user->save()){
 						return redirect()->route('users')->with('success','User Added Succefully!');
 					}
 					else{
 						return redirect()->route('users')->with('fail','Failed to Add User!');

 					}
 				}
 			}
 			else{
 					return redirect()->route('users')->with('fail','Image Is Not Valid!');

 			}
 		}

 		
 	}

 	function updateUser(Request $request){

 		if($request->hasFile('image')){
 			if($request->file('image')->isValid()){
 				if( $request->file('image')->storeAs("avatars", $request->file('image')->getClientOriginalName())){
 					$user= User::where('id',$request->id)
 						->update([
 						'image'=>$request->file('image')->getClientOriginalName(),
 						'image_path'=>$request->file('image')->path(),
 						'name'=>$request->name,
 						'age'=>$request->age,
 						'email'=>$request->email,
 						'password'=>$request->password,
 						'address'=>$request->address,
 						'phoneNumber'=>$request->phoneNumber,
 						'region'=>$request->region,
 						'zipCode'=>$request->zipCode,
 						'recognitionSign'=>$request->recognitionSign,
 						'about'=>$request->about
 						]);
 				
 					if($user){
 						return redirect()->route('users')->with('success','User Added Succefully!');
 					}
 					else{
 						return redirect()->route('users')->with('fail','Failed to Update User!');

 					}
 				}
 			}
 			else{
 					return redirect()->route('users')->with('fail','Image Is Not Valid!');

 			}
 		}//if image not added
 		else{
 				$user= User::where('id', $request->id)
 						->update([

 					//'image'=>$request->img,
 					//'image_path'=>$request->img_path,
 					'name'=>$request->name,
 					'age'=>$request->age,
 					'email'=>$request->email,
 					'password'=>$request->password,
 					'address'=>$request->address,
 					'phoneNumber'=>$request->phoneNumber,
 					'region'=>$request->region,
 					'zipCode'=>$request->zipCode,
 					'recognitionSign'=>$request->recognitionSign,
 					'about'=>$request->about
 				]);

 				if($user){
 					return redirect()->route('users')->with('success','User Updated Succefully!');
 				}
 				else{
 					return redirect()->route('users')->with('fail','User Update Failed!');

 				}
 		}

 	}


 	function deleteUser($id){
 		$user= User::where('id',$id)
 					 ->delete();

 	}
}
