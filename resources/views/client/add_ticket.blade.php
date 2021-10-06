@extends('admin.master')

@section('content')
<div class="right_col" role="main">
<div class="container" style="margin-top:70px">
	<div class="row">
		<div class="panel-default panel">
			<div class="panel-body">

				<form class="form" action="{{route('createTick')}}" method="post">
					{{csrf_field()}}
					<div class="form-group">
						<label>Title</label>
						<input class="form-control" name="title" required></input>
					</div>					

					<div class="form-group">
						<label>Support Description</label>
						<textarea  class="form-control tinymce" name="description"></textarea>
					</div>

					<div class="form-group">
						<button type="submit" class="btn-primary btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div><!--right col end-->
@endsection

@section('js')

@endsection