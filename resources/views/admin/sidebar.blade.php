

       <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
                
            <ul class="nav side-menu">
            @if(Auth::user()->is_admin===1)  
              <!--sidebar menu for admin end-->
                  <li><a href="{{route('admin')}}"><i class="fas fa-th"></i> Dashboard</a>
                  <li><a href="{{route('users')}}"><i class="fas fa-users"></i> All Freelancers</a>
                  </li>                  

                  <li><a href="{{route('activities')}}"><i class="fas fa-chart-line"></i> Add Freelancer Activity</a>
                  </li>
                  <li><a href="{{route('performance')}}"><i class="fas fa-cog"></i> Add Freelancer Performance</a>
                  </li>                  
                  <li><a href="{{route('freelancerFilter')}}"><i class="fas fa-filter"></i> Freelancer Filter</a>
                  </li>                  

                  <li><a href="{{route('appUsers')}}"><i class="fas fa-user-friends"></i> All Clients</a>
                  </li>                  

                  <li><a><i class="far fa-list-alt"></i> Project Request <span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('clientActiveReq')}}">Active Request</a></li>
                      
                      <li><a href="{{route('clientClosedPro')}}">Closed Project</a></li>
                      
                    </ul>
                  </li> 
                  <li><a href="{{route('clientsupportTicket')}}"><i class="fas fa-headset"></i> Support Ticket</a>
                  </li>                   

                  <li><a href="{{route('adminContract')}}"><i class="fas fa-file-signature"></i> Contracts</a>
                  </li>                   
              @endif    
              <!--sidebar menu for admin start-->
              @if(Auth::user()->is_client===1)

                  <li><a><i class="far fa-list-alt"></i>  Project Request <span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('clientDashboard')}}">Active Request</a></li>
                      
                      <li><a href="{{route('closedProject')}}">Closed Project</a></li>
                      
                    </ul>
                  </li>                      
                 
                  <li><a href="{{route('assignedFreelancer')}}"><i class="fas fa-users"></i> Assigned Freelancers</a>
                  </li>

                  <li><a href="{{route('comProfile')}}"><i class="fas fa-building"></i> Comapany Profile</a>
                  </li>
                  <li><a href="{{route('supportTicket')}}"><i class="fas fa-headset"></i> Support Ticket</a>
                  </li>  

                 <li><a href="{{route('clientContract')}}"><i class="fas fa-file-signature"></i> Contracts</a>
                  </li>                  

                  <li><a href="{{route('clientReport')}}"><i class="fas fa-bug"></i> Reports</a>
                  </li>                   
              @endif                    
              </ul>
             
              </div>


            </div>

