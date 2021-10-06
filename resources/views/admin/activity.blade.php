@extends('admin.master')

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

        <div class="responsive">
            <button class="btn-primary btn btn-sm" data-toggle="modal" data-target="#addform" >Add Activity</button>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sl No:</th>

                    <th>Client Name</th>
                    <th>Client Email</th>
                    <th>Project Title</th>
                    <th>Money Earnt</th>
                    <th>Number of Hour Per Week</th>
                    <th>Further Info</th>
                    <th>Assigned Freelancers</th>

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
                      <a href="{{url('/assgined-freelancers')}}/{{$value->project_id}}" class="btn btn-sm btn-primary">Assigned Freelancers</a>
                    </td>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('saveActivity')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
          <div class="form-group">
            <label for="country">Select Freelancer</label>
            <select id="select-state" class="form-control" name="user_id[]" placeholder="Select multiple freelancers" multiple required>
              <option value="">Select</option>
              @forelse($freelancers as $value)
              <option value="{{$value->id}}">{{$value->surname}}
              </option>
              @empty
              <option>freelancer not found</option>
              @endforelse
            </select>
          </div>

          <div class="form-group">
            <label for="name">Select Client</label>
            <select class="form-control" id="select" name="client_id" required>
                <option>Select</option>
                @forelse($clients as $value)
                <option value="{{$value->id}}">{{$value->name}}</option>
                @empty
                <option>No client found</option>
                @endforelse
            </select>
          </div>            

          <div class="form-group">
            <label for="name">Select Active Project</label>
            <select class="form-control" id="projects" name="project_id" required>
              
                  <option>Select client first</option>
             
                
            </select>
          </div>  

          <div class="form-group">
            <label for="name">Earning money (USD) per hour</label>
            <input type="number" class="form-control" name="earnt_money" id="" required></input>
          </div>           

          <div class="form-group">
            <label for="name">Number of Hour Per Week</label>
            <input type="number" class="form-control" name="pending_payout" id="pending_payout" required></input>
          </div>            

          <div class="form-group">
            <label for="name">Further Information</label>
            <textarea class="form-control" name="further_info" id="pending_payout"></textarea>
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

<!--edit form--> 

<div class="modal fade" id="editform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('updateActivity')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
              
          <input type="hidden" name="id">

          <div class="form-group">

            <label for="country">Country</label>
            <input class="form-control" name="country" required></input>
          </div>

          <div class="form-group">

            <label for="name">City</label>
            <input class="form-control" name="city" id="name" required></input>
          </div>   

          <div class="form-group">
            <label for="name">Address</label>
            <input class="form-control" name="address" id="name" required></input>
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
<!--edit form end--> 
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
//get project for a client
$('#select').on('change', function() {
  var client_id= this.value;
            $.ajax({

              url : "<?php echo url('getprojects-asper-client')?>"+'/'+client_id,            
              type: "GET",
              dataType: "HTML",
              success: function(data)
              {
               
               $("#projects").html(data);   
               
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  console.log('Error:project could not fetch');
              }
          });  
});
//get project for a client end

 //selctize
    $('#select-state').selectize({
        maxItems: 10
    });       
  </script>
@endsection