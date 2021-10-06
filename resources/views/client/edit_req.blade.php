@extends('admin.master')

@section('content')
<div class="right_col" role="main">
<div class="container" style="margin-top:70px">
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
	<div class="row">
		<div class="panel-default panel col-md-10">
			<h3>Create a request</h3>
			<div class="panel-body">

				<form class="form-horizontal" action="{{route('updateReq')}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
                        <input type="hidden" name="id" value="{{$request->id}}">
                        <div class="form-group" name="service">
                            <label for="name" class="col-md-3 control-label">Select Service</label>
                            <div class="col-md-8">
                                <select class="form-control" name="service" required>
                                    <option value="{{$request->service}}">{{$request->service}}</option>
                                    <option value="TURN KEY DIGITAL MARKETING">TURN KEY DIGITAL MARKETING</option>
                                    <option value="ACCESS TOP 3% DIGITAL EXPERTS FOR MY TEAM">ACCESS TOP 3% DIGITAL EXPERTS FOR MY TEAM</option>
                                    <option value="HIRE DIGITAL MARKETERS AND DATA IN-HOUSE">HIRE DIGITAL MARKETERS AND DATA IN-HOUSE</option>
                                    <option value="DIGITAL AUDIT AND CONSULTING">DIGITAL AUDIT AND CONSULTING</option>
                                    <option value="ONE-OFF PACKAGES - DIGITAL AUDIT OR INTERVIEW">ONE-OFF PACKAGES - DIGITAL AUDIT OR INTERVIEW</option>
                                </select>
                            </div>
                        </div>                        

                        <div class="form-group" name="service">
                            <label for="name" class="col-md-3 control-label"> Required Skills</label>
                            <div class="col-md-8">
                           <select id="select-state" name="skills[]" multiple class="demo-default" style="" placeholder="{{$request->skills}}" required>
                                
                                <option value="{{$request->skills}}">{{$request->skills}}</option>
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
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label">Title</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="title" placeholder="title" value="{{ $request->title }}" autofocus required>
 
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>							

                        <div class="form-group{{ $errors->has('contact_person') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label">Contact person</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="contact_person" placeholder="contact person" value="{{$request->contact_person}}" autofocus required>

                                @if ($errors->has('contact_person'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_person') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>						

                        <div class="form-group{{ $errors->has('workload_hour') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label">Workload per week</label>

                            <div class="col-md-8">
                                <input id="name" type="number" class="form-control" name="workload_hour"  placeholder="hours/week" value="{{$request->workload_hour }}" autofocus required>

                                @if ($errors->has('workload_hour'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('workload_hour') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>						

                        <div class="form-group{{ $errors->has('noof_freelancer') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label">No of freelancer</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="noof_freelancer"  placeholder="10" value="{{ $request->noof_freelancer}}" autofocus required>

                                @if ($errors->has('noof_freelancer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('noof_freelancer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>	
                        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label">Estimated time line</label>

                            <div class="col-md-4">

                                <input id="name" type="" class="form-control" name="start_date" onfocus="(this.type='date')" placeholder="start date" value="{{$request->start_date}}" required>

                                @if ($errors->has('start_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>                            <div class="col-md-4">
                                <input id="name" type="" class="form-control" name="end_date"  placeholder="end date" onfocus= "(this.type='date')" value="{{ $request->end_date}}" required>

                                @if ($errors->has('start_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>						

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label">Description</label>

                            <div class="col-md-8">
                                <textarea id="name" type="text" class="form-control" name="description" value="{{ $request->description}}" autofocus >{{ $request->description}}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        

                        <div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label">Attachment (max file size: 20mb)</label>

                            <div class="col-md-8">
                                Existing attahcment: <a href="{{url('storage/app/req-attach')}}/{{$request->attachment}}">{{$request->attachment}}</a>
                                <input id="name" type="file" class="form-control" name="attachment" autofocus/>

                                @if ($errors->has('attachment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attachment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>	

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    Update Request
                                </button>
                            </div>
                        </div>
				</form>
			</div>
		</div>
	</div>
</div>
</div><!--right col end-->
@endsection

@section('js')
<script type="text/javascript">
    $('#select-state').selectize({
        maxItems: 10
    }); 
</script>
@endsection