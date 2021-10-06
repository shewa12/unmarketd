@extends('admin.master')

@section('content')
	<div class="right_col" role="main">
		  <div class="row">
        <!--flass message-->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
              <a class='close' data-dismiss='alert'>×</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif        
        @if(Session::has('success'))
            <div class="alert alert-success">
              <a class='close' data-dismiss='alert'>×</a>
                <h4>{!!Session::get('success')!!}</h4>
            </div>
        @endif        

        @if(Session::has('fail'))
            <div class="alert alert-danger">
                <h4>{!!Session::get('fail')!!}</h4>
            </div>
        @endif
        <!--end flass message-->
      </div>  

<!--detail -->
<div class="container">
<div class="row">
    <div class="col-md-6">
        <div class="panel-default panel">
            <div class="panel-heading">Basic Information</div>

            <div class="panel-body">
              <?php $url= url('storage/app/avatars/');?>
              <?php if(!empty($basic->image)):?>
              <div class="form-group">
                <img class="image-thumbnail" src="{{$url.'/'.$basic->image}}" style="width:100px;height:100px;border-radius:50%">
              </div>
              <?php else:?>
              <div class="form-group">
                <img class="image-thumbnail" src="{{url('/public/img/avatar.png')}}"style="width:100px;height:100px;border-radius:50%">
              </div>        
              <?php endif?>
              <div class="form-group">
                <label>Email:</label>
                {{$basic->email}}
              </div>                  

              <div class="form-group">
                <label>Fullname:</label>
                {{$basic->name}}
              </div>              

              <div class="form-group">
                <label>Surname:</label>
                {{$basic->surname}}
              </div>
              <div class="skills">
                <h4>Skills </h4>
                <?php 
                  $arrSkill= explode(',', $basic->skills);
                  
                ?>
                @forelse($arrSkill as $skill)

                <button class="btn btn-xs btn-default">{{$skill}}</button>
                @empty
                @endforelse
              </div>
              <div class="industry">
                <h4>Industries </h4>

                <?php 
                  $arrIndustry= explode(',', $basic->industry);
                  
                ?>
                @forelse($arrIndustry as $industry)

                <button class="btn btn-xs btn-default">{{$industry}}</button>
                @empty
                @endforelse 
                
              </div>
          
              <div class="form-group">
                  <label>Skype ID: </label>
                  {{$basic->skype}}
              </div>                

              <div class="form-group">
                <label>Mobile: </label>
                {{$basic->mobile}}
              </div>      
      
              <div class="form-group">
                  <label>Linkedin ID: </label>
                  {{$basic->linkedin}}
              </div>               

              <div class="form-group">
                  <label>Other Site: </label>
                  {{$basic->other_site}}
              </div>               

              <div class="form-group">
                  <label>Country: </label>
                  {{$basic->country}}
              </div>               
              <div class="form-group">
                  <label>City: </label>
                  {{$basic->city}}
              </div> 

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel-default panel">
            <div class="panel-heading">Detail Information</div>

            <div class="panel-body">
              @if(!empty($detail))
                        <div class="form-group">
                          <label>What exactly you would like to work on: </label>
                            {{$detail->exact_work}}
                        </div>                        
                        <div class="form-group">
                          <label>What is the most impressive work you have done: </label>
                            {{$detail->impressive_work}}
                        </div>                       
                        <div class="form-group">
                          <label>Have you ever worked as freelancer: </label>
                           {{$detail->workas_freelancer}}
                        </div>                        
                        
                        <div class="form-group">
                          <label>Preferred start date: </label>
                            {{$detail->start_date}}
                        </div>                                                
                        <div class="form-group">
                          <label>How many hours you want to work per week: </label>
                          {{$detail->hours}}
                        </div>                        
                        <div class="form-group">
                          <label>For how long you want to be engaged with our company: </label>
                          {{$detail->engagament_duration}}
                        </div>   
                        <div class="form-group">
                          <label>What do you think are the keys to success when working remotely with a client: </label>
                          {{$detail->keyof_success}}
                        </div>                           

                        <div class="form-group">
                          <label>Technical: </label>
                          {{$detail->technical}}
                        </div>    

                        <div class="form-group">
                          <label>Aattached CV: </label>
                          <a href="{{url('storage/app/cv')}}/{{$detail->cv}}">{{$detail->cv}}</a>                           
                        </div>                        

                        <div class="form-group">
                          <label>Manager: </label>
                          {{$detail->manager}}
                        </div>                        

                        <div class="form-group">
                          <label>How many projects completed: </label>
                            {{$detail->project_completed}} 
                        </div>
              @else
              <div class="alert alert-info">Freelancer detail has not been added</div>
              @endif
            </div>
        </div>
    </div>
    <!--user detail end-->
    <div class="clearfix"></div>
    <!--activity -->
    <div class="col-md-12">
      <div class="panel-default panel">
          <div class="panel-heading">Activities</div>

          <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Client Name</th>
                    <th>Client Email</th>
                    <th>Project Title</th>
                    <th>Money Earnt</th>
                    <th>Number of Hour Per Week</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $i=1;
                  ?>

                  @forelse ($activity as $value)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$value->clientName}}</td>
                    <td>{{$value->clientEmail}}</td>
                    <td>{{$value->title}}</td>
                    <td>{{$value->earnt_money}}</td>
                    <td>{{$value->pending_payout}}</td>
                  </tr>
                  @empty
                  <tr><td>No record found</td></tr>
                  @endforelse
                </tbody>
            </table>  
            </div>
          </div>
      </div>
    </div>
    <!--activity end-->    

    <!--performance -->
    <div class="col-md-12">
      <div class="panel-default panel">
          <div class="panel-heading">Performance</div>

          <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sl No:</th>
                    <th>Project Complexity</th>
                    <th>KPI</th>
                    <th>Seniority</th>
                    <th>Interview Text</th>
                    <th>Skill Deepth</th>
                    <th>Selling Price</th>
                    <th>Buying Price</th>

                </tr>
                </thead>
                <tbody>
                  <?php $i=1;?>
                  @forelse($performance as $value)
                  <tr>
                    <td>{{$i++}}</td>
                
                    <td class="col-md-2">
                      <div class="progress">
                        <div class="progress-bar-warning progress-bar-striped active" role="progressbar"
                        aria-valuenow="{{$value->project_complxity}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$value->project_complxity}}%">
                          {{$value->project_complxity}}%
                        </div>
                      </div>                       
                      
                    </td>
                    <td class="col-md-2">
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                        aria-valuenow="{{$value->kpi}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$value->kpi}}%">
                          {{$value->kpi}}%
                        </div>
                      </div>                    </td>
                    <td>{{$value->seniority}}</td>
                    <td>{{$value->interview_text}}</td>
                    <td>{{$value->skill_deepth}}</td>
                    <td>{{$value->buying_price}}</td>
                    <td>{{$value->selling_price}}</td>                   
                  </tr>
                  @empty
                  <tr><td>No record found</td></tr>
                  @endforelse
                </tbody>
            </table> 
            </div>
          </div>
      </div>
    </div>
    <!--performance end-->
