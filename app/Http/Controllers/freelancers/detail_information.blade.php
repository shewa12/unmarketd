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
					Detail Information

				</div>
				<div class="panel-body">
					<form class="form-horizontal form col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3" method="post" action="{{route('updateDetail')}}" enctype="multipart/form-data">
						{{ csrf_field() }}
                        
                        <div class="form-group">
                        	<label>What exactly you would like to work on (text)</label>
                            <input id="name" type="text" class="form-control" name="exact_work" value="{{$user->exact_work}}" autofocus>
                        </div>                        
                        <div class="form-group">
                        	<label>What is the most impressive work you have done </label>
                            <input id="name" type="text" class="form-control" name="impressive_work" value="{{$user->impressive_work}}" autofocus>
                        </div>                       
                        <div class="form-group">
                        	<label>Projects worked on</label>
                            <textarea class="form-control" name="worked_on" value="{{$user->worked_on}}">{{$user->worked_on}}</textarea>
                        </div>                        
                        
                        <div class="form-group">
                        	<label>Linkedin link </label>
                            <input id="name" type="url" class="form-control" name="linkedin" value="{{$user->linkedin}}" autofocus>
                        </div>                                                
                        <div class="form-group">
                        	<label>Other website link</label>
                            <input id="name" type="url" class="form-control" name="other_site" value="{{$user->other_site}}"autofocus>
                        </div>                        
                        <div class="form-group">
                        	<label>ABout</label>
                            <textarea id="name" type="text" class="form-control" name="about" value="{{$user->about}}"  autofocus>{{$user->about}}</textarea>
                        </div>                        
                        <div class="form-group">
                        	<label>CV</label>
                            <input id="name" type="file" class="form-control" name="cv" value="{{$user->cv}}"autofocus>
                        </div>

						<div class="form-group">
							<button type="submit" class="btn btn-default" name="submit">Update Information</button>
						</div>
                        </div>	<!--panel-body-->						
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
