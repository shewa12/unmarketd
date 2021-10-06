<?php

namespace admin\Http\Controllers\Clients;

use admin\Http\Controllers\Controller;
use Illuminate\Http\Request;//request is for form input values 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;//hasching
use Illuminate\Support\Facades\Auth;//auth for get logged in info

use Illuminate\Http\UploadedFile;//for upload files
use admin\User;//user model
use admin\ProductService;//user model
use admin\Package;//user model
use admin\Ticket;//user model
use admin\ProjectRequest;//user model
use admin\Contract;//user model
use admin\Report;//user model
use admin\Activity;//user model

class ClientsCtrl extends Controller
{
	function __construct(){
		$this->middleware('auth');
	}

	function index(){
		$title= "Active Request";
		$activeReq= ProjectRequest::where(['status'=>1,'client_id'=>Auth::id()])
						->orderBy('id','desc')
						->paginate(10);

		return view('client.active_request')->with(['title'=>$title,'requests'=>$activeReq]);
	}

 	function comProfile(){
 		$title="Company Profile";
 		$id= Auth::id();
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

 	function supportTicket(){
 		$title= "Support Ticket";
		$tickets = Ticket::select()
					->where('client_id',Auth::id())
		 			->orderBy('id','desc')
		 			->paginate(10); 		
 		return view('client.support_ticket')->with(['title'=>$title,'tickets'=>$tickets]);
 	} 	

 	function addTick(){
 		$title= "Add Ticket";
		
 		return view('client.add_ticket')->with(['title'=>$title]);
 	} 	

 	function createTick(Request $request){
 		$post= [
 			'client_id'=>Auth::id(),
 			'title'=>$request->title,
 			'description'=>$request->description
 		]; 

 		$create= new Ticket($post);

 		if($create->save()){
 			return redirect()->route('supportTicket')->with('success',"Ticket submitted successfully!");
 		}
 		else{
 			return redirect()->route('supportTicket')->with('fail',"Ticket could not submit!");

 		}
 	}


 	function deleteTick($id){
 		$q= Ticket::where('id',$id)->delete();
 	}

 	function addReq(){
 		$title= "Add Request";
		
 		return view('client.add_req')->with(['title'=>$title]); 		
 	} 	

 	function editReq($id){
 		$title= "Edit Request";
		$request= ProjectRequest::where(['id'=>$id,'client_id'=>Auth::id()])
				->first();

 		return view('client.edit_req')->with(['title'=>$title,'request'=>$request]); 		
 	}


 	function createReq(Request $request){
 		$this->validate($request,[
 			'title'=>'required',
 			'service'=>'required',
 			'skills'=>'required',
 			'attachment'=>'mimes:jpg,jpeg,zip,ppt,png,doc,docx,pdf|max:20000',
 			'contact_person'=>'required',
 			'workload_hour'=>'required|numeric',
 			'noof_freelancer'=>'required|numeric',
 			'start_date'=> 'date_format:Y-m-d',
    		'end_date'=> 'date_format:Y-m-d|after:start_date',
 			]);
 		
 		$string= implode(',', $request->skills);
 		unset($request->skills);
 		unset($request['_token']);
 		$request['client_id']= Auth::id();
 		$request['skills']= $string;

 		if(empty($request->file('attachment'))){
 			$create= new ProjectRequest($request->all());
	 		if($create->save()){
	 			return redirect()->route('clientDashboard')->with('success',"Request submitted successfully!");
	 		}
	 		else{
	 			return redirect()->route('clientDashboard')->with('fail',"Request could not submit!");
	 		} 

 		}else{
 			$post= [
 				'client_id'=>Auth::id(),
 				'service'=>$request->service,
 				'title'=>$request->title,
 				'skills'=>$string,
 				'attachment'=>$request->file('attachment')->getClientOriginalName(),
 				'description'=>$request->description,
 				'contact_person'=>$request->contact_person,
 				'workload_hour'=>$request->workload_hour,
 				'noof_freelancer'=>$request->noof_freelancer,
 				'start_date'=>$request->start_date,
 				'end_date'=>$request->end_date
 			];
 			//save 
 			$create= new ProjectRequest($post);
	 		if($create->save()){
	 			$request->file('attachment')->storeAs("req-attach", $request->file('attachment')->getClientOriginalName());
	 			return redirect()->route('clientDashboard')->with('success',"Request submitted successfully!");
	 		}
	 		else{
	 			return redirect()->route('clientDashboard')->with('fail',"Request could not submit!");
	 		}  			
 			//save end
 			
 		}
 		
 	} 

 	function updateReq(Request $request){

 		$this->validate($request,[
 			'title'=>'required',
 			'service'=>'required',
 			'skills'=>'required',
 			'attachment'=>'mimes:jpg,jpeg,zip,ppt,png,doc,docx,pdf|max:20000',
 			'contact_person'=>'required',
 			'workload_hour'=>'required|numeric',
 			'noof_freelancer'=>'required|numeric',
 			//'start_date'=> 'date_format:Y-m-d',
    		'end_date'=> 'after:start_date',
 			]);
 		
 		$string= implode(',', $request->skills);
 		unset($request->skills);
 		unset($request['_token']);
 		$request['client_id']= Auth::id();
 		$request['skills']= $string;

 		if(empty($request->file('attachment'))){
 			$create= ProjectRequest::where('id',$request->id)
 					->update($request->all());

	 		if($create){
	 			return redirect()->route('clientDashboard')->with('success',"Request submitted successfully!");
	 		}
	 		else{
	 			return redirect()->route('clientDashboard')->with('fail',"Request could not submit!");
	 		} 

 		}else{
 			$post= [
 				'client_id'=>Auth::id(),
 				'service'=>$request->service,
 				'title'=>$request->title,
 				'skills'=>$string,
 				'attachment'=>$request->file('attachment')->getClientOriginalName(),
 				'description'=>$request->description,
 				'contact_person'=>$request->contact_person,
 				'workload_hour'=>$request->workload_hour,
 				'noof_freelancer'=>$request->noof_freelancer,
 				'start_date'=>$request->start_date,
 				'end_date'=>$request->end_date
 			];
 			//save 
 			$create= ProjectRequest::where('id',$request->id)
 						->update($post);

	 		if($create){
	 			$request->file('attachment')->storeAs("req-attach", $request->file('attachment')->getClientOriginalName());
	 			return redirect()->route('clientDashboard')->with('success',"Request submitted successfully!");
	 		}
	 		else{
	 			return redirect()->route('clientDashboard')->with('fail',"Request could not submit!");
	 		}  			
 			//save end
 			
 		}
 		
 	} 
 	function closedProject(){
		$title= "Closed Projects";
		$closedReq= ProjectRequest::where(['status'=>2,'client_id'=>Auth::id()])
						->paginate(10);

		return view('client.closed_request')->with(['title'=>$title,'requests'=>$closedReq]); 		
 	}
//below code need remove 		
 	function getUsers(){
 		$title= "App Users";
		$users = User::select()
					->where('role',0)
		 			->orderBy('id','desc')
		 			->get();
					   
		
 		return view('admin.appusers')->with(['title'=>$title,'users'=>$users]);
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


 	function deleteUser($id){
 		$user= User::where('id',$id)
 					 ->delete();

 	}

 	//contract & report
 	function clientContract(){
		$title= "Contracts";
		
		$contracts= Contract::select('*')
				
					->where(['client_id'=>Auth::id()])
					->paginate(10);

		return view('client.contract')->with(['title'=>$title,'contracts'=>$contracts]); 
 	} 	

 	function clientReport(){
		$title= "Reports";
		
		$reports= Report::select('reports.*','u.name','u.email','p.title')
					->join('users as u','u.id','=','reports.freelancer_id')
					->join('project_req as p','p.id','=','reports.project_id')
					->where(['reports.client_id'=>Auth::id()])
					->paginate(10);

		return view('client.report')->with(['title'=>$title,'reports'=>$reports]); 
 	}
 	//contract & report end
 	//assgined freelancer
 	function assignedFreelancer(){
 		$title="Assigned Freelancers";
 		$freelancers= Activity::select('u.*','p.title','activities.created_at as assignedDate')
 				->join('users as u','u.id','=','activities.user_id')
 				->join('project_req as p','p.id','=','activities.project_id')
 				->where('p.client_id',Auth::id())
 				->paginate(10);

 		return view('client.assigned_freelancer')->with(['title'=>$title,'freelancers'=>$freelancers]);		
 	}
 	//assgined freelancer end
 	
}
