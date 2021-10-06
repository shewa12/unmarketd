@extends('freelancer.master')

@section('content')
	<div class="right_col" role="main">
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
        <h3>Activies</h3>
        <div class="responsive">
            
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sl No:</th>
                    <th>Client Name</th>
                    <th>Client Email</th>
                    <th>Project Title</th>
                    <th>Earning money (USD) per hour</th>
                    <th>Number of Hour Per Week</th>
                    <th>Further Information</th>
                    <th>Report</th>
                    <th>Add Report</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $i=1;
                  ?>

                  @forelse ($activities as $value)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$value->clientName}}</td>
                    <td>{{$value->clientEmail}}</td>
                    <td>{{$value->title}}</td>
                    <td>{{$value->earnt_money}}</td>
                    <td>{{$value->pending_payout}}</td>
                    <td>{!!$value->further_info!!}</td>
                    <td>
                      <a href="{{url('/view-report')}}/{{$value->projectId}}" class="btn-default btn-sm btn">View Report</a>
                    </td>
                    <td><button onClick="report('<?php echo $value->clientId?>','<?php echo $value->projectId?>')" data-toggle="modal" data-target="#addform" class="btn-primary btn-sm btn">Add Report</button></td>
                  </tr>
                  @empty
                  <tr><td>No record found</td></tr>
                  @endforelse
                </tbody>
            </table>  
            {{$activities->links()}}  
        </div>      

<!-- Modal for add -->
<div class="modal fade" id="addform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('addReport')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="client_id">
              <input type="hidden" name="project_id">
          <div class="form-group">
            <label for="country">Report Title</label>
            <input class="form-control" name="title" required></input>
          </div>
          <div class="form-group">
            <label for="name">Add Attachment (max file size:20mb)</label>
            <input type="file" class="form-control" name="attachment" ></input>
          </div>  

          <div class="form-group">
            <label for="name">Comment</label>
            <textarea class="form-control" name="comment" id="" required></textarea>
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

	</div><!--main  col div end-->
@endsection

@section('js')

	<script type="text/javascript">
		function edit(id, country,city,address){
      $('[name="id"]').val(id);
      $('[name="country"]').val(country);
      $('[name="city"]').val(city);
      $('[name="address"]').val(address);

		}

//deleting 
 
	</script>
  <script type="text/javascript">

      function deleteUser(id){
        
       var url ="http://newgen-bd.com/dashboard/delete-location";

        if(confirm('Are you sure delete this data?'))
        {
          // ajax delete data from database
            $.ajax({

              url : url+'/'+id,            
              type: "GET",
              dataType: "HTML",
              success: function(data)
              {
                  
               $("#dlt").closest("tr").remove();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });

        }
      }

      function report(clientId,projectId){
          $('[name="client_id"]').val(clientId);
          $('[name="project_id"]').val(projectId);
      }
  </script>
@endsection