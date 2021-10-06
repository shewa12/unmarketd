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
<!--
            <button class="btn-default btn btn-sm" data-toggle="modal" data-target="#addform" style="margin:0px;">add</button>
-->
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sl No:</th>
                    <th>Image</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Skill</th>
                    <th>Industry</th>
                    <th>Seniority</th>
                    <th>Buying Price</th>
                    <th>Selling Price</th>
                    <th>Project Complexity</th>
                    <th>Hours</th>
                    <th>Technical</th>
                    <th>Manager</th>

                </tr>
                </thead>
                <tbody>
                  <?php 
                    $i=1;
                  ?>
                  @if(count($result)>0)
                  @forelse ($result[0] as $value)
                  <tr>
                    <td>{{$i++}}</td>
                    
                    <td>
                      @if(empty($value->image))
                        <img class="thumbnail" src="{{url('/public/img/avatar.png')}}" style="width:40px; height:40px; border-radius:50%;">
                      @else
                        <img class="" src="{{url('/storage/app/avatars/')}}/{{$value->image}}" style="width:40px; height:40px; border-radius:50%;">
                      @endif                    
                    </td>
                    <td>{{$value->surname}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->skills}}</td>
                    <td>{{$value->industry}}</td>
                    <td>{{$value->seniority}}</td>
                    <td>{{$value->buying_price}}</td>
                    <td>{{$value->selling_price}}</td>
                    <td>{{$value->project_complexity}}</td>
                    <td>{{$value->hours}}</td>
                    <td>{{$value->technical}}</td>
                    <td>{{$value->manager}}</td>
                  </tr>
                  @empty
                  <tr><td>No record found</td></tr>
                  @endforelse
                  @else
                  <tr><td>No record found</td></tr>
                  @endif
                </tbody>
            </table>  
            
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
            <select class="form-control" name="user_id">
              <option value="">Select</option>

            </select>
          </div>
          <div class="form-group">
            <label for="name">Select Active Project</label>
            <select class="form-control" name="active_project">
                <option value="">Select</option>
                <option value="Web Design">Web Design</option>
                <option value="Web Development">Web Development</option>
                <option value="Graphics Design">Graphics Design</option>
            </select>
          </div>  

          <div class="form-group">
            <label for="name">Earn Money</label>
            <input type="number" class="form-control" name="earnt_money" id="" required></input>
          </div>           

          <div class="form-group">
            <label for="name">Pending Payout</label>
            <input type="number" class="form-control" name="pending_payout" id="pending_payout" required></input>
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
  </script>
@endsection