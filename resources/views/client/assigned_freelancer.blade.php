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
		<h3>Assigned Freelancers</h3>
		<div class="panel-default panel">
			<div class="panel-body">
				<div class="responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Sl No.</th>
								<th>Created at</th>
								<th>Project Title</th>
								<th>Freelancer Image</th>
                                <th>Name</th>
                                <th>Email</th>
								<th>Skills</th>
                                <th>Skype</th>
                                <th>Mobile</th>
                                <th>Linked in</th>
							</tr>
						</thead>

						<tbody>
							<?php $i=1;?>
							@forelse($freelancers as $value)
							<tr>
								<td>{{$i++}}</td>
                <td>{{$value->assignedDate}}</td>
								<td>{{$value->title}}</td>
                <td>
                      @if(!empty($value->image))
                      <img src="{{url('storage/app/avatars/')}}/{{$value->image}}" style="width:60px;height:60px;border-radius:30px;">
                      @else
                      <img class="img-thumbnail img-rounded" src="{{url('/public/img/avatar.png')}}"style="width:60px;height:60px;border-radius:30px;">
                      @endif
                </td>                 
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
			    <td>{{$value->skills}}</td>
				<td>{{$value->skype}}</td>
				<td>{{$value->mobile}}</td>
				<td>{{$value->linkedin}}</td>
							</tr>
							@empty
								<tr><td>No record found</td></tr>
							@endforelse	
						</tbody>
					</table>
					{{$freelancers->links()}}
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
        <form method="post" action="{{route('saveAppUser')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

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
/*

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
}); */
</script>
@endsection