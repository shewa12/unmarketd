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

  <div class="container">
    <div class="row">
          <h3 style="padding-left:10px">Assigned Freelancers</h3>
          @forelse($freelancers as $value)
          <div class="col-sm-6 col-md-3">
            <div class="panel-default panel">
              <div class="panel-body">
                @if(empty($value->image))
                  <img class="image-responsive" src="{{url('/public/img/avatar.png')}}"  alt="{{$value->surname}}"style="width:100%; height:160px;">
                @else
                  <img class="image-responsive" src="{{url('/storage/app/avatars/')}}/{{$value->image}}" style="width:100%; height:160px;" alt="{{$value->surname}}">
                @endif 
             
              </div>
              <div class="panel-footer">
                  <a href="{{url('/freelancer-detail')}}/{{$value->userId}}"><h4 align="center" class="text-capitalize">{{$value->surname}}</h4></a>
              </div>
            </div>
            
          </div>
          
          @empty
            No freelancer found
          @endforelse

    </div>
  </div>

	</div><!--main  col div end-->
@endsection

@section('js')

	<script type="text/javascript">
		function edit(id, name){
      $('[name="id"]').val(id);
      $('[name="name"]').val(name);

		}

//deleting 
 
	</script>
  <script type="text/javascript">

      function deleteUser(id){
        
       var url ="http://newgen-bd.com/dashboard/delete-feature";

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