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
		<h3>Reports</h3>
		<div class="panel-default panel">
			<div class="panel-body">
				<div class="table-responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Sl No.</th>
				        <th>Created at</th>
                <th>Freelancer Name</th>
							  <th>Freelancer Email</th>
								<th>Project Title</th>
								<th>Attachement</th>
								<th>Comment</th>

								
							</tr>
						</thead>

						<tbody>
							<?php $i=1;?>
							@forelse($reports as $value)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$value->created_at}}</td>
                <td>{{$value->name}}</td>
							  <td>{{$value->email}}</td>
								<td>{{$value->title}}</td>
								<td>
									@if(!empty($value->attachment))
									<a href="{{url('storage/app/reports')}}/{{$value->attachment}}">{{$value->attachment}}</a>
									@else
									File not found
									@endif
								</td>
								<td>{!!$value->comment!!}</td>

								<!--
								<td id="dlt"><i id="{{$value->id}}" class=" fas fa-trash-alt delete" style="color:red; font-size:18px;cursor:pointer;"></i></td>
							-->
							</tr>
							@empty
							<tr><td>No record found</td></tr>
							@endforelse
						</tbody>
					</table>
					{{ $reports->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<!-- Modal for add -->
<div class="modal fade" id="addform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Contract</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('addContract')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

            <div class="form-group">
            	<label>Select Client</label>

            </div>
          	<div class="form-group">
	            <label for="name">Title</label>
	            <input class="form-control" name="title" id="name" required></input>
          	</div>  

          	<div class="form-group">
            <label for="image">Add Attachment</label>
            <input type="file" class="form-control" name="attachment" id="image" required></input>
          	</div>
        

          	<div class="form-group">
	            <label for="age">Comment</label>
	            <textarea class="form-control" name="comment" ></textarea>
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