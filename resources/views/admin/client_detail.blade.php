@extends('admin.master')

@section('content')
<div class="right_col" role="main">
<!--error-->
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
<!--error end-->
  <div class="container">
    <div class="row">
          <!--basic info-->
      <div class="col-md-5">
          <div class="panel-default panel">
              <div class="panel-heading">Basic Information</div>

              <div class="panel-body">
                <?php $url= url('storage/app/avatars/');?>
                <?php if(!empty($basic->image)):?>
                <div class="form-group">
                  <img class="image-thumbnail" src="{{$url.'/'.$basic->image}}" style="width:100px;height:100px;border-radius:50%">
                </div>
                <?php else:?>
                <div class="form-group">
                  <img class="image-thumbnail" src="{{url('/public/img/avatar.png')}}"style="width:100px;height:100px;border-radius:50%">
                </div>        
                <?php endif?>
                <div class="form-group">
                  <label>Email:</label>
                  {{$basic->email}}
                </div>                  

                <div class="form-group">
                  <label>Fullname:</label>
                  {{$basic->name}}
                </div>              

                <div class="form-group">
                  <label>Company Name: </label>
                  {{$basic->company_name}}
                </div>      
        
                <div class="form-group">
                    <label>Comapny Website: </label>
                    {{$basic->company_website}}
                </div>               

              </div>
          </div>
      </div>  <!--col-md-5 end-->
<!--servie detail-->
      <div class="col-md-7">
          <div class="panel-default panel">
              <div class="panel-heading">Production/Service Detail</div>
              <div class="panel-body">
                    <?php 
                      if(!empty($prod_service)){
                          $hint =$prod_service->what_service; 
                      }
                      

                    ?>
                    @if(!empty($prod_service))
                        
                      @if($hint==="turnkey")
                          @include('auth.turnkey')

                      @elseif($hint==='top3')
                          @include('auth.top3')                    
                      @elseif($hint==='digital_marketer')
                          @include('auth.digital_marketer')                    
                      @elseif($hint==='digital_audit')
                          @include('auth.top3')                   
                      @elseif($hint==='onoff')
                          @include('auth.onoff_package')

                      @else
                        <strong>No product/service found</strong>
                      @endif
                    @else
                      Not found
                    @endif

              </div>
          </div>
      </div>
<!--servie detail end-->

    </div>
  </div>

</div><!--main  col div end-->

@endsection

@section('js')

	<script type="text/javascript">
		function edit(id, name, email,address,phoneNumber,age,region,zipCode,recognitionSign,password){
      $('[name="id"]').val(id);
      $('[name="name"]').val(name);
      $('[name="email"]').val(email);
      $('[name="password"]').val(password);

      /*
      $('[name="address"]').val(address);
      $('[name="phoneNumber"]').val(phoneNumber);
      $('[name="age"]').val(age);
      $('[name="region"]').val(region);
      $('[name="zipCode"]').val(zipCode);
      $('[name="recognitionSign"]').val(recognitionSign);
      $('[name="password"]').val(password);
      */
		}

//deleting 
 
	</script>
  <script type="text/javascript">
      function deleteUser(id){
       

        if(confirm('Are you sure delete this data?'))
        {
          // ajax delete data from database
            $.ajax({

              url : "<?php echo url('delete-app-user')?>"+"/"+id,            
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
 //update role
  function updateRole(id, role){
            if(confirm("Do you want to change status?")){
            $.ajax({

              url : "<?php echo url('/update-role')?>"+"/" +id+"/"+role,            
              type: "GET",
              dataType: "HTML",
              success: function(data)
              {

                alert("Status updated!");
                
                location.reload();
              },
              error:function(){
                  alert("Something went wrong pls try again!");
              }

            });
        }    
  }      
  </script>
@endsection