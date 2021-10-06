<?php

namespace admin\Http\Controllers\Auth;

use Illuminate\Http\Request;
use admin\Http\Controllers\Controller;
use admin\User;
use admin\ProductService;
class BecomeClient extends Controller
{
   	function __contruct(){
   		$this->middleware('guest');
   	}

   	function register(Request $request){
   		//making validation
   		$this->validate($request,[
   			'name'=>'required',
   			'email'=>'required|email|max:255|unique:users',
   			'password'=>'required|min:6',
   			'company_name'=>'required'
   			]);


   		$clientData=[
	   		'name'=>$request->name,
	   		'email'=>$request->email,
	   		'password'=>bcrypt($request->password),
	   		'company_name'=>$request->company_name,
	   		'company_website'=>$request->company_website,
	   		'is_client'=>1
   		];

   		//creating client
   		$client= new User($clientData);

   		if($client->save()){
   			//retrieve clint id
   			$client_id= User::select('id')->where(['email'=>$clientData['email']])->first();

   			if(!empty($client_id)){
   				//injecting client id in request
   				$request['client_id']= $client_id->id;
   				$product_service= array_except($request->all(), ['name','password','email','company_website','company_name']);
   				//saving data into product_service
   				$client_product= new ProductService($product_service);

   				if($client_product->save()){
   					return redirect()->back()->with('success',"Registration success, we will review your account & update you through email.");
   				}
   				else{
   					//deleting the insert row
   					$delete= User::where(['email'=>$clientData['email']])->delete();

   					return redirect()->back()->with('fail',"Something went wrong, please try again!");
   				}
   			}
   			else{
   				return redirect()->back()->with('fail',"Client id not found");
   			}
   		}

   	}
}
