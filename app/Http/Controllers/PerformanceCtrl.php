<?php

namespace admin\Http\Controllers;
use admin\Http\Controllers\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;//db facades
use Illuminate\Support\Facades\Auth;//db facades
use admin\User;
use admin\Performance;

class PerformanceCtrl extends Controller
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
        
    function performance(){
    	$title= "Performance";
        $userObj= new Users;
        $freelancers= $userObj->getAllUsers();

        $performances= $this->getPerformPag();

    	return view('admin/performance')->with(['title'=>$title,'freelancers'=>$freelancers,'performances'=>$performances]);
    }

    function savePerformance(Request $request){
        $q= new Performance($request->all());
        unset($request['_token']);

 
    	if($q->save()){
    		return redirect()->back()->with('success','Performance added!');
    	}
    	else{
    		return redirect()->back()->with('fail','Performance could not add!');

    	}
    }

    function getPerformPag(){
        $performances= Performance::select('users.id as userId','users.surname','users.image','performance.*')
            ->join('users','users.id','=','performance.user_id')
            ->orderBy('performance.id','desc')
            ->paginate(10);
        return $performances; 
    }

    function updatePerformance(Request $request){
        unset($request['_token']);
        
    	$feature = Performance::where('id', $request->id)
    					->update($request->all());
   		if($feature){
    		return redirect()->back()->with('success','Performance Updated!');

   		} 
   		else{
    		return redirect()->back()->with('fail','Performance Could Not Update!');

   		}					
    }
    /*
    function deleteFeature($id){
 		$feature= Features::where('id',$id)
 					 ->delete();
     
    }
    */
}
