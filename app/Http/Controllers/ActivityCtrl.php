<?php

namespace admin\Http\Controllers;
use admin\Http\Controllers\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;//db facades
use Illuminate\Support\Facades\Auth;//db facades
use admin\Locations;
use admin\User;
use admin\Activity;
use admin\ProjectRequest;

class ActivityCtrl extends Controller
{   

    public $user;
    function __construct(){
        $this->middleware('auth');
    // check role
        $this->middleware(function ($request, $next) {
        $this->user = Auth::user();
        if($this->user->is_admin===1){
            return $next($request);
        }
        else{
            return redirect()->route('public');
        }
        
    });
    //check role end
    
    }  
    function activities(){
    	$title= "Freelancers Activity";
        //creating obj for user ctrl
        $userObj= new Users;
        $freelancers= $userObj->getAllUsers();
        //getting clients
        $clients= $this->getClients();
        //getting activities
        $activities= $this->getActivityPag();
        //getting activeReq
        //$activeReq= $this->getActiveRequest();

    	return view('admin/activity')->with(['title'=>$title,'freelancers'=>$freelancers,'activities'=>$activities,'clients'=>$clients]);
    }

    function assignedFreelancerAsperProject($project_id){
        $title= "Assgined Freelancers";
        $freelancers= $this->freelancersForProject($project_id);
        return view('admin.assigned_freelancer')->with(['title'=>$title,'freelancers'=>$freelancers]);

    }
    function getClients(){
        $clients= User::select('id','name')
                    ->where(['is_client'=>1,'role'=>1])
                    ->get();
        return $clients;             
    }   
    function getActiveRequest(){
        $activeReq= ProjectRequest::select('*')

                    ->where(['status'=>1])
                    ->get();
        return $activeReq;                    
    }

    function saveActivity(Request $request){
        $n= count($request->user_id);
        for($i=0; $i<$n; $i++){

            $post= [
                'user_id'=>$request->user_id[$i],
                'project_id'=>$request->project_id,
                'earnt_money'=>$request->earnt_money,
                'pending_payout'=>$request->pending_payout,
                'further_info'=>$request->further_info
            ];
            $q= new Activity($post);
            $q->save();
        }
        
            return redirect()->back()->with('success','Activity added!');
    }

    function updateActivity(){}

    function deleteActivity(){}



    function getActivityPag(){
        $activities= Activity::select('users.surname','users.image','activities.*','project_req.title','clients.email as clientEmail','clients.name as clientName')
            ->join('users','users.id','=','activities.user_id')
            ->join('project_req','project_req.id','=','activities.project_id')
            ->join('users as clients','clients.id','=','project_req.client_id')
            ->orderBy('activities.id','desc')
            ->groupBy('project_req.id')
            ->paginate(10);
        return $activities;        
    }

    function saveLocation(Request $request){

    }

    function updateLocation(Request $request){
    	$location = Locations::where('id', $request->id)
    					->update([
                        'country'=>$request->country,
                        'city'=>$request->city,
                        'address'=>$request->address
                        ]);
   		if($location){
    		return redirect()->route('getLocations')->with('success','Location Updated!');

   		} 
   		else{
    		return redirect()->route('getLocations')->with('fail','Location Could Not Update!');

   		}					
    }

    function deleteLocation($id){
 		$location= Locations::where('id',$id)
 					 ->delete();
     
    }

    function getProjectsAsperClient($client_id){
        $projects= $this->getClientProject($client_id);
        if(count($projects)>0){
            foreach ($projects as $key => $value) {
                echo "<option value='$value->id'>$value->title</option>";
            }            
        }
        else{
            echo "<option>No record found</option>";
        }

    }

    function getClientProject($client_id){
        $projects= ProjectRequest::select('*')
                    ->where(['client_id'=>$client_id,'status'=>1])
                    ->get();
        return $projects;            
    }

    function freelancersForProject($project_id){
        $freelancers= Activity::select('*','u.surname','u.image','u.id as userId')
                    ->join('users as u','u.id','=','activities.user_id')
                    ->where(['project_id'=>$project_id])
                    ->get();
        return $freelancers;            
    }
}
