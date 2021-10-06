<?php

namespace admin\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use admin\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;//new class for override default registration 
use Illuminate\Support\Facades\Mail;
use admin\Mail\EmailVerification;
use admin\User;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'image'=>'image|mimes:jpeg,png,jpg|max:600',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'surname' => 'required|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'skype'=>'required',
            'mobile' => 'numeric|digits_between:10,15',
            'project_work' => 'required',
            'skills' => 'required',
            'industry' => 'required',
            //'linkedin' => 'url',
            //'other_site' => 'url',
            'about' => 'required',
            'country' => 'required',
            'city' => 'required'
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      
        return User::create($data);
    }

//custom register    
    public function register(Request $request)
    {
        $img= "";
        $img_path= "";
        $skills= implode(',',$request->skills);
        $industry= implode(',',$request->skills);
        if($_FILES['image']['name'] !==''){
            $img= $request->file('image')->getClientOriginalName();
            $img_path= $request->file('image')->path();            
        }

        $this->validator($request->all())->validate();
        
        
        $post= [
            'image'=>$img,
            'image_path'=>$img_path,
            'name'=>$request->name,
            'surname'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            //'bio'=>$request->bio,
            'skype'=>$request->skype,
            'mobile'=>$request->mobile,
            'project_work'=>$request->project_work,
            'skills'=>$skills,
            'industry'=>$industry,
            'linkedin'=>$request->linkedin,
            'other_site'=>$request->other_site,
            'about'=>$request->about,
            'country'=>$request->country,
            'city'=>$request->city,
            'token'=>str_random(10)

        ];
        event(new Registered($user = $this->create($post)));

        //sending mail
        $send= $this->sendMail($post['surname'], $post['email'], $post['token']);
        if($send){
            if($_FILES['image']['name'] !==''){
                $request->file('image')->storeAs("avatars", $request->file('image')->getClientOriginalName());            
            }

            return redirect('/login')->with('success', 'Registration success! An email has sent to your mail, please verify to login!');            
        }
        else{
            $delete= User::where(['email'=>$post['email']])
                        ->delete();
            return redirect()->back('fail',"Registration failed! Please try again.");                
        }


    }    
//custom register end 
  
    function sendMail($username, $useremail, $token){

        Mail::to($useremail)->send(new EmailVerification($username,$useremail,$token));

        if(Mail::failures()){
            return false;
        }        
        else{
            return true;
        }
    }

    public function verify($token)
    {
        // The verified method has been added to the user model and chained here
        // for better readability
        User::where('token',$token)->update(['role'=>1]);
        return redirect('login')->with('success',"Verification success! Please login.");
    }
      
}
