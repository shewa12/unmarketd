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
			<div class="panel panel-default">
				<div class="panel-heading">
					Add Detail Information

				</div>
				<div class="panel-body">
					<form class="form-horizontal form " method="post" action="{{route('updateDetailInfo')}}" enctype="multipart/form-data">
						{{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                        <div class="form-group">
                        	<label>What exactly you would like to work on (text)</label>
                            <input id="name" type="text" class="form-control" name="exact_work" value="" autofocus>
                        </div>                        
                        <div class="form-group">
                        	<label>What is the most impressive work you have done </label>
                            <input id="name" type="text" class="form-control" name="impressive_work" value="" autofocus>
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
                            <input id="name" type="date" class="form-control" name="start_date" value="" autofocus>
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
                           		<option value="3 Months">3 Months</option>
                           		<option value="6 Months">6 Months</option>
                           		<option value="1 Year">1 Year</option>
                           		<option value="3 Year">3 Years</option>
                           	</select>
                        </div>   
                        <div class="form-group">
                        	<label>What do you think are the keys to success when working remotely with a client?</label>
                        	<textarea class="form-control" name="keyof_success"></textarea>
                        </div>                           

                        <div class="form-group">
                        	<label>Technical?</label>
                        	<select class="form-control" name="technical">
                        		<option value="Yes">Yes</option>
                        		<option value="No">No</option>
                        	</select>
                        </div>    

                        <div class="form-group">
                        	<label>CV (max size:20mb)</label>
                            <input id="name" type="file" class="form-control" name="cv" value=""autofocus>
                        </div>                        

                        <div class="form-group">
                        	<label>Manager</label>
                            <select type="text" class="form-control" name="manager" >
                            	<option value="Yes">Yes</option>
                            	<option value="No">No</option>
                            </select>	
                        </div>                        

                        <div class="form-group">
                        	<label>How many projects completed </label>
                           	<input type="number" class="form-control" name="project_completed"></input>	
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
@endsection

@section('js')

@endsection
