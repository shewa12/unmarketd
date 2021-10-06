    function updateDetail(Request $request){
        $checkDetail= $this->checkDetail(Auth::id());
        if($checkDetail===true){

//update the existing user
        if(empty($request->file('cv'))){

            $user=  UserDetail::where(['user_id'=>Auth::id()])
                        ->update([
                            //'user_id'=>Auth::id(),
                            'exact_work'=>$request->exact_work,
                            'impressive_work'=>$request->impressive_work,
                            'worked_on'=>$request->worked_on,
                            'skills'=>$request->skills,
                            'industry'=>$request->industry,
                            'linkedin'=>$request->linkedin,
                            'other_site'=>$request->other_site,
                            'bio'=>$request->bio
                            ]);

            if($user){
               return redirect()->route('myProfile')->with('success',"Profile has updated!");                
            }
            else{

               return redirect()->route('myProfile')->with('fail',"Profile could not update!");                
            }
        }
        else{
                $this->validate($request, [
                    'cv' => 'mimes:doc,docx,pdf|max:3000'
                ]);

        if($request->hasFile('cv')){

            if($request->file('cv')->isValid()){
 
               if( $request->file('cv')->storeAs("avatars", $request->file('cv')->getClientOriginalName())){
                    

                    $user= UserDetail::where(['user_id'=>Auth::id()])
                        ->update([
                            //'user_id'=>Auth::id(),
                            'cv'=>$request['cv']=$request->file('cv')->getClientOriginalName(),
                            'exact_work'=>$request->exact_work,
                            'impressive_work'=>$request->impressive_work,
                            'worked_on'=>$request->worked_on,
                            'skills'=>$request->skills,
                            'industry'=>$request->industry,
                            'linkedin'=>$request->linkedin,
                            'other_site'=>$request->other_site,
                            'bio'=>$request->bio
                            ]);
                    if($user){
                        
                       return redirect()->route('myProfile')->with('success',"Profile has updated!");                        
                    }
                    else{
                        
                        return redirect()->route('myProfile')->with('fail',"Profile could not update!");
                       }


               }
               
               }

                 
            }            
        }            
//update the existing user end
        }
        else{
//create new detail
        if(empty($request->file('cv'))){
            
            $user=  new UserDetail([
                            'user_id'=>Auth::id(),
                            'exact_work'=>$request->exact_work,
                            'impressive_work'=>$request->impressive_work,
                            'worked_on'=>$request->worked_on,
                            'skills'=>$request->skills,
                            'industry'=>$request->industry,
                            'linkedin'=>$request->linkedin,
                            'other_site'=>$request->other_site,
                            'bio'=>$request->bio
                            ]);
                 

            if($user->save()){
               return redirect()->route('myProfile')->with('success',"Profile has updated!");                
            }
            else{
               return redirect()->route('myProfile')->with('fail',"Profile could not update!");                
            }
        }
        else{
                $this->validate($request, [
                    'cv' => 'image|mimes:doc,pdf|max:2000'
                ]);

        if($request->hasFile('cv')){

            if($request->file('cv')->isValid()){
 
               if( $request->file('cv')->storeAs("avatars", $request->file('cv')->getClientOriginalName())){
                    
            $user=  new UserDetail([
                            'user_id'=>Auth::id(),
                            'cv'=>$request->file('cv')->getClientOriginalName(),
                            'exact_work'=>$request->exact_work,
                            'impressive_work'=>$request->impressive_work,
                            'worked_on'=>$request->worked_on,
                            'skills'=>$request->skills,
                            'industry'=>$request->industry,
                            'linkedin'=>$request->linkedin,
                            'other_site'=>$request->other_site,
                            'bio'=>$request->bio
                            ]);
                    if($user->save()){
                        
                       return redirect()->route('myProfile')->with('success',"Profile has updated!");                        
                    }
                    else{
                        
                        return redirect()->route('myProfile')->with('fail',"Profile could not update!");
                       }


               }
               
               }

                 
            }            
        }             
//create new detail end
        }
        //else end
   
    } 