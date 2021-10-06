@extends('freelancer.master')

@section('content')
<div class="right_col" role="main">
<!--contents start-->
<div class="container">
	<div class="row">
		<div class="error col-md-6" style="padding:0px 0px 20px 0px">
			<!--validation error-->
			@forelse ($errors->all() as $message)
    			<li style="color:#e74242; margin-left:20px;"><strong>{{$message}}</strong></li>
			@empty
			@endforelse
			<!--validation error end-->
			@if(Session::has('success'))
			<div class="alert alert-success  alert-dismissible  show" role="alert">
				<strong>{!!Session::get('success')!!}</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
			</div>
			@endif
			@if(Session::has('fail'))
			<div class="alert alert-danger  alert-dismissible  show" role="alert">
				<strong>{!!Session::get('fail')!!}</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>			
			</div>	
			@endif				
		</div>
		<!--error end-->
	</div>
</div>
<div class="container">

	<div class="row" style="padding:0px;">

		<div class="col-md-7">			
			<div class="panel panel-default">
				<div class="panel-heading">
					Update Detail Information

				</div>
				<div class="panel-body">

          <form class="form-horizontal form " method="post" action="{{route('updateDetailInfo')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
                        
                        <div class="form-group">
                          <label>What exactly you would like to work on (text)</label>
                            <input id="name" type="text" class="form-control" name="exact_work" value="{{$userDetail->exact_work}}" autofocus>
                        </div>                        
                        <div class="form-group">
                          <label>What is the most impressive work you have done </label>
                            <input id="name" type="text" class="form-control" name="impressive_work" value="{{$userDetail->impressive_work}}" autofocus>
                        </div>                       
                        <div class="form-group">
                          <label>Have you ever worked as freelancer </label>
                            <select class="form-control" name="workas_freelancer">
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                            </select>
                        </div>                        
                        
                        <div class="form-group">
                          <label>Preferred start date (mm-dd-yy)</label>
                            <input id="name" type="date" class="form-control" name="start_date" value="{{$userDetail->start_date}}" autofocus>
                        </div>                                                
                        <div class="form-group">
                          <label>How many hours you want to work per week </label>
                            <select class="form-control" name="hours">
                              <option value="10">10 Hours</option>
                              <option value="20">20 Hours</option>
                              <option value="25">20 Hours</option>
                              <option value="30">30 Hours</option>
                              <option value="40">40 Hours</option>
                            </select>
                        </div>                        
                        <div class="form-group">
                          <label>For how long you want to be engaged with our company </label>
                            <select class="form-control" name="engagement_duration">
                              <option value="3 Months" >3 Months</option>
                              <option value="6 Months">6 Months</option>
                              <option value="1 Year">1 Year</option>
                              <option value="3 Year">3 Years</option>
                            </select>
                        </div>   
                        <div class="form-group">
                          <label>What do you think are the keys to success when working remotely with a client?</label>
                          <textarea class="form-control" name="keyof_success" >{{$userDetail->keyof_success}}</textarea>
                        </div>                           

                        <div class="form-group">
                          <label>Technical?</label>
                          <select class="form-control" name="technical">
                            <option value="Yes" 
                            <?php if($userDetail->technical=="Yes"){
                              echo "selected";
                            }?>
                              >Yes</option>
                            <option value="No" 
                            <?php if($userDetail->technical=="No"){
                              echo "selected";
                            }?>

                              >No</option>
                          </select>
                        </div>    

                        <div class="form-group">
                          <label>CV (max size:20mb)  (attached cv: <a href="{{url('storage/app/cv')}}/{{$userDetail->cv}}">{{$userDetail->cv}}</a>)</label>
                            <input id="name" type="file" class="form-control" name="cv" value=""autofocus>
                        </div>                        

                        <div class="form-group">
                          <label>Manager</label>
                            <select type="text" class="form-control" name="manager" >
                              <option value="Yes" 
                              <?php if($userDetail->manager=="Yes"){
                                echo "selected";
                              }
                              ?>
                                >Yes</option>
                              <option value="No"
                              <?php if($userDetail->manager=="No"){
                                echo "selected";
                              }
                              ?>
                              >No</option>
                            </select> 
                        </div>                        

                        <div class="form-group">
                          <label>How many projects completed </label>
                            <input type="number" class="form-control" name="project_completed" value="{{$userDetail->project_completed}}"></input> 
                        </div>

            <div class="form-group">
              <button type="submit" class="btn btn-default">Update Information</button>
            </div>
          </div>  <!--panel-body-->           
          </form>
				</div>
			</div>
		</div>
	</div>
</div>
<!--contents end-->
</div>

<!--skill add modal-->
<div class="modal fade" id="addskills" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Skill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('updateSkill')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
				<div class="control-group">
					<label for="select-state">Select Skills (max:10)</label>
					<select id="select-state" name="skills[]" multiple class="demo-default" style="" placeholder="Select a skill...">
						
						<option value="">Select</option>
                        <option value="Web Design">Web Design</option>
                        <option value="Web Development">Web Development</option>
                        <option value="Graphics Design">Graphics Design</option>
					</select>		
				</div>	
          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Update</button>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--skill add modal end-->

<!--industry add modal-->
<div class="modal fade" id="addindustry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Industry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('updateIndustry')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
				<div class="control-group">
					<label for="select-state">Select Industries (max:5)</label>
					<select id="select-industry" name="industry[]" multiple class="demo-default" style="" placeholder="Select a industry...">
						<option value="">Select</option>

                            	<option value="IT">IT</option>
                            	<option value="Business">Business</option>
                            	<option value="Education">Education</option>
					</select>		
				</div>	
          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Update</button>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--industry add modal end-->
@endsection

@section('js')
<script type="text/javascript" src="{{url('public/js/selectize.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/index.js')}}"></script>
<script>
	$('#select-state').selectize({
		maxItems: 10
	});	
	$('#select-industry').selectize({
		maxItems: 5
	});
</script>
@endsection
