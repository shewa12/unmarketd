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
        
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-heading">Report Detail</div>
              <div class="panel-body">
                <div class="reponsive">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Attachment</th>
                        <th>Comment</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($reports as $value)
                      <tr>
                        <td>{{$value->title}}</td>
                        <td><a href="{{url('storage/app/reports/'.$value->attachment)}}">{{$value->attachment}}</a></td>
                        <td>{{$value->comment}}</td>
                      </tr>
                      @empty
                        <tr>
                          <td>No report found</td>
                        </tr>
                      @endforelse  
                    </tbody>
                  </table>
                  {{$reports->links()}}
                </div>
                     

              </div>
          </div>
      </div>
    </div>
  </div>
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