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
		<h3>Active Request</h3>
		<div class="panel-default panel">
			<div class="panel-body">
				<div class="table-responsive">
					
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
								<th>Contact Person</th>
								<th>Workload per Hour</th>
								<th>No of Freelancer</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Description</th>
								<th>Skills</th>
								<th>Attachment</th>
								<th>Close Project</th>
								
							</tr>
						</thead>

						<tbody>
							<?php $i=1;?>
							@forelse($requests as $value)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$value->created_at}}</td>
				                <td>{{$value->name}}</td>
				                <td>{{$value->email}}</td>
				                <td>{{$value->company_name}}</td>
				                <td>{{$value->company_website}}</td>							
								<td>{{$value->title}}</td>
								<td>{{$value->contact_person}}</td>
								<td>{{$value->workload_hour}}</td>
								<td>{{$value->noof_freelaner}}</td>
								<td>{{$value->start_date}}</td>
								<td>{{$value->end_date}}</td>
								<td>{!!$value->description!!}</td>
								<td>{{$value->skills}}</td>
								<td>
								<a href="{{url('storage/app/req-attach/')}}/{{$value->attachment}}">{{$value->attachment}}</a>
								</td>
								<td>
									<button class="btn-warning btn btn-sm" onClick="markasClose('<?php echo $value->id?>')">Mark as close</button>
								</td>	
								<!--
								<td id="dlt"><i id="{{$value->id}}" class=" fas fa-trash-alt delete" style="color:red; font-size:18px;cursor:pointer;"></i></td>
							-->
							</tr>
							@empty
							<tr><td>No record found</td></tr>
							@endforelse
						</tbody>
					</table>
					{{ $requests->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
</div>
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

  function markasClose(project_id){

	if(confirm("Do you want to close the project?")){
          $.ajax({
            url : "<?php echo url('/clients/close-project')?>/"+project_id,
            type: "GET",
            dataType: "HTML",
            success: function(data)
            {
              
              	alert("Project successfully closed!");
              	location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        }); 
	} 	
  }
</script>
@endsection