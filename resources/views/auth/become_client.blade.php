@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Become a Client</div>
                <div class="panel-body">
            <!--error row--> 
                  <div class="row">
                    <div class="error" style="padding:10">
                      <!--validation error-->
                      @forelse ($errors->all() as $message)
                          <li style="color:#e74242; margin-left:20px;"><strong>{{$message}}</strong></li>
                      @empty
                      @endforelse
                      <!--validation error end-->
                      @if(Session::has('success'))
                      <div class="alert alert-success  alert-dismissible  show" role="alert">
                        <strong>{!!Session::get('success')!!}</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      @endif
                      @if(Session::has('fail'))
                      <div class="alert alert-danger  alert-dismissible  show" role="alert">
                        <strong>{!!Session::get('fail')!!}</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>     
                      </div>  
                      @endif        
                    </div>
                    <!--error end-->
                  </div>                 
            <!--error row end-->      
                    <form class="form" role="form" method="POST" action="{{route('clientReg')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div id="step1"> 
                    <h2>What services you would like to have<span class="star">*</span></h2>   
                        <div class="radio">
                          <label>

                            <input type="radio" name="what_service" id="optionsRadios1" value="turnkey">
                            TURN KEY DIGITAL MARKETING

                          </label>                          
                        </div>                        

                        <div class="radio">
                          <label>

                            <input type="radio" name="what_service" id="optionsRadios1" value="top3" >
                            ACCESS TOP 3% DIGITAL EXPERTS FOR MY TEAM

                          </label>                          
                        </div>                        

                        <div class="radio">
                          <label>

                            <input type="radio" name="what_service" id="optionsRadios1" value="digital_marketer">
                            HIRE DIGITAL MARKETERS AND DATA IN-HOUSE

                          </label>                          
                        </div>                        

                        <div class="radio">
                          <label>

                            <input type="radio" name="what_service" id="optionsRadios1" value="digital_audit">
                            DIGITAL AUDIT AND CONSULTING

                          </label>                          
                        </div>                        

                        <div class="radio">
                          <label>

                            <input type="radio" name="what_service" id="optionsRadios1" value="onoff">
                            ONE-OFF PACKAGES - DIGITAL AUDIT OR INTERVIEW

                          </label>                          
                        </div>

                    </div>
                    
                    <!--turn key start-->
                    <div class="turnkey-area"></div>
                    <!--turn key end--> 

                    <div id="result"></div>
                    <div class="" style="border-top:1px solid #e3e3e3">

                        <button style="margin-top:10px" class="btn-default btn btn-lg" id="next">Submit</button>
                           
                    </div>
                    </form>
 
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function(){
    $("#next").attr("disabled", true);
    $("#back").attr('disabled',true);

    $('[name="what_service"]').click(function(){
        $("#next").attr('disabled',false);
        //var getData= $("#ans option:selected").val();
        var hint= $('[name="what_service"]:checked').val();
            $.ajax({

              url : "<?php echo url('showform')?>"+"/"+hint,            
              type: "GET",
              dataType: "HTML",
              success: function(data)
              {
                    $("#result").html(data);
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  console.log('Error deleting data');
              }
          });
    });
});

function goNext(hideDiv,turnkey){
    var turn= "hello";
    var hide= "#"+hideDiv;
    $(hide).hide();
}
</script>

@endsection

