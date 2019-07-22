@extends('dashboard.layouts.app')

@section('content')
<div class="right_col" role="main">  
<!-- page content -->
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>{{$user->name}} Profile</h3>
        </div>

        <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>User Report <small>Activity report</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">

              <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

                <div class="profile_img">

                  <!-- end of image cropping -->
                  <div id="crop-avatar">
                    <!-- Current avatar -->
                    <div class="avatar-view" title="Change the avatar">
                        @if($user->photo == null) 
                            <img src="http://127.0.0.1:8000/backEnd/images/pic.png" alt="Avatar">
                        @else
                            <img src="{{ asset('profile/')}}/{{$user->photo}}" alt="Avatar">  
                        @endif
                    </div>

                    <!-- Cropping modal -->
                    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
                            <div class="modal-header">
                              <button class="close" data-dismiss="modal" type="button">&times;</button>
                              <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                            </div>
                            <div class="modal-body">
                              <div class="avatar-body">

                                <!-- Upload image and data -->
                                <div class="avatar-upload">
                                  <input class="avatar-src" name="avatar_src" type="hidden">
                                  <input class="avatar-data" name="avatar_data" type="hidden">
                                  <label for="avatarInput">Local upload</label>
                                  <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                                </div>

                                <!-- Crop and preview -->
                                <div class="row">
                                  <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                  </div>
                                </div>

                                <div class="row avatar-btns">
                                  <div class="col-md-9">
                                    <div class="btn-group">
                                      <button class="btn btn-primary" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">Rotate Left</button>
                                      <button class="btn btn-primary" data-method="rotate" data-option="-15" type="button">-15deg</button>
                                      <button class="btn btn-primary" data-method="rotate" data-option="-30" type="button">-30deg</button>
                                      <button class="btn btn-primary" data-method="rotate" data-option="-45" type="button">-45deg</button>
                                    </div>
                                    <div class="btn-group">
                                      <button class="btn btn-primary" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">Rotate Right</button>
                                      <button class="btn btn-primary" data-method="rotate" data-option="15" type="button">15deg</button>
                                      <button class="btn btn-primary" data-method="rotate" data-option="30" type="button">30deg</button>
                                      <button class="btn btn-primary" data-method="rotate" data-option="45" type="button">45deg</button>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <button class="btn btn-primary btn-block avatar-save" type="submit">Done</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- <div class="modal-footer">
                                              <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                                            </div> -->
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- /.modal -->

                    <!-- Loading state -->
                    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                  </div>
                  <!-- end of image cropping -->

                </div>
            <h3>{{$user->name}}</h3>

                <ul class="list-unstyled user_data">
                  <li><i class="fa fa-map-marker user-profile-icon"></i> {{$user->present_address}}
                  </li>

                  <li>
                    <i class="fa fa-briefcase user-profile-icon"></i> {{$user->designation}}
                  </li>

                  <li>
                    <i class="fa fa-mobile user-profile-icon"></i> {{$user->contact_number}}
                  </li>
                </ul>

            <a class="btn btn-success" href="{{url('edit/user',base64_encode($user->id))}}"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                <br />

                <!-- start skills -->
                <h4>Skills</h4>
                <ul class="list-unstyled user_data">
                  <li>
                    <p>Web Applications</p>
                    <div class="progress progress_sm">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                    </div>
                  </li>
                  <li>
                    <p>Website Design</p>
                    <div class="progress progress_sm">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                    </div>
                  </li>
                  <li>
                    <p>Automation & Testing</p>
                    <div class="progress progress_sm">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                    </div>
                  </li>
                  <li>
                    <p>UI / UX</p>
                    <div class="progress progress_sm">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                    </div>
                  </li>
                </ul>
                <!-- end of skills -->

              </div>
              <div class="col-md-9 col-sm-9 col-xs-12">

                <div class="profile_title">
                  <div class="col-md-6">
                    <h2>User Attendance Report</h2>
                  </div>
                </div>
                <!---For Calendar -->
                <div>
                  <div id='calendar'></div>  

                </div>
                 <br><br><br> 
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    {{-- <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a>
                    </li> --}}
                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                    </li>
                  </ul>
                  <div id="myTabContent" class="tab-content">
                   
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content2" aria-labelledby="profile-tab">

                      <!-- start user projects -->
                      <table class="data table table-striped no-margin">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Client Company</th>
                            <th class="hidden-phone">Hours Spent</th>
                            <th>Contribution</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>New Company Takeover Review</td>
                            <td>Deveint Inc</td>
                            <td class="hidden-phone">18</td>
                            <td class="vertical-align-mid">
                              <div class="progress">
                                <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>New Partner Contracts Consultanci</td>
                            <td>Deveint Inc</td>
                            <td class="hidden-phone">13</td>
                            <td class="vertical-align-mid">
                              <div class="progress">
                                <div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Partners and Inverstors report</td>
                            <td>Deveint Inc</td>
                            <td class="hidden-phone">30</td>
                            <td class="vertical-align-mid">
                              <div class="progress">
                                <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>New Company Takeover Review</td>
                            <td>Deveint Inc</td>
                            <td class="hidden-phone">28</td>
                            <td class="vertical-align-mid">
                              <div class="progress">
                                <div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <!-- end user projects -->

                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                      <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                        photo booth letterpress, commodo enim craft beer mlkshk </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


          <!-- Modal -->
          <div class="modal fade" id="editModal" role="dialog">
            <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Punch In/Out Time</h4>
              </div>
              <div class="modal-body">

              {!! Form::open(array('url' => route('post_punch_time'),'method'=>'POST', 'id'=>'post_punch_time','name'=>'post_punch_time','class'=>"form-horizontal form-label-left" ,'enctype'=>'multipart/form-data')) !!}
                  {!! csrf_field() !!}
                <input type="hidden" name="attendanceId" Id="attendanceId"/>
                <input type="hidden" name="start_date" Id="start_date"/>
                <input type="hidden" name="employeeId" Id="employeeId"/>
                

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Punch In<span class="required">*</span></label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" name="punch_in" id="punch_in"  class="form-control"  required autocomplete="off"/>
                  </div>
                </div> 
              

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Punch Out<span class="required">*</span></label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" name="punch_out" id="leavedate"  class="form-control" required autocomplete="off"/>
                  </div>
                </div> 

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description<span class="required">*</span></label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" name="description" id="description"  class="form-control" required autocomplete="off"/>
                  </div>
                </div> 

              </div>

              <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="submit" id="submit" class="btn btn-success" >Submit</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
          <br><br>
              
          {!! Form::close() !!}

            </div>
            </div>
          </div>