</div>
</div>     
<!--detail end-->     

<!-- Modal for add -->
<div class="modal fade" id="addform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add work log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('saveUser')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
          <div class="form-group">
            <label for="image">Add Image</label>
            <input type="file" class="form-control" name="image" id="image" required></input>
          </div>
          <div class="form-group">
            <label for="name">User Name</label>
            <input class="form-control" name="name" id="name" required></input>
          </div>          

          <div class="form-group">
            <label for="age">Age</label>
            <input class="form-control" name="age" id="age"></input>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" name="email" id="email" required></input>
          </div>             

          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" name="password" id="password" required></input>
          </div>           
          <div class="form-group">
            <label for="Address">Address</label>
            <input class="form-control" name="address" id="Address"></input>
          </div>           
          <div class="form-group">
            <label for="phoneNumber">Phone Number</label>
            <input class="form-control" name="phoneNumber" id="phoneNumber"></input>
          </div>           

           <div class="form-group">
            <label for="region">Region Number</label>
            <input class="form-control" name="region" id="region"></input>
          </div>           

           <div class="form-group">
            <label for="zipCode">Zip Code</label>
            <input class="form-control" name="zipCode" id="zipCode"></input>
          </div>              

          <div class="form-group">
            <label for="recognitionSign">Recognition Sign</label>
            <input class="form-control" name="recognitionSign" id="recognitionSign"></input>
          </div>           

           <div class="form-group">
            <label for="about">About </label>
            <textarea id="about" id="about" class="form-control" name="about"></textarea>
          </div>          


          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--modal for add end-->   

<!--edit form--> 

<div class="modal fade" id="editform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update work log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('updateUser')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
   

          <input type="hidden" name="id" value="">
          <div class="form-group">
            <label for="image">Add Image</label>
            <input type="file" class="form-control" name="image" id="image"></input>
          </div>
          <div class="form-group">
            <label for="name">User Name</label>
            <input class="form-control" name="name" id="name" required></input>
          </div>          

          <div class="form-group">
            <label for="age">Age</label>
            <input class="form-control" name="age" id="age"></input>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" name="email" id="email" required></input>
          </div>             

          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" name="password" id="password" required></input>
          </div>           
          <div class="form-group">
            <label for="Address">Address</label>
            <input class="form-control" name="address" id="Address"></input>
          </div>           
          <div class="form-group">
            <label for="phoneNumber">Phone Number</label>
            <input class="form-control" name="phoneNumber" id="phoneNumber"></input>
          </div>           

           <div class="form-group">
            <label for="region">Region Number</label>
            <input class="form-control" name="region" id="region"></input>
          </div>           

           <div class="form-group">
            <label for="zipCode">Zip Code</label>
            <input class="form-control" name="zipCode" id="zipCode"></input>
          </div>              

          <div class="form-group">
            <label for="recognitionSign">Recognition Sign</label>
            <input class="form-control" name="recognitionSign" id="recognitionSign"></input>
          </div>           

           <div class="form-group">
            <label for="about">About </label>
            <textarea id="about" id="about" class="form-control" name="about"></textarea>
          </div>          


          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--edit form end--> 
	</div><!--main  col div end-->
@endsection

@section('js')

	<script type="text/javascript">
		function edit(id, name, email,address,phoneNumber,age,region,zipCode,recognitionSign,password){
      $('[name="id"]').val(id);
      $('[name="name"]').val(name);
      $('[name="email"]').val(email);
      $('[name="address"]').val(address);
      $('[name="phoneNumber"]').val(phoneNumber);
      $('[name="age"]').val(age);
      $('[name="region"]').val(region);
      $('[name="zipCode"]').val(zipCode);
      $('[name="recognitionSign"]').val(recognitionSign);
      $('[name="password"]').val(password);
		}

//deleting 
 
	</script>
  <script type="text/javascript">
  $(document.body).on('click', '.delete' ,function(e) {

    if(confirm("Do you want to delete this data?")){
    const id = $(this).attr('id');
    
    var whichtr = $(this).closest("tr");   
//deleting 

        // ajax delete data from database
          $.ajax({
            url : "<?php echo url('/delete-freelancer')?>/"+id,
            type: "GET",
            dataType: "HTML",
            success: function(data)
            {
              
              whichtr.remove(); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

  }    
}); 
  </script>
@endsection