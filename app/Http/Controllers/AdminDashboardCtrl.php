<?php

namespace admin\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use admin\UserServices;
use admin\User;
use admin\Performance;

class AdminDashboardCtrl extends Controller
{
    public $user;
    function __construct(){
        $this->middleware('auth');
    // check role
        /*
        $this->middleware(function ($request, $next) {
        $this->user = Auth::user();
        if($this->user->is_admin===1){
            return $next($request);
        }
        else{
            return redirect()->route('public');
        }
           
    });
    */ 
    //check role end
    
    }  

    function index(){
        $title= "Dashboard";
        
        return view('admin.dashboard')->with(['title'=>$title]);
                         
    }

    function setting(){
        $id= Auth::id();
        $title="Setting";
        $user=  User::all()->where('id',$id)->first();//fetching single row
                            
        return view('admin.setting')->with(['title'=>$title,'user'=>$user]);       
    }

    function updateAccount(Request $request){
        $dir= "uploads";
 
        if(empty($request->file('image'))){
            $id= Auth::id();
            $user=  user::where('id',$id)
                            ->update([

                            //'name'=>$request->name,
                            //'email'=>$request->email,
                            'image'=>$request->img,
                            'image_path'=>$request->img_path,
                            
                            
                            ]);

            if($user){
               
               return redirect()->back()->with('success',"Information has updated!");                
            }
        }
        else{
        if($request->hasFile('image')){

            if($request->file('image')->isValid()){
 
               if( $request->file('image')->storeAs("avatars", $request->file('image')->getClientOriginalName())){
                    $id= Auth::id();
                    $user=  user::where('id',$id)
                        ->update([
                        //'name'=>$request->name,
                        //'email'=>$request->email,
                       
                        'image'=>$request->file('image')->getClientOriginalName(),//retrieve filename
                        'image_path'=>$request->file('image')->path(),//retrieve file path

                        ]);

                    if($user){
                        
                       return redirect()->back()->with('success',"Information has updated!");                        
                    }
                    else{
                        echo "data could not saved";
                        return redirect()->back()->with('fail',"Information could not update!");
                       }


               }
               
               }

                 
            }            
        }  
    } 

    function adminChangePassword(){
        $title="Change Password";
        
        return view('admin.change_password')->with(['title'=>$title]);
    }  
    function adminUpdatePassword(Request $request){

        $this->validate($request, [
           'old_password' => 'required',
           'password' => 'required|min:6|confirmed',
           
            ]);
        $newpassword= $request->password;

        if (Hash::check($request->old_password, Auth::user()->password)) {
            $update= User::where('id',Auth::id())
                            ->update(['password'=>bcrypt($newpassword)]);  
            return redirect()->back()->with('success',"Password Changed!");

            }              

        else{
               return redirect()->back()->with('fail',"Old password not matched!");
          
        }
    }   

    function freelancerFilter(){
        $title= "Freelancer Filter";
        
        return view('admin/freelancer_filter')->with(['title'=>$title]);       
    } 

    //filtering start
    function skillFilter(Request $request){
        $col="skills";
        //$skills= implode(',',$request->skills);
        $skills= $request->skills;

        $title="Skill wise Filter";

        $res= $this->getSkillIndustrySortData($col,$skills);

        return view('admin.filter_result')->with(['title'=>$title,'result'=>$res]);
    }

    function industryFilter(Request $request){
        $industries= $request->industry;
        $col="industry";
        $title="Industry wise Filter";

        $res= $this->getSkillIndustrySortData($col,$industries);

        return view('admin.filter_result')->with(['title'=>$title,'result'=>$res]);        
    }

    function seniorityFilter(Request $request){
        $col="seniority";
        $title="Seniority wise Filter";

        $res= $this->getPerformSortingData($col,$request->seniority);

        return view('admin.filter_result')->with(['title'=>$title,'result'=>$res]);        
    }

    function buyingFilter(Request $request){
        $col="buying_price";
        $title="Buying Price wise Filter";

        $res= $this->getPerformSortingData($col,$request->buying_price);

        return view('admin.filter_result')->with(['title'=>$title,'result'=>$res]);         
    }

    function sellingFilter(Request $request){
        $col="selling_price";
        $title="Selling Price wise Filter";

        $res= $this->getPerformSortingData($col,$request->selling_price);

        return view('admin.filter_result')->with(['title'=>$title,'result'=>$res]);                 
    }

    function proComFilter(Request $request){
        $col="project_complexity";
        $title="Project Complexity wise Filter";

        $res= $this->getPerformSortingData($col,$request->skproject_complexityills);

        return view('admin.filter_result')->with(['title'=>$title,'result'=>$res]);       
    }

    function hourFilter(Request $request){
        $col="hours";
        $title="Hours wise Filter";

        $res= $this->getSortingData($col,$request->hours);

        return view('admin.filter_result')->with(['title'=>$title,'result'=>$res]);         
    }

    function technicalFilter(Request $request){
        $col="technical";
        $title="Technical wise Filter";

        $res= $this->getSortingData($col,$request->technical);

        return view('admin.filter_result')->with(['title'=>$title,'result'=>$res]);        
    }

    function managerFilter(Request $request){
        $col="manager";
        $title="Manager wise Filter";

        $res= $this->getSortingData($col,$request->manager);

        return view('admin.filter_result')->with(['title'=>$title,'result'=>$res]);        
    }

    function getSkillIndustrySortData($col,$data){
        //comma separated value finding
        $arr=[];
        for ($i=0; $i < count($data) ; $i++) { 
            $v= $data[$i];
            $q= User::select('users.*','user_detail.*')
                    ->leftJoin('user_detail','user_detail.user_id','=','users.id')
                    //->where($col,'like','%'.$v.'%')
                    ->whereRaw("find_in_set('$v',$col)")
                    ->get();  
            if(count($q)>0){
                $arr[]=$q; 
            }        
                             
        }

        return $arr;        
    }     

    function getSortingData($col,$data){
        $q= User::select('users.*','user_detail.*')
                ->leftJoin('user_detail','user_detail.user_id','=','users.id')
                ->where([$col=>$data])
                ->paginate(10);
        return $q;        
    }    

    function getPerformSortingData($col,$data){
        $q= User::select('users.*','performance.*')
                ->leftJoin('performance','performance.user_id','=','users.id')
                ->leftJoin('user_detail','user_detail.user_id','=','users.id')
                ->where([$col=>$data])
                ->paginate(10);
        return $q;        
    }
    //filtering end





//####### below code will be removed #####    
    function getServices(){
    	$title= "Services";
    	$services= UserServices::orderBy('id','desc')
    							->get();

    	return view('admin/services')->with(['title'=>$title,'services'=>$services]);
    }

    function saveService(Request $request){
    	$service= new UserServices([
    			'name'=>$request->name
    		]);
    	if($service->save()){
    		return redirect()->route('getServices')->with('success','Service Added!');
    	}
    	else{
    		return redirect()->route('getServices')->with('fail','Service Could Not Add!');

    	}
    }

    function updateService(Request $request){
    	$services = UserServices::where('id', $request->id)
    					->update(['name'=>$request->name]);
   		if($services){
    		return redirect()->route('getServices')->with('success','Service Updated!');

   		} 
   		else{
    		return redirect()->route('getServices')->with('fail','Service Could Not Update!');

   		}					
    }

    function deleteService($id){
 		$user= UserServices::where('id',$id)
 					 ->delete();
     
    }
}
