<?php
 
namespace admin\Http\Controllers;
//auth package for authentication 
//use admin\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;//for file upload
use admin\Worklog ;
use admin\User;
use admin\UserDetail;
use admin\Activity;
use admin\Report;
use PDF;
class HomeController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function test(){
        return view('admin.test');
    }
    public function index()
    {
        $is_admin= Auth::user()->is_admin;
        $is_client= Auth::user()->is_client;
        $role= Auth::user()->role;

        if($is_admin===1 AND $role===1){
   
            return redirect()->route('admin');            
        }
        elseif ($is_client===1 AND $role===1){
            return redirect()->route('clientDashboard');
        }  
        else{
            $title= "Freelancer-Dashboard";
                            
            return view('freelancer.dashboard')->with(['title'=>$title]);            
        }  

    }

    function freelancerActivity(){
        $title= "Freelancer Activity";
        $activities= $this->idWiseFreelancerAct(Auth::id());

        return view('freelancer.activity')->with(['title'=>$title,'activities'=>$activities]);
    }

    function setting(){
        //getting my profile info
        $id= Auth::id();
        $title="My Profile";
        $profile= User::select('*')
                        ->where('id',Auth::id())
                        ->first();
             
        return view('freelancer.myprofile')->with(['title'=>$title,'profile'=>$profile]);
    }

    function updateSkill(Request $request){
        $skills= implode(',',$request->skills);
        $post= ['skills'=>$skills];
        $update= $this->update($post,Auth::id());

        if($update===true){
            return redirect()->back()->with('success',"Skills updated!");
        }
        else{
            return redirect()->back()->with('fail',"Skills could not update!");  
        }
    }    

    function updateIndustry(Request $request){
        $industry= implode(',',$request->industry);
        $post= ['industry'=>$industry];
        $update= $this->update($post,Auth::id());

        if($update===true){
            return redirect()->back()->with('success',"Industry updated!");
        }
        else{
            return redirect()->back()->with('fail',"Industry could not update!");  
        }
    }

    function updateProfile(Request $request){

        //unset($request['_token']);
        //validate data 
            //validate data
            $this->validate($request,[
                'skype'=>'required',
                //'mobile' => 'required|numeric|digits_between:10,15',
                'project_work' => 'required',
                'linkedin' => 'required',
                //'other_site' => 'required',
                'about' => 'required',
                'country' => 'required',
                'city' => 'required'
            ]);

        if(empty($request->file('image'))){
            $request['image']= $request->img;
            unset($request['img']);
            unset($request['_token']);

            if($this->update($request->all(), Auth::id())===true){
               return redirect()->route('myProfile')->with('success',"Profile has updated!");                
            }
            else{
               return redirect()->route('myProfile')->with('fail',"Profile could not update!");                
            }
        }
        else{
                $this->validate($request, [
                    'image' => 'image|mimes:jpeg,png,jpg|max:600'
                    
                ]);

        if($request->hasFile('image')){

            if($request->file('image')->isValid()){
 
               if( $request->file('image')->storeAs("avatars", $request->file('image')->getClientOriginalName())){
                    

                    $post= [
                            'image'=>$request['image']=$request->file('image')->getClientOriginalName(),
                            'image_path'=>$request['image_path']=$request->file('image')->path(),
                            'name'=>$request->name,
                            'about'=>$request->about,
                            //'bio'=>$request->bio,
                            'country'=>$request->country,
                            'city'=>$request->city,
                            'mobile'=>$request->mobile,
                            'skype'=>$request->skype,
                            'project_work'=>$request->project_work,
                            'linkedin'=>$request->linkedin,
                            'other_site'=>$request->other_site
                            ];

                    if($this->update($post,Auth::id())===true){
                        
                       return redirect()->route('myProfile')->with('success',"Profile has updated!");                        
                    }
                    else{
                        
                        return redirect()->route('myProfile')->with('fail',"Profile could not update!");
                       }


               }
               
               }

                 
            }            
        }
   
    }

   

    function checkDetail($id){
        $q= UserDetail::select('id')
                    ->where(['user_id'=>$id])
                    ->get();
        if(count($q)>0){
            return true;
        }              
        else{
            return false;
        }      
    }
