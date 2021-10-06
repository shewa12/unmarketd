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

        <div class="table-responsive">
            <button class="btn-default btn btn-sm" data-toggle="modal" data-target="#addform" style="margin:0px;">Add</button>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sl No:</th>
                    <th>Freelancer Image</th>
                    <th>Freelancer Surname</th>
                    <th>Project Complexity</th>
                    <th>KPI</th>
                    <th>Seniority</th>
                    <th>Interview Text</th>
                    <th>Skill Deepth</th>
                    <th>Selling Price</th>
                    <th>Buying Price</th>
                    <th>Edit</th>

                </tr>
                </thead>
                <tbody>
                  <?php $i=1;?>
                  @forelse($performances as $value)
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
                    <td class="col-md-2">
                      <div class="progress">
                        <div class="progress-bar-warning progress-bar-striped active" role="progressbar"
                        aria-valuenow="{{$value->project_complxity}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$value->project_complxity}}%">
                          {{$value->project_complxity}}%
                        </div>
                      </div>                       
                      
                    </td>
                    <td class="col-md-2">
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                        aria-valuenow="{{$value->kpi}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$value->kpi}}%">
                          {{$value->kpi}}%
                        </div>
                      </div>                    </td>
                    <td>{{$value->seniority}}</td>
                    <td>{!!$value->interview_text!!}</td>
                    <td>{{$value->skill_deepth}}</td>
                    <td>{{$value->buying_price}}</td>
                    <td>{{$value->selling_price}}</td>                   
                    <td>
                      <button data-toggle="modal" data-target="#editform" onclick="editPerformence('<?php echo $value->userId?>','<?php echo $value->surname?>','<?php echo $value->id?>','<?php echo $value->project_complxity?>','<?php echo $value->kpi?>','<?php echo $value->seniority?>','<?php echo $value->interview_text?>','<?php echo $value->skill_deepth?>','<?php echo $value->buying_price?>','<?php echo $value->selling_price?>')" class="btn-warning btn"> Edit</button>
                    </td>                   
                  </tr>
                  @empty
                  <tr><td>No record found</td></tr>
                  @endforelse
                </tbody>
            </table>  
            {{$performances->links()}}  
        </div>      

<!-- Modal for add -->
<div class="modal fade" id="addform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Performance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('savePerformance')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
          <div class="form-group">
            <label>Select Freelancer</label>
            <select class="form-control" name="user_id">
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
            <label for="name">Project Complexity</label>
            <input type="number" class="form-control" name="project_complxity" id="name" required></input>
          </div>          

          <div class="form-group">
            <label for="name">KPI</label>
            <input type="number" class="form-control" name="kpi" id="name" required></input>
          </div>          

          <div class="form-group">
            <label for="name">Seniority</label>
            <select class="form-control" name="seniority" id="name" required>
                <option value="">Select</option>
                <option value="Large">Large</option>
                <option value="Small">Small</option>
            </select>
          </div>           
        
          <div class="form-group">
              <label>Interview Text</label>
              <textarea class="form-control" name="interview_text" ></textarea>
          </div>

          <div class="form-group">
              <label>Skill Deepth</label>
              <select class="form-control" name="skill_deepth" required>
                  <option value="">Select</option>
                  <option value="Expert">Expert</option>
                  <option value="Intermadiate">Intermadiate</option>
              </select>
          </div>
          <div class="form-group">
            <label for="name">Buying Price</label>
            <input type="number" class="form-control" name="buying_price" id="" required></input>
          </div>            

          <div class="form-group">
            <label for="name">Selling Price</label>
            <input type="number" class="form-control" name="selling_price" id="" required></input>
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
        <h5 class="modal-title" id="exampleModalLabel">Update Performance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('updatePerformance')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
          <input type="hidden" name="id">
          <div class="form-group">
            <label>Select Freelancer</label>
            <select class="form-control" name="user_id">
              <option value="" id="selectedUser">Select</option>
              @forelse($freelancers as $value)
              <option value="{{$value->id}}">{{$value->surname}}
              </option>
              @empty
              <option>freelancer not found</option>
              @endforelse
            </select>
          </div>

          <div class="form-group">
            <label for="name">Project Complexity</label>
            <input type="number" class="form-control" name="project_complxity" id="name" required></input>
          </div>          

          <div class="form-group">
            <label for="name">KPI</label>
            <input type="number" class="form-control" name="kpi" id="name" required></input>
          </div>          

          <div class="form-group">
            <label for="name">Seniority</label>
            <select class="form-control" name="seniority" id="name" required>
                <option value="" id="selectedSeniority"></option>
                <option value="Large">Large</option>
                <option value="Small">Small</option>
            </select>
          </div>           
        
          <div class="form-group">
              <label>Interview Text</label>
              <textarea class="form-control" name="interview_text" id="interview_text"></textarea>
          </div>

          <div class="form-group">
              <label>Skill Deepth</label>
              <select class="form-control" name="skill_deepth" required>
                  <option value="" id="selectedDeepth"></option>
                  <option value="Expert">Expert</option>
                  <option value="Intermadiate">Intermadiate</option>
              </select>
          </div>
          <div class="form-group">
            <label for="name">Buying Price</label>
            <input type="number" class="form-control" name="buying_price" id="" required></input>
          </div>            

          <div class="form-group">
            <label for="name">Selling Price</label>
            <input type="number" class="form-control" name="selling_price" id="" required></input>
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

		function editPerformence(userId,surname,id,project_complxity,kpi,seniority,interview_text,skill_deepth,buying_price,selling_price){

      $('[name="id"]').val(id);
      $('#selectedUser').val(userId);
      $('#selectedUser').html(surname);
      $('[name="project_complxity"]').val(project_complxity);
      $('[name="kpi"]').val(kpi);
      $('#selectedSeniority').val(seniority);
      $('#selectedSeniority').html(seniority);
      tinymce.get('interview_text').setContent(interview_text);
      $('#selectedDeepth').val(skill_deepth);
      $('#selectedDeepth').html(skill_deepth);
      $('[name="buying_price"]').val(buying_price);
      $('[name="selling_price"]').val(selling_price);
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