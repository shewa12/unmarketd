@extends('admin.master')

@section('content')
<div class="right_col" role="main">
<div class="container">
	<div class="row joinus">
		<div class="col-lg-3 col-md-3">
			<div class="panel panel-default">
					<div class="panel-body">
				<?php $url= url('storage/app/avatars/');?>
				<?php if(!empty($user->image)):?>
				<div class="form-group">
					<img class="img-thumbnail" src="{{$url.'/'.$user->image}}">
				</div>
				<?php else:?>
				<div class="form-group">
					<img class="img-thumbnail" src="{{url('public/img/avatar.png')}}">
				</div>				
				<?php endif?>
				<div class="">
					<strong><p>Name: {{$user->name}}</p></strong>
					<strong><p>Email: {{$user->email}}</p></strong>
					@if(Auth::user()->is_client===1)
					<strong><p>Company Name: {{$user->company_name}}</p></strong>
					<strong><p>Company Website: {{$user->company_website}}</p></strong>
					@endif
				</div>
				</div>
			</div>
		</div>

		<div class="col-lg-9 col-md-9">
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
			
			<div class="panel-default panel">
				<div class="panel-heading">
					Update Account

				</div>
				<div class="panel-body">
					<form class="form-horizontal form col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3" method="post" action="{{route('updateAccount')}}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Image</label>
							<span>(current img: {{$user->image}})</span>
							<input type="file" class="form-control" name="image"/>
							<input type="hidden" name="img" value="{{$user->image}}">
							<input type="hidden" name="img_path" value="{{$user->image_path}}">
							
						</div>			

<!--
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label>User Name</label>
							<input class="form-control{{ $errors->has('name') ? ' has-error' : '' }}" name="name" value="{{$user->name}}"/>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif							
						</div>			

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label>Email</label>
							<input type="email" class="form-control" name="email" value="{{$user->email}}"/>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
						</div>	
-->		

			
						<div class="form-group">
							<button type="submit" class="btn btn-default" name="submit">Update Image</button>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>	
</div>	
@endsection


