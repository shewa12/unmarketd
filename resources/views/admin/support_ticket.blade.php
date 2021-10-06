@extends('admin.master')

@section('content')
<div class="right_col" role="main">
<div class="container" style="margin-top:70px">
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
	<div class="row">
		<h3>Support Tickets</h3>
		<div class="panel-default panel">
			<div class="panel-body">
				<div class="responsive">
					@if(Auth::user()->is_client===1)
					<a href="{{route('addTick')}}" class="btn-primary btn">Add Ticket</a>
					@endif
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Sl No.</th>
                <th>Created at</th>
                <th>Name</th>
                <th>Company Email</th>
                <th>Company Name</th>
								<th>Company Website</th>
								<th>Title</th>
								<th>Descriptino</th>
								<th>Reply</th>
								<th>Delete</th>
								@if(Auth::user()->is_admin===1)
								<th>Reply now</th>
								@endif
							</tr>
						</thead>

						<tbody>
							<?php $i=1;?>
							@forelse($tickets as $value)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$value->created_at}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->company_name}}</td>
                <td>{{$value->company_website}}</td>
								<td>{{$value->title}}</td>
								<td>{!!$value->description!!}</td>
								<td>
									@if(empty($value->reply))
									<button class="btn-warning btn btn-sm">Pending</button>
									@else
									{{$value->reply}}
									@endif
								</td>
								<td id="dlt"><i id="{{$value->id}}" class=" fas fa-trash-alt delete" style="color:red; font-size:18px;cursor:pointer;"></i></td>
								@if(Auth::user()->is_admin===1)
								<td><button onClick="reply('<?php echo $value->id?>','<?php echo $value->description?>')" data-target="#addform" data-toggle="modal" class="btn-sm btn btn-primary">Reply now</button></td>
								@endif								
							</tr>
							@empty
								<tr><td>No record found</td></tr>
							@endforelse	
						</tbody>
					</table>
					{{$tickets->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
</div><!--right col end-->
<!-- Modal for add -->
<div class="modal fade" id="addform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('replyTick')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
          <input type="hidden" name="id" value="">
          <div class="form-group">
            <label for="name">Description</label>
            <p id="desc"></p>
          </div>          

          <div class="form-group">
            <label for="email">Reply now </label>
            <textarea name="reply" class="form-control"></textarea>
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
@endsection

@section('js')
<script type="text/javascript">
  function reply(id, description){
    $('[name="id"]').val(id);
    $("#desc").html(description);
  } 

  $(document.body).on('click', '.delete' ,function(e) {

    if(confirm("Do you want to delete this data?")){
    const id = $(this).attr('id');
    
    var whichtr = $(this).closest("tr");   
//deleting 

        // ajax delete data from database
          $.ajax({
            url : "<?php echo url('/delete-ticket')?>/"+id,
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