<!-- sidebar menu -->
     <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

        <div class="menu_section">
          <h3>General</h3>
          <ul class="nav side-menu">
              <?php
                  $users=Session::get('user');
                  $role_name=$users['user']->getRole->name;
                  if($role_name == 'Admin')
                    echo '<li><a><i class="fa fa-home"></i> Company <span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu" style="display: none">
                             <li><a href="/add/company">Add Company</a></li>
                             <li><a href="/list/company">List Company</a></li>
                           </ul>
                          </li>

                          <li><a><i class="fa fa-desktop"></i> Department <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                              <li>
                                <a href="/add/department">Add Department</a>
                              </li>
                              <li>
                              <a href="/list/department">View Department</a>
                              </li>
                            </ul>
                          </li>
                          
                          <li><a><i class="fa fa-table"></i> User <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                            <li><a href="/add/user/page">Add User</a>
                              </li>
                            <li><a href="/list/user">List User</a>
                              </li>
                            </ul>
                          </li>'
                        ?>
  
                        <li><a><i class="fa fa-calendar"></i> Leave Managment <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none">
                          <li><a href="{{route('add_leave')}}">Apply Leave</a>
                            </li>
                          {{-- <li><a href="{{route('list_apply_leave')}}">List Leave</a></li> --}}
                          </ul>
                        </li>

                        <li><a><i class="fa fa-clock-o"></i> Attendance <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none">
                          <li><a href="{{route('upload_attendance')}}">Upload Attendance</a></li>
                          <li><a href="{{route('list_attendance')}}">View Attendance</a></li>
                          
                          </ul>
                        </li>
                        
                        <li><a><i class="fa fa-bar-chart-o"></i>Server Report <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none">
                          <li><a href="{{route('server_list')}}">Servers</a>
                            </li>
                            <li><a href="{{route('program_list')}}">Programs</a>
                            </li>{{-- <li><a href="{{route('server_application_list')}}">Server Application List</a> --}}</li>
                          <li><a href="{{route('program_incidents')}}">Program Incidents</a>
                            </li>
                            
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!-- /sidebar menu -->