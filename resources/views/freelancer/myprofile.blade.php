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

		<div class="col-md-8">
			<div class="panel-default panel">
			<div class="panel-heading">
				Profile Information
			</div>
			<div class="panel-body">
				<?php $url= url('storage/app/avatars/');?>
				<?php if(!empty($profile->image)):?>
				<div class="form-group">
					<img class="img-thumbnail img-rounded" src="{{$url.'/'.$profile->image}}">
				</div>
				<?php else:?>
				<div class="form-group">
					<img class="img-thumbnail img-rounded" src="{{url('/public/img/avatar.png')}}">
				</div>				
				<?php endif?>
				<div class="form-group">
					<label>Email: </label>
					{{$profile->email}}
				</div>				

				<div class="form-group">
					<label>Surname: </label>
					{{$profile->surname}}
				</div>
				<div class="skills">
					<h4>Skills <span class="pull-right"><button data-toggle="modal" data-target="#addskills" class="btn-xs btn btn-warning">Update</button></span></h4>
					<?php 
						$arrSkill= explode(',', $profile->skills);
						
					?>
					@forelse($arrSkill as $skill)

					<button class="btn btn-xs btn-default">{{$skill}}</button>
					@empty
					@endforelse
				</div>
				<div class="industry">
					<h4>Industries <span class="pull-right"><button data-toggle="modal" data-target="#addindustry" class="btn-xs btn btn-warning">Update</button></span></h4>

					<?php 
						$arrIndustry= explode(',', $profile->industry);
						
					?>
					@forelse($arrIndustry as $industry)

					<button class="btn btn-xs btn-default">{{$industry}}</button>
					@empty
					@endforelse	
					
				</div>
				<div class="profile-detail">
					<form action="{{route('updateProfile')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						<input type="hidden" name="img" value="{{$profile->image}}">
						<div class="form-group">
							<label>Image</label>
							<input type="file" class="form-control" name="image"/>
							
						</div>			

						<div class="form-group">
							<label>Full Name</label>
							<input class="form-control" name="name" value="{{$profile->name}}" required/>
						</div>	
		
                        <div class="form-group">
                        	<label>Skype ID</label>
                            <input id="name" type="text" class="form-control" name="skype" value="{{$profile->skype}}" required autofocus>
                        </div>                        
                        <div class="form-group">
                        	<label>Mobile</label>
                            <input id="name" type="text" class="form-control" name="mobile" value="{{$profile->mobile}}"  maxlength="15" autofocus >
                        </div>   
						<div class="form-group">
							<label>About</label>
							<textarea class="form-control" name="about" value="{{$profile->about}}" required>{{$profile->about}}</textarea>
						</div>	

                        <div class="form-group">
                        	<label>Past Clients Name</label>
                            <input id="name" type="text" class="form-control" name="project_work" value="{{$profile->project_work}}"  maxlength="15" autofocus required>
                        </div>


                        <div class="form-group">
                        	<label>Linkedin</label>
                            <input id="name" type="url" class="form-control" name="linkedin" value="{{$profile->linkedin}}"  maxlength="15" autofocus required>
                        </div>                        

                        <div class="form-group">
                        	<label>Other Site</label>
                            <input id="name" type="url" class="form-control" name="other_site" value="{{$profile->other_site}}"  maxlength="15" autofocus >
                        </div>   

                        <div class="form-group">
                        	<label>Country</label>
                            <input id="name" type="text" class="form-control" name="country" value="{{$profile->country}}"autofocus required>
                        </div>                        
                        <div class="form-group">
                        	<label>City</label>
                            <input id="name" type="text" class="form-control" name="city" value="{{$profile->city}}"  autofocus required>
                        </div>                        
                                         
                        <div class="form-group">
                        	<button class="btn-default btn" >Update Profile</button>
                        </div>
                    </form>    
				</div>
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
                                <option value="Paid social">Paid social</option>
                                <option value="Paid search">Paid search</option>
                                <option value="SEO">SEO</option>
                                <option value="Mobile app setup - analytics, product marketing">Mobile app setup - analytics, product marketing</option>
                                <option value="Mobile app UA">Mobile app UA</option>
                                <option value="Web analytics">Web analytics</option>
                                <option value="BI and reporting">BI and reporting</option>
                                <option value="UI/UX">UI/UX</option>
                                <option value="CRO">CRO</option>
                                <option value="Graphic design and animation">Graphic design and animation</option>
                                <option value="CRM and retention">CRM and retention</option>
                                <option value="Growth hacking, strategy, and digital transformation">Growth hacking, strategy, and digital transformation</option>
                                <option value="Product launch and product marketing">Product launch and product marketing</option>
                                <option value="Graphic Design">Graphic Design</option>
                                <option value="Animation, 2D/3D">Animation, 2D/3D</option>
                                <option value="Performance marketing">Performance marketing</option>
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
                    <option value="Consumer B2C, D2C">Consumer B2C, D2C</option>
                    <option value="SaaS">SaaS</option>
                    <option value="B2B">B2B</option>
                    <option value="Fintech">Fintech</option>
                    <option value="Luxury (high basket/low volume)">Luxury (high basket/low volume)</option>
                    <option value="Everything store (low baskets/high volume)">Everything store (low baskets/high volume)</option>
                    <option value="Classified">Classified</option>
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
