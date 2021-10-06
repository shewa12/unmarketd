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
            <button class="btn-default btn btn-sm" data-toggle="modal" data-target="#addform"><i class="fas fa-plus-circle"></i>User</button>
-->
            <h3>All Freelancers</h3>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sl No:</th>
                    <th>Image</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Skills</th>
                    <th>Industry</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Detail</th>
                    
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                	<?php 
                		$i=1;
                	?>

                @forelse($users as $value)
                	<tr>
                		<td>{{$i++}}</td>
                    <td>
                      @if(!empty($value->image))
                      <img src="{{url('storage/app/avatars/')}}/{{$value->image}}" style="width:60px;height:60px;border-radius:30px;">
                      @else
                      <img class="img-thumbnail img-rounded" src="{{url('/public/img/avatar.png')}}"style="width:60px;height:60px;border-radius:30px;">
                      @endif
                    </td>                    
                		<td>{{$value->surname}}</td>
                		<td>{{$value->email}}</td>
                		<td>{{$value->mobile}}</td>
                		<td>{{$value->skills}}</td>
                		<td>{{$value->industry}}</td>
                		<td>{{$value->country}}</td>
                		<td>{{$value->city}}</td>
                    <td><a href="{{url('freelancer-detail/')}}/{{$value->id}}" class="btn btn-default">View Detail</a></td>
                		
                         
                        <?php 
                        /*
                        echo 
                        '
                        <i class="fas fa-edit" onClick ="edit('.$value->id.',\''.$value->name.'\', \''.$value->email.'\',\''.$value->address.'\', \''.$value->phoneNumber.'\',\''.$value->age.'\',\''.$value->region.'\',\''.$value->zipCode.'\',\''.$value->recognitionSign.'\',\''.$value->password.'\')" data-toggle="modal" data-target="#editform"
                        aria-hidden="true" style="color:green; font-size:18px;cursor:pointer;"></i>

                        ';
                        */
                        ?>
                        
                        <td id="dlt"><i id="{{$value->id}}" class=" fas fa-trash-alt delete" style="color:red; font-size:18px;cursor:pointer;"></i></td>                		
                	</tr>
                @empty
                	<tr>
                		<td>No record found</td>
                	</tr>
                @endforelse
                </tbody>
            </table>  
            {{$users->links()}}  
        </div>      

<!-- Modal for add -->
<div class="modal fade" id="addform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add work log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('saveUser')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
          <div class="form-group">
            <label for="image">Add Image</label>
            <input type="file" class="form-control" name="image" id="image" required></input>
          </div>
          <div class="form-group">
            <label for="name">User Name</label>
            <input class="form-control" name="name" id="name" required></input>
          </div>          

          <div class="form-group">
            <label for="age">Age</label>
            <input class="form-control" name="age" id="age"></input>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" name="email" id="email" required></input>
          </div>             

          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" name="password" id="password" required></input>
          </div>           
          <div class="form-group">
            <label for="Address">Address</label>
            <input class="form-control" name="address" id="Address"></input>
          </div>           
          <div class="form-group">
            <label for="phoneNumber">Phone Number</label>
            <input class="form-control" name="phoneNumber" id="phoneNumber"></input>
          </div>           

           <div class="form-group">
            <label for="region">Region Number</label>
            <input class="form-control" name="region" id="region"></input>
          </div>           

           <div class="form-group">
            <label for="zipCode">Zip Code</label>
            <input class="form-control" name="zipCode" id="zipCode"></input>
          </div>              

          <div class="form-group">
            <label for="recognitionSign">Recognition Sign</label>
            <input class="form-control" name="recognitionSign" id="recognitionSign"></input>
          </div>           

           <div class="form-group">
            <label for="about">About </label>
            <textarea id="about" id="about" class="form-control" name="about"></textarea>
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
        <h5 class="modal-title" id="exampleModalLabel">Update work log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('updateUser')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
   

          <input type="hidden" name="id" value="">
          <div class="form-group">
            <label for="image">Add Image</label>
            <input type="file" class="form-control" name="image" id="image"></input>
          </div>
          <div class="form-group">
            <label for="name">User Name</label>
            <input class="form-control" name="name" id="name" required></input>
          </div>          

          <div class="form-group">
            <label for="age">Age</label>
            <input class="form-control" name="age" id="age"></input>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" name="email" id="email" required></input>
          </div>             

          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" name="password" id="password" required></input>
          </div>           
          <div class="form-group">
            <label for="Address">Address</label>
            <input class="form-control" name="address" id="Address"></input>
          </div>           
          <div class="form-group">
            <label for="phoneNumber">Phone Number</label>
            <input class="form-control" name="phoneNumber" id="phoneNumber"></input>
          </div>           

           <div class="form-group">
            <label for="region">Region Number</label>
            <input class="form-control" name="region" id="region"></input>
          </div>           

           <div class="form-group">
            <label for="zipCode">Zip Code</label>
            <input class="form-control" name="zipCode" id="zipCode"></input>
          </div>              

          <div class="form-group">
            <label for="recognitionSign">Recognition Sign</label>
            <input class="form-control" name="recognitionSign" id="recognitionSign"></input>
          </div>           

           <div class="form-group">
            <label for="about">About </label>
            <textarea id="about" id="about" class="form-control" name="about"></textarea>
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
		function edit(id, name, email,address,phoneNumber,age,region,zipCode,recognitionSign,password){
      $('[name="id"]').val(id);
      $('[name="name"]').val(name);
      $('[name="email"]').val(email);
      $('[name="address"]').val(address);
      $('[name="phoneNumber"]').val(phoneNumber);
      $('[name="age"]').val(age);
      $('[name="region"]').val(region);
      $('[name="zipCode"]').val(zipCode);
      $('[name="recognitionSign"]').val(recognitionSign);
      $('[name="password"]').val(password);
		}

//deleting 
 
	</script>
  <script type="text/javascript">
  $(document.body).on('click', '.delete' ,function(e) {

    if(confirm("Do you want to delete this data?")){
    const id = $(this).attr('id');
    
    var whichtr = $(this).closest("tr");   
//deleting 

        // ajax delete data from database
          $.ajax({
            url : "<?php echo url('/delete-freelancer')?>/"+id,
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