<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;//request is for form input values 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;//hasching
use Illuminate\Support\Facades\Auth;//auth for get logged in info
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\UploadedFile;//for upload files

use admin\User;//user model
use admin\ProductService;//user model
use admin\ProjectRequest;//user model
use admin\Package;//user model
use admin\Ticket;//user model
use admin\Contract;//user model
use admin\Mail\SupportMail;

class AppUsersCtrl extends Controller
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
 		$title= "Clients";
		$users = User::select('id','name','image','email','company_name','company_website','role')
					->where(['is_client'=>1])
		 			->orderBy('id','desc')
		 			->paginate(10);
					   
		
 		return view('admin.appusers')->with(['title'=>$title,'users'=>$users]);
 	}

 	function clientDetail($id){
 		$title="Client Detail";

 		$basicInfo= $this->basicDetail($id);	
 		$prod_service= $this->prodServDetail($id);	

 		return view('admin.client_detail')->with(['title'=>$title,'basic'=>$basicInfo,'prod_service'=>$prod_service]);
 	}

 	function basicDetail($id){
		$client = User::select('id','name','image','email','company_name','company_website','role')
					->where(['is_client'=>1,'id'=>$id])
		 			->first();
		return $client; 		
 	}

 	function prodServDetail($id){
		$prod_service = ProductService::select('*')
					->where(['client_id'=>$id])
		 			->first();
		return $prod_service; 		
 	}

 	function pack_detail($id){
 		$q= Package::select('*')
 					->where(['id'=>$id])
 					->first();
 		return $q;			
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
 						
 						'email'=>$request->email,
 						'password'=>$request->password
 						/*'age'=>$request->age,
 						'address'=>$request->address,
 						'phoneNumber'=>$request->phoneNumber,
 						'region'=>$request->region,
 						'zipCode'=>$request->zipCode,
 						'recognitionSign'=>$request->recognitionSign,
 						'about'=>$request->about
 						*/
 						]);
 				
 					if($user->save()){
 						return redirect()->route('appUsers')->with('success','User Added Succefully!');
 					}
 					else{
 						return redirect()->route('appUsers')->with('fail','Failed to Add User!');

 					}
 				}
 			}
 			else{
 					return redirect()->route('appUsers')->with('fail','Image Is Not Valid!');

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
 						
 						'email'=>$request->email,
 						'password'=>$request->password
 						/*
 						'age'=>$request->age,
 						'address'=>$request->address,
 						'phoneNumber'=>$request->phoneNumber,
 						'region'=>$request->region,
 						'zipCode'=>$request->zipCode,
 						'recognitionSign'=>$request->recognitionSign,
 						'about'=>$request->about
 						*/
 						]);
 				
 					if($user){
 						return redirect()->route('appUsers')->with('success','User Updated Succefully!');
 					}
 					else{
 						return redirect()->route('appUsers')->with('fail','Failed to Update User!');

 					}
 				}
 			}
 			else{
 					return redirect()->route('appUsers')->with('fail','Image Is Not Valid!');

 			}
 		}//if image not added
 		else{
 				$user= User::where('id', $request->id)
 						->update([

 					//'image'=>$request->img,
 					//'image_path'=>$request->img_path,
 					'name'=>$request->name,
 					
 					'email'=>$request->email,
 					'password'=>$request->password
 					/*
 					'age'=>$request->age,
 					'address'=>$request->address,
 					'phoneNumber'=>$request->phoneNumber,
 					'region'=>$request->region,
 					'zipCode'=>$request->zipCode,
 					'recognitionSign'=>$request->recognitionSign,
 					'about'=>$request->about
 					*/
 				]);

 				if($user){
 					return redirect()->route('appUsers')->with('success','User Updated Succefully!');
 				}
 				else{
 					return redirect()->route('appUsers')->with('fail','User Update Failed!');

 				}
 		}

 	}
 	function updateRole($id,$role){
 		$client= User::select('email')
 					->where('id',$id)
 					->first();

 		if($role==0){
 			$update= User::where('id',$id)
 						->update(['role'=>1]);
 			if($update){
 				$mail= $this->clientApproveMail($client->email);
 				if($mail){
 					echo "success";
 				}
 				else{
 					echo "fail";
 				}
 				
 			}
 			else{
 				echo "fail";
 			}

 		}
 		elseif($role==1){
 			$update= User::where('id',$id)
 						->update(['role'=>0]);
 			if($update){
 				echo "success";
 			}
 			else{
 				echo "fail";
 			} 			
 		}
 	}

 	function clientApproveMail($to){
 		
 		$subject="Account Approved";
 		$message="You account has succesfully approved! Please login to your account";

 		Mail::to($to)->send(new SupportMail($subject, $message));
 	} 	

 	function sendMail($to="shewa12kpi@gmail.com"){
 		
 		$subject="Account Approved";
 		$message="You account has succesfully approved! Please login to your account";

 		Mail::to($to)->send(new SupportMail($subject, $message));
 	}
 	function deleteUser($id){
 		$user= User::where('id',$id)
 					 ->delete();

 	}

 	//ticket start
 	function supportTicket(){
 		$title= "Support Ticket";
		$tickets = Ticket::select('tickets.*','users.name','users.email','users.company_name','users.company_website')
					->join('users','users.id','=','tickets.client_id')
		 			->orderBy('id','desc')
		 			->paginate(10); 		
 		return view('admin.support_ticket')->with(['title'=>$title,'tickets'=>$tickets]);
 	} 	

 	function replyTick(Request $request){
 		$post=['reply'=>$request->reply];

 		$update= Ticket::where('id',$request['id'])
 					->update($post);
 		if($update){
 			return redirect()->back()->with('success',"Ticket replied succesfully!");
 		}			
 		else{
 			return redirect()->back()->with('fail',"Ticket reply failed!");

 		}
 	}
 	//ticket end

 	//project request start
	function activeReq(){
		$title= "Active Request";
		$activeReq= ProjectRequest::select('project_req.*','users.name','users.email','users.company_name','users.company_website')
					->join('users','users.id','=','project_req.client_id')
					->where(['status'=>1])
					->paginate(10);

		return view('admin.active_request')->with(['title'=>$title,'requests'=>$activeReq]);		
	} 

 	function closedProject(){
		$title= "Closed Projects";
		$closedReq= ProjectRequest::select('project_req.*','users.name','users.email','users.company_name','users.company_website')
					->join('users','users.id','=','project_req.client_id')
					->where(['status'=>2])
					->paginate(10);

		return view('admin.closed_request')->with(['title'=>$title,'requests'=>$closedReq]); 		
 	}	

 	function markasClose($id){
 		$close= ProjectRequest::where('id',$id)
 					->update(['status'=>2]);
 		if($close){
 			echo "success";
 		}				
 	}	
 	//project request end

 	//contacts start
 	function adminContract(){
		$title= "Contacts";
		$clients= $this->getClients();

		$contracts= Contract::select('contracts.*','users.name','users.email','users.company_name','users.company_website')
					->join('users','users.id','=','contracts.client_id')
					//->where(['status'=>2])
					->paginate(10);

		return view('admin.contract')->with(['title'=>$title,'contracts'=>$contracts,'clients'=>$clients]);  		
 	}

 	function addContract(Request $request){
 		$this->validate($request, [
 			'attachment' => 'mimes:jpg,png,jpeg,doc,docx,pdf|max:20000'
 			]);

 		$post= [
 			'client_id'=>$request->client_id,
 			'title'=>$request->title,
 			'attachment'=>$request->file('attachment')->getClientOriginalName(),
 			'comment'=>$request->comment
 		];

 		$create= new Contract($post);
 		if($create->save()){
 			$request->file('attachment')->storeAs('contracts',$request->file('attachment')->getClientOriginalName());
 			return redirect()->back()->with('success','Contract submitted succesfully!');
 		}
 		else{
 			return redirect()->back()->with('fail','Contract could not submit!');
 		}
 	}

 	function deleteContract($id){
 		$delete= Contract::where('id',$id)->delete();
 	}
 	function getClients(){
 		$clients= User::select('id','name','email','company_name')
 						->where(['role'=>1,'is_client'=>1])
						->get();
		return $clients;				
 	}
 	//contacts end
}
