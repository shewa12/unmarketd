            <div class="profile clearfix">
           
              <div class="profile_pic">
              	<center>
              	@if(empty(Auth::user()->image))
              		<img class="thumbnail" src="{{url('/public/img/avatar.png')}}" style="width:60px; height:60px; border-radius:50%;">
              	@else
              		<img class="thumbnail" src="{{url('/storage/app/avatars/')}}/{{Auth::user()->image}}" style="width:60px; height:60px; border-radius:50%;">
              	@endif
              	</center>
              </div>
              <div class="profile_info">
                <span>Welcome, <strong>{{Auth::user()->name}}</strong></span>

              </div>

            </div>