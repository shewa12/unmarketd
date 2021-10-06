@extends('layouts/app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-3 col-md-3">
			<?php $url= url('storage/app/avatars/');?>
			<?php if(!empty($user->image)):?>
			<div class="form-group">
				<img src="{{$url.'/'.$user->image}}">
			</div>
			<?php else:?>
			<div class="form-group">
				<img src="{{$url.'/man.png'}}">
			</div>				
			<?php endif?>
			<div class="detail">
				<strong><p>Name: {{$user->name}}</p></strong>
				<strong><p>Email: {{$user->email}}</p></strong>
				<strong><p>About: {{$user->about}}</p></strong>
			</div>
		</div>

		<div class="col-lg-9 col-md-9">
		@if(Session::has('success'))
		<div class="alert alert-success  alert-dismissible  show" role="alert">
			<h4>{!!Session::get('success')!!}</h4>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>
		@endif
		@if(Session::has('fail'))
		<div class="alert alert-danger  alert-dismissible  show" role="alert">
			<h4>{!!Session::get('fail')!!}</h4>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>			
		</div>	
		@endif	
			
			<div class="panel panel-default">
				<div class="panel-heading">
					Update Account

				</div>
				<div class="panel-body">
					<form class="form-horizontal form col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3" method="post" action="{{route('updateAccount')}}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Image</label>
							<input type="file" class="form-control" name="image"/>
							<input type="hidden" name="img" value="{{$user->image}}">
							<input type="hidden" name="img_path" value="{{$user->image_path}}">
							<input type="hidden" name="password" value="{{$user->password}}">
						</div>			

						<div class="form-group">
							<label>Name</label>
							<input class="form-control" name="name" value="{{$user->name}}"/>
						</div>			

						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" value="{{$user->email}}"/>
						</div>			

						<div class="form-group">
							<label>About</label>
							<input class="form-control" name="about" value="{{$user->about}}"/>
						</div>			
						<div class="form-group">
							<button type="submit" class="btn btn-default" name="submit">Update Account</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