@endsection


@section('script')
<script type= text/javascript>
  $(document).ready(function () {
     var data =<?php print_r(json_encode($attendances)) ?>;
     console.log(data);  
     calendar_draw(data);
   })
 
 
   function calendar_draw(event_lists){
     $('#calendar').fullCalendar({
       plugins: [ 'interaction', 'dayGrid', 'timeGrid','dayGridPlugin'],
       selectable: true,
       eventLimit: true,
       startEditable: true,
       navLinks: true,
       disableDragging: true,
       editable:true, 
       draggable: false,

       height:450,
       header: {
         left: 'prev,next today',
         center: 'title',
         right: 'month,agendaWeek'
       },
       
       select: function(startDate, endDate,info) {
        isWeekend = false;

        var employeeId="<?php echo $user->user_code; ?>";

        var start_date=formatDate(startDate);
        $("#start_date").val(start_date);
        $("#employeeId").val(employeeId);
        $("#editModal").modal('show');

        }, 
 
         events: event_lists,
        //  eventRender: function(event, element) {
        //    element.qtip({
        //      content: event.description,
        //      position: {
        //          my: 'bottom left',
        //          at: 'bottom left',
        //        },
        //    });
        //  },
        
         eventClick: function (event) {
            console.log(event);
            var confirmMsg = confirm("Do you really want to edit?");
            if (confirmMsg){
              var punch_in_tmp=event.title;
              var tmp=punch_in_tmp.replace("-","");
              $("#punch_in").val(tmp);
              $("#attendanceId").val(event._id);
              $("#start_date").val(event.start._i);
              $("#editModal").modal('show');
            }
        },
       });
   }
 
  //for start date change formate
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth()+1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('-');
}

        $(function() {
          var day_data = [{
            "period": "Jan",
            "Hours worked": 80
          }, {
            "period": "Feb",
            "Hours worked": 125
          }, {
            "period": "Mar",
            "Hours worked": 176
          }, {
            "period": "Apr",
            "Hours worked": 224
          }, {
            "period": "May",
            "Hours worked": 265
          }, {
            "period": "Jun",
            "Hours worked": 314
          }, {
            "period": "Jul",
            "Hours worked": 347
          }, {
            "period": "Aug",
            "Hours worked": 287
          }, {
            "period": "Sep",
            "Hours worked": 240
          }, {
            "period": "Oct",
            "Hours worked": 211
          }];
          Morris.Bar({
            element: 'graph_bar',
            data: day_data,
            xkey: 'period',
            hideHover: 'auto',
            barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
            ykeys: ['Hours worked', 'sorned'],
            labels: ['Hours worked', 'SORN'],
            xLabelAngle: 60
          });
        });
      </script>

@endsection
      