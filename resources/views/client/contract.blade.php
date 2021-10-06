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
		<h3>Contracts</h3>
		<div class="panel-default panel">
			<div class="panel-body">
				<div class="responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Sl No.</th>
				        <th>Created at</th>
							
								<th>Title</th>
								<th>Attachement</th>
								<th>Comment</th>

								
							</tr>
						</thead>

						<tbody>
							<?php $i=1;?>
							@forelse($contracts as $value)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$value->created_at}}</td>
							
								<td>{{$value->title}}</td>
								<td>
									@if(!empty($value->attachment))
									<a href="{{url('storage/app/contracts')}}/{{$value->attachment}}">{{$value->attachment}}</a>
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
					{{ $contracts->links()}}
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
</script>
@endsection