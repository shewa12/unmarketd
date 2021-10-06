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
					<form class="form-horizontal form col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3" method="post" action="" enctype="multipart/form-data">
						{{ csrf_field() }}
                        
                        <div class="form-group">
                        	<label>What exactly you would like to work on (text)</label>
                            <input id="name" type="text" class="form-control" name="exact_work" value="" autofocus>
                        </div>                        
                        <div class="form-group">
                        	<label>What is the most impressive work you have done </label>
                            <input id="name" type="text" class="form-control" name="impressive_work" value="" autofocus>
                        </div>                       
                        <div class="form-group">
                        	<label>Projects worked on</label>
                            <textarea class="form-control" name="worked_on" value=""></textarea>
                        </div>                        
                        
                        <div class="form-group">
                        	<label>Linkedin link </label>
                            <input id="name" type="url" class="form-control" name="linkedin" value="" autofocus>
                        </div>                                                
                        <div class="form-group">
                        	<label>Other website link</label>
                            <input id="name" type="url" class="form-control" name="other_site" value=""autofocus>
                        </div>                        
                        <div class="form-group">
                        	<label>ABout</label>
                            <textarea id="name" type="text" class="form-control" name="about" value=""  autofocus></textarea>
                        </div>                        
                        <div class="form-group">
                        	<label>CV</label>
                            <input id="name" type="file" class="form-control" name="cv" value=""autofocus>
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
