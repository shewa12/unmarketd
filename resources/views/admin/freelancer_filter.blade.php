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
      <h3>Filter Freelancer</h3>

    <!--skills strt-->
      <div class="col-md-6">

        <form method="post" action="{{route('skillFilter')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

          <div class="form-group">
            <label for="name">Skill wise Filter</label>
            <select id="select-state" placeholder="select multiple skill" class="form-control demo-default" name="skills[]" multiple required>
                
                                <option value="Paid social">Paid social</option>
                                <option value="Paid search">Paid search</option>
                                <option value="SEO">SEO</option>
                                <option value="Mobile app setup - analytics, product marketing">Mobile app setup - analytics, product marketing</option>
                                <option value="Mobile app UA">Mobile app UA</option>
                                <option value="Web analytics">Web analytics</option>
                                <option value="BI and reporting">BI and reporting</option>
                                <option value="UI/UX">UI/UX</option>
                                <option value="CRO">CRO</option>
                                <option value="Graphic design and animation">Graphic design and animation</option>
                                <option value="CRM and retention">CRM and retention</option>
                                <option value="Growth hacking, strategy, and digital transformation">Growth hacking, strategy, and digital transformation</option>
                                <option value="Product launch and product marketing">Product launch and product marketing</option>
                                <option value="Graphic Design">Graphic Design</option>
                                <option value="Animation, 2D/3D">Animation, 2D/3D</option>
                                <option value="Performance marketing">Performance marketing</option>
            </select>
          </div>          

          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>
  <!--skills end-->

  <!--industry-->    
      <div class="col-md-6">
        <form method="post" action="{{route('industryFilter')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

          <div class="form-group">
            <label for="name">Industry wise Filter</label>
            <select id="select-industry"  placeholder="select multiple industry" class="form-control demo-default" name="industry[]" multiple  required>
                
                    <option value="Consumer B2C">Consumer B2C</option>
                    <option value="D2C">D2C</option>
                    <option value="SaaS">SaaS</option>
                    <option value="B2B">B2B</option>
                    <option value="Fintech">Fintech</option>
                    <option value="Luxury (high basket/low volume)">Luxury (high basket/low volume)</option>
                    <option value="Everything store (low baskets/high volume)">Everything store (low baskets/high volume)</option>
                    <option value="Classified">Classified</option>
            </select>
          </div>          

          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>
      <!--industry end-->
<!--seniority start-->  
      <div class="col-md-6">
        <form method="post" action="{{route('seniorityFilter')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

          <div class="form-group">
            <label for="name">Seniority wise Filter</label>
            <select class="form-control" name="seniority" required>
                <option>Select</option>
                <option value="Large">Large</option>
                <option value="Small">Small</option>
            </select>
          </div>          

          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>          
<!--seniority end--> 

<!--buying price start-->
      <div class="col-md-6">
        <form method="post" action="{{route('buyingFilter')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

          <div class="form-group">
            <label for="name">Buying Price wise Filter</label>
            <input class="form-control" name="buying_price" type="number" required></input>
          </div>          

          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>           
<!--buying price end--> 

<!--selling price start-->
      <div class="col-md-6">
        <form method="post" action="{{route('sellingFilter')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

          <div class="form-group">
            <label for="name">Selling Price wise Filter</label>

            <input class="form-control" name="selling_price" type="number" required></input>

          </div>          

          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>          
<!--selling price end-->          
<!--complexity start-->  
      <div class="col-md-6">
        <form method="post" action="{{route('proComFilter')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

          <div class="form-group">
            <label for="name">Project Complexity wise Filter</label>
            <input class="form-control" name="project_complexity" type="number" required></input>
          </div>          

          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>        
<!--complexity end--> 
<!--hours--> 
      <div class="col-md-6">
        <form method="post" action="{{route('hourFilter')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

          <div class="form-group">
            <label for="name">Weekly Hour wise Filter</label>
            <select class="form-control" name="hours" required>
                <option>Select</option>
                <option value="10">10 Hours</option>
                <option value="15">15 Hours</option>
                <option value="30">30 Hours</option>
                <option value="40">40 Hours</option>
            </select>
          </div>          

          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>        
<!--hours end-->   
<!--technical start-->
      <div class="col-md-6">
        <form method="post" action="{{route('technicalFilter')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

          <div class="form-group">
            <label for="name">Technical wise Filter</label>
            <select class="form-control" name="technical" required>
                <option>Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
          </div>          

          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>      
<!--technical end--> 

<!--manager start-->
      <div class="col-md-6">
        <form method="post" action="{{route('managerFilter')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

          <div class="form-group">
            <label for="name">Manager wise Filter</label>
            <select class="form-control" name="manager" required>
                <option>Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
          </div>          

          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>     
<!--manager end-->     
  </div><!--row end-->

</div><!--container end-->
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
        <form method="post" action="" enctype="multipart/form-data">
              {{ csrf_field() }}
          <input type="hidden" name="id">
          <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" name="name" id="name" required></input>
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

    $('#select-state').selectize({
        maxItems: 10
    }); 
    $('#select-industry').selectize({
        maxItems: 5
    });

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