//change password
    function changePassword(){
        return view('change_password');
    }  

    function updatePassword(Request $request){


        $this->validate($request, [
           'old_password' => 'required',
           'password' => 'required|min:6|confirmed',
           
            ]);
        $newpassword= $request->password;

        if (Hash::check($request->old_password, Auth::user()->password)) {
            $update= User::where('id',Auth::id())
                            ->update(['password'=>bcrypt($newpassword)]);  
            return redirect()->route('changePassword')->with('success',"Password Changed!");

            }              

        else{
               return redirect()->route('changePassword')->with('fail',"Old password not matched!");
          
        }
    }    

    function detailInformation(){

        $title= "Dashboard-Detail Information";
        $userDetail= $this->getSingleUserDetailInfo(Auth::id());

        if(!empty($userDetail)){

            return view('freelancer.detail_information')->with(['title'=>$title, 'userDetail'=>$userDetail]);
        }
        else{
            return view('freelancer.add_detail_information')->with(['title'=>$title]);            
        }
    } 

    function updateDetailInfo(Request $request){
        

        $checkDetail= $this->checkDetail(Auth::id());
        if($checkDetail===true){
            if(empty($request->file('cv'))){
                //date validation
                $this->validate($request, [
                    'start_date'=>'date_format:Y-m-d'
                    ]);
                unset($request['_token']);
                unset($request['submit']);
                
                $update= $this->updateUserDetail($request->all(),Auth::id());
                if($update===true){
                    return redirect()->back()->with('success',"Detail information updated!");
                }
                else{
                    return redirect()->back()->with('fail',"Detail information could not udpate!");
                }
            }  //if empty cv end 
            else{
            /*
            $request->file('image')->storeAs("avatars", $request->file('image')->getClientOriginalName())
            */  
                $this->validate($request, [
                    'cv' => 'mimes:doc,docx,pdf|max:20000'
                ]); 

                $post= [
                "exact_work" => $request->exact_work,
                "impressive_work" => $request->impressive_work,
                "workas_freelancer" => $request->workas_freelancer,
                "start_date" => $request->start_date,
                "hours" => $request->hours,
                "engagement_duration" => $request->engagement_duration,
                "keyof_success" => $request->keyof_success,
                "technical" => $request->technical,
                "manager" => $request->manager,
                "project_completed" => $request->project_completed,
                "cv" => $request->file('cv')->getClientOriginalName()
                ];

                $update= $this->updateUserDetail($post, Auth::id());
                if($update===true){
                    $request->file('cv')->storeAs("cv", $request->file('cv')->getClientOriginalName());

                    return redirect()->back()->with('success',"Detail information updated!");
                }
                else{
                    return redirect()->back()->with('fail',"Detail information could not udpate!");
                }
            }
        }
        //detail info not foud create new
        else{
            if(empty($request->file('cv'))){
                //date validation
                $this->validate($request, [
                    'start_date'=>'date_format:Y-m-d'
                    ]);
                unset($request['_token']);
                unset($request['submit']);
                $create= $this->saveUserDetail($request->all());

                if($create===true){
                    return redirect()->back()->with('success',"Detail information udpated!");
                }   
                else{
                    return redirect()->back()->with('fail',"Detail information could not udpate!");
                }
            } 
            else{

                $this->validate($request, [
                    'cv' => 'mimes:doc,docx,pdf|max:3000'
                ]);

                $post= [
                'user_id'=>Auth::id(),
                "exact_work" => $request->exact_work,
                "impressive_work" => $request->impressive_work,
                "workas_freelancer" => $request->workas_freelancer,
                "start_date" => $request->start_date,
                "hours" => $request->hours,
                "engagement_duration" => $request->engagement_duration,
                "keyof_success" => $request->keyof_success,
                "technical" => $request->technical,
                "manager" => $request->manager,
                "project_completed" => $request->project_completed,
                "cv" => $request->file('cv')->getClientOriginalName()
                ];

                $create= $this->saveUserDetail($post);
                if($create===true){
                    $request->file('cv')->storeAs("cv", $request->file('cv')->getClientOriginalName());

                    return redirect()->back()->with('success',"Detail information updated!");
                }
                else{
                    return redirect()->back()->with('fail',"Detail information could not udpate!");
                }                
            }//not empty cv
        }   
        //end of detail info creation     
    }

    function idWiseFreelancerAct($user_id){

        $activities= Activity::select('activities.*','project_req.title','project_req.id as projectId','clients.id as clientId','clients.email as clientEmail','clients.name as clientName','reports.attachment','reports.id as reportId')
            ->join('users','users.id','=','activities.user_id')
            ->join('project_req','project_req.id','=','activities.project_id')
            ->join('users as clients','clients.id','=','project_req.client_id')
            ->leftJoin('reports','reports.project_id','=','project_req.id')
            ->where('activities.user_id',$user_id)
            ->orderBy('activities.id','desc')
            ->groupBy('project_req.id')
            ->paginate(10);
            
        return $activities; 
    }    

    function getSingleUserDetailInfo($user_id){
        $get= UserDetail::select('*')->where('user_id',$user_id)->first();//fetching single row
        if($get){
            return $get;
        }
    }

    function saveUserDetail($post){
        $save = new UserDetail($post);
        if($save->save()){
            return true;
        }
        else{
            return false;
        }
    }

    function update($post, $user_id){
        $update= User::where(['id'=>$user_id])
                    ->update($post);
        if($update){
            return true;
        }            
        else{
            return false;
        }
    }
    function updateUserDetail($post, $user_id){
        $update= UserDetail::where(['user_id'=>$user_id])
                    ->update($post);
        if($update){
            return true;
        }            
        else{
            return false;
        }
    }


    function workLog(){
        $title= "work-log";
        $id= Auth::id();
        $date= date('Y-m-d');
        $worklog= worklog::where('user_id',$id)
                        ->where('created_at',$date)
                        ->orderBy('id', 'desc')
                        ->get();        
        return view('admin/worklog')->with(['title'=>$title,'worklog'=>$worklog]);
    }

    function saveWorklog(Request $request){
        $date= date('Y-m-d');

        $data= [
            'hour'=>$request->hour,
            'title'=>$request->title,
            'description'=>$request->detail
            ];
        $worklog= worklog::where(['hour'=>$request->hour,'created_at'=>$date])
            ->count();
        if($worklog >0){
            return redirect()->route('workLog')->with('fail',"You have aleary entered this hour!");
        }
        $worklog= new Worklog([
            'user_id' => Auth::id(),//getting active id
            'hour'=>$request->hour,
            'title'=>$request->title,
            'description'=>$request->detail
            ]);

        $worklog->save();
        return redirect()->route('workLog')->with('success', "data saved successfully!");   
      
    }

    function updateWorklog(Request $request){
        $worklog= Worklog::where('id',$request->id)
                          ->update(['hour'=>$request->hour,'title'=>$request->title,'description'=>$request->detail]) ;
        if($worklog){

            return redirect()->route('workLog')->with('success',"Data updated successfully!");
        }
        else{
            return redirect()->route('workLog')->with('fail',"Data not updated!");

        }
    }
    function deleteWorklog($id){
       $worklog= Worklog::where('id', $id)
                        ->delete();
        if($worklog){
            echo json_encode("Deleted");
        }          
        else{
            echo json_encode("not found");
        }      
    }

    function downloadPDF(){
        $data="hello";
        $pdf = PDF::loadView('admin.htmltopdfview',compact('data',$data));
      
        return $pdf->stream('invoice.pdf'); //stream is use for preview    
        //return $pdf->download('invoice.pdf');  //download is for direct download   

    }   

    function addReport(Request $request){
        $this->validate($request, [
            'attachment' => 'mimes:jpg,png,jpeg,doc,docx,pdf|max:20000'
            ]);

        if(empty($request->attachment)){
            $post= [
                'freelancer_id'=>Auth::id(),
                'client_id'=>$request->client_id,
                'project_id'=>$request->project_id,
                'title'=>$request->title,
                
                'comment'=>$request->comment
            ]; 
            $create= new Report($post);
            if($create->save()){
                
                return redirect()->back()->with('success','Report submitted succesfully!');
            }
            else{
                return redirect()->back()->with('fail','Report could not submit!');
            }             
        }
        else{
            $post= [
                'freelancer_id'=>Auth::id(),
                'client_id'=>$request->client_id,
                'project_id'=>$request->project_id,
                'title'=>$request->title,
                'attachment'=>$request->file('attachment')->getClientOriginalName(),
                'comment'=>$request->comment
            ];

            $create= new Report($post);
            if($create->save()){
                $request->file('attachment')->storeAs('reports',$request->file('attachment')->getClientOriginalName());
                return redirect()->back()->with('success','Report submitted succesfully!');
            }
            else{
                return redirect()->back()->with('fail','Report could not submit!');
            }            
        }

    }
    function viewReport($id){
        $title= "Report View";
        $report= Report::where(['project_id'=>$id,'freelancer_id'=>Auth::id()])
                ->paginate(10);

        return view('freelancer.view_report')->with(['title'=>$title, 'reports'=>$report]);
    }
}
