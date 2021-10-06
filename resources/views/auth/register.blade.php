@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Profile Image (max size:600kb)</label>

                            <div class="col-md-6">
                                <input id="name" type="file" class="form-control" name="image" value="{{ old('image') }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>          
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Full Name<span class="star">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Surname<span class="star">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address<span class="star">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password<span class="star">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Lengh must be 6 digits" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password<span class="star">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('skipe') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">skype<span class="star">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="skype" value="{{ old('skype') }}" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('skype') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mobile</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        

                        <div class="form-group{{ $errors->has('project_work') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Past Clients Name <span class="star">*</span></label>

                            <div class="col-md-6">
                                <textarea id="password"  class="form-control" name="project_work" value="{{ old('project_work') }}" required>{{ old('project_work') }}</textarea>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('project_work') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('skills') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Skills<span class="star">*</span></label>

                            <div class="col-md-6">
                            
                            <select id="select-state" name="skills[]" multiple class="demo-default" style="" placeholder="Select a skill..." required>
                                
                                <option value="">Select</option>
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

                                @if ($errors->has('skills'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('skills') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('industry') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">industry<span class="star">*</span> </label>

                            <div class="col-md-6">
                    <select id="select-industry" name="industry[]" multiple class="demo-default" style="" placeholder="Select a industry..." required>
                        <option value="">Select</option>

                    <option value="Consumer B2C">Consumer B2C, D2C</option>
                    <option value="D2C">D2C</option>
                    <option value="SaaS">SaaS</option>
                    <option value="B2B">B2B</option>
                    <option value="Fintech">Fintech</option>
                    <option value="Luxury (high basket/low volume)">Luxury (high basket/low volume)</option>
                    <option value="Everything store (low baskets/high volume)">Everything store (low baskets/high volume)</option>
                    <option value="Classified">Classified</option>
                    </select>   
                                @if ($errors->has('industry'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('industry') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('linkedin') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Linkedin<span class="star">*</span> </label>

                            <div class="col-md-6">
                                <input type="" id="password"  class="form-control" name="linkedin" value="{{ old('linkedin') }}" required/>

                                @if ($errors->has('linkedin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('linkedin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('other_site') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Other Site</label>

                            <div class="col-md-6">
                                <input  type="" id="password"  class="form-control" name="other_site" value="{{ old('linkedin') }}" />

                                @if ($errors->has('other_site'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('other_site') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  

                        <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">About me<span class="star">*</span></label>

                            <div class="col-md-6">
                                <textarea id="password"  class="form-control" name="about" placeholder="introduce yourself" value="about" required>{{ old('about') }}</textarea>

                                @if ($errors->has('about'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('about') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                          

                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Country<span class="star">*</span></label>

                            <div class="col-md-6">
                                <input  type="" id="password"  class="form-control" name="country" value="{{ old('country') }}" required/>

                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                          

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">City<span class="star">*</span></label>

                            <div class="col-md-6">
                                <input  type="" id="password"  class="form-control" name="city" value="{{ old('city') }}" required/>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                                                
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
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
    $('#select-state').selectize({
        maxItems: 10
    }); 
    $('#select-industry').selectize({
        maxItems: 5
    });
</script>
@endsection
