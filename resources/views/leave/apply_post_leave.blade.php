@extends('dashboard.layouts.app')

@section('content')

@php
$users=Session::get('user');
$role_name=$users['user']->getRole->name;
$active_calendar = '';
$active_list = '';

if($role_name == 'Admin'){
  $active_list = 'in active';
}else{
  $active_calendar = 'in active';
}
@endphp

<div class="right_col" role="main">
    <div class="container">

        @if($role_name != 'Admin') 
          <p>*For Edit leave click on leave titile</p>
          <ul class="nav nav-tabs">
              <li class="active"><a href="#calendars">Calendar</a></li>
              <li><a href="#list">List</a></li>
          </ul>
        @endif  

        <div class="tab-content">  
         <!---For Calendar Tab-->   
        <div class="panel panel-primary tab-pane fade <?php echo $active_calendar ?>"  id="calendars">
            <div class="panel-heading" id="asdf">
                My Leave Calender  
            </div>
            <div id='calendar'></div>
        </div>

        <!---List-->   
        <div class="col-md-12 col-sm-12 col-xs-12 tab-pane fade <?php echo $active_list ?>" id="list">
            <div class="panel panel-primary">    
          <div class="panel-heading" id="asdf">
                My Leave List
          </div>
            <div class="x_panel">
               <table id="DataTable" class="table table-striped table-bordered sorting_desc">
                  <thead>
                     <tr>
                       <th>#</th>
                       @if($role_name == 'Admin') 
                        <th>User Name</th>
                       @endif 
                       <th>Leave Type</th>
                       <th>Leave From</th>
                       <th>Leave To</th>
                       <th>Total Days</th>
                       <th>Reason</th>
                       <th>Mobile</th>
                       <th>Created At</th>
                       @if($role_name != 'Admin') 
                        <th style="width:40px;">Action</th>
                       @endif
                       <th>Status</th>
                   </tr>
               </thead>
               <tbody>
               @if(count($apply_leaves))
                 @foreach($apply_leaves as $key => $apply_leave)
               @php $key++ @endphp
                 <tr>
                   <td>{{$key++}}</td>
                   @if($role_name == 'Admin')  
                    <td>{{$apply_leave->getUserName->name}}</td>
                   @endif 

                   <td>{{$apply_leave->getLeaveType->leave_name}}</td>
                   <td>{{$apply_leave->leave_start_date}}</td>
                   <td>{{$apply_leave->leave_end_date}}</td>
                   <td>{{$apply_leave->total_days}}</td>
                   <td>{{ str_limit($apply_leave->leave_reason, $limit = 50, $end = '...') }}</td>
                   <td>{{$apply_leave->phone}}</td>
                   <td>{{date('d-M-Y',strtotime($apply_leave->created_at))}}</td>
                   @if($role_name != 'Admin')  
                   @if($apply_leave->leave_status == 'Pending')
                    <td><a href="{{route('edit_leave',$apply_leave->id)}}"><button type="button" class="btn btn-info btn-sm"><i class="far fa-edit"></i>
                    </button></a></td>
                   @else
                   <td><button type="button" class="btn btn-info btn-sm"><i class="fa fa-check"></i></button></td>
                    @endif 

                   @endif   

                   <td> 
                       @if($role_name == 'Admin')
                           @if($apply_leave->leave_status == 'Pending')
                               <button type="button" class="btn btn-danger btn-sm" onclick="leaveStatus('{{$apply_leave->id}}','Rejected')">Reject</button>
                               <button type="button" class="btn btn-success btn-sm" onclick="leaveStatus('{{$apply_leave->id}}','Approved')">Approve</button>
                           @else
                               @if($apply_leave->leave_status == 'Rejected')
                                   <button type="button" class="btn btn-danger btn-sm" style="cursor:not-allowed;">Rejected</button>
                               @else
                                   <button type="button" class="btn btn-success btn-sm" style="cursor:not-allowed;">Approved</button>
                               @endif 
                           @endif    
                       @else
                           @if($apply_leave->leave_status == 'Pending')
                               <button type="button" class="btn btn-info btn-sm" style="cursor:not-allowed;">Pending</button>
                               @else
                                   @if($apply_leave->leave_status == 'Rejected')
                                       <button type="button" class="btn btn-danger btn-sm" style="cursor:not-allowed;">Rejected</button>
                                   @else
                                       <button type="button" class="btn btn-success btn-sm" style="cursor:not-allowed;">Approved</button>
                                   @endif 
                           @endif    
                       @endif  
                    </td>
                   </tr>
                   @endforeach    
               </tbody>
               @endif
           </table>
       </div>
       </div>
      </div>
    </div>
  


      </div>
    </div>
    
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Apply Leave</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => route('post_leave'),'method'=>'POST', 'id'=>'post_leave_apply','name'=>'post_leave_apply','class'=>"form-horizontal form-label-left" ,'enctype'=>'multipart/form-data')) !!}
                 {!! csrf_field() !!}

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Leave Type <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="leave_Id" id="leave_Id" class="form-control"> 
                          <option selected="" >Select</option> --}}
                            @foreach ($leavesTypes as $leavesType)
                                  <option value="{{ $leavesType->id }}">{{ $leavesType->leave_name}}</option>
                                  {{-- <option value="{{ $leavesType->id }}" {{($leaveApply->leave_type_Id == $leavesType->id )? 'selected' : '' }}>{{ $leavesType->leave_name }}</option>  --}}
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="leaveStartDate" id="leaveStartDate"/>
                    <input type="hidden" name="leaveEndDate" id="leaveEndDate"/>
                   

                   <div id="calendarEdit"> 
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Select start & end date <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="leavedate" id="leavedate"  class="form-control" autocomplete="off"/>
                      </div>
                    </div> 
                        
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Total Days <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           {!! Form::number('total_days', isset($leaveApply) ? $leaveApply->total_days:old('total_days'), array("id" => "total_days", 'class' => 'form-control col-md-7 col-xs-12','readonly')) !!}
                        </div>
                    </div>

                    <input type="hidden" name="leaveOldId" id="leaveOldId" /> 
                  </div> 

                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Reason For Leave <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::textarea('leave_reason', isset($leaveApply) ? $leaveApply->leave_reason:old('leave_reason'), array("id" => "leave_reason", 'placeholder' => 'Enter leave reason','class' => 'form-control col-md-7 col-xs-12','required')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contact no. during leave<span class="required">*</span></label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                         {!! Form::number('phone', isset($leaveApply) ? $leaveApply->phone:old('phone'), array("id" => "phone", 'placeholder' => 'Enter phone number','class' => 'form-control col-md-7 col-xs-12','required')) !!}
                      </div>
                    </div>
                    

                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button type="submit" name="submit" id="submit" class="btn btn-success" >Submit</button>
                      <button type="reset" class="btn btn-primary">Reset</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                  {!! Form::close() !!}

            
            </div>
          </div>
        </div>
      </div>

@endsection                

@section('script')
  {!! JsValidator::formRequest('App\Http\Requests\LeaveApplyRequest', '#post_leave_apply'); !!}

<script type= text/javascript>
  $(document).ready(function(){
  $(".nav-tabs a").click(function(){
    $(this).tab('show');
  });
  }); 

 $('input[name="leavedate"]').daterangepicker({
    timePicker: true,
    defaultDate: false,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
      format: 'M/DD hh:mm A'
    }
  });

  $('input[name="leavedate"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
      var leaveStartDate = moment(picker.startDate.format('YYYY-MM-DD'));
      var leaveEndDate = moment(picker.endDate.format('YYYY-MM-DD'));
      // console.log(leaveEndDate);
      var total_days;
      total_days=leaveEndDate.diff(leaveStartDate, 'days') +1  // =1
      $("#leaveStartDate").val(picker.startDate.format('YYYY-MM-DD'));
      $("#leaveEndDate").val(picker.endDate.format('YYYY-MM-DD'));
      $("#total_days").val(total_days);
  });


$(document).ready(function () {
    var data = <?php echo json_encode($events); ?>;
      calendar_draw(data.original.events);
  })

  $.ajax({
      url:'/add/leave/get/leave',
      type: "GET",
      success: function (events) {
            calendar_draw(events)
          },
        });

  function calendar_draw(event_lists){
    $('#calendar').fullCalendar({
      plugins: [ 'interaction', 'dayGrid', 'timeGrid','dayGridPlugin'],
      selectable: true,
      editable: true,
      eventLimit: true,
      startEditable: true,
      navLinks: true,
      draggable: false,
      height:690,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },

      select: function(startDate, endDate) {
         var enddate2 = new Date(endDate);
         var end_data = enddate2.setDate(enddate2.getDate()-1);  
         end_data=formatDate(end_data);  // =1
         var start_date=formatDate(startDate);

         var aa = moment(start_date, 'YYYY/MM/DD');
         var bb = moment(end_data, 'YYYY/MM/DD');
         var total_days = bb.diff(aa, 'days')+1;
         $('#calendarEdit').hide();
         $("#myModal").modal('show');
         $("#leaveStartDate").val(start_date);
         $("#leaveEndDate").val(end_data);
         $("#total_days").val(total_days);
         
       }, 

        events: event_lists,
        
        eventRender: function(event, element) {
          element.qtip({
            content: event.description,
            position: {
                my: 'top center',
                at: 'top center',
              },
          });

        if (event.className == 'Pending') {
            element.css({
                'background-color': '#337ab',
                'border-color': '#337ab',
            });
          }else if (event.className == 'Rejected') {
            element.css({
            'background-color': '#B22222',
            'border-color': '#B22222'
          });
          } else {
            element.css({
            'background-color': '#006400',
            'border-color': '#006400'
          });
          }

          //form Delete Event  
          element.append( "<span class='closeon'>X</span>" );
          element.find(".closeon").click(function() {
            var confirmMsg = confirm("Do you really want to delete?");
            if (confirmMsg) {
                $('#calendar').fullCalendar('removeEvents',event._id);
                $.ajax({
                      url:'/add/leave/delete/leave/'+event._id,
                      type: "GET",
                      success: function (events) {
                            // console.log(events)
                            // alert("Leave Successfull deleted.");
                            toastr.success("Leave Successfull deleted.");
                          },
                    });
              }
            });
        },
        
        //For Edit Event
        eventClick: function (event) {
            // console.log(event);
            var confirmMsg = confirm("Do you really want to edit?");
            if (confirmMsg) {
                $('#calendarEdit').show();
                $("#leave_Id").val(event.leave_type_Id);
                $("#leave_reason").val(event.leave_reason);
                $("#phone").val(event.phone);
                $("#leaveOldId").val(event.id);
                $("#myModal").modal('show');
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

function leaveStatus(id,type){
         var baseUrl = FULL_PATH+"/leave/status/update/"+id +'/'+type;     
           $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : baseUrl,
                type: "GET",
                success: function(response){
                    // console.log(response);
                    if(response.type == 'success'){
                        toastr.success(response.message);  
                        setTimeout(function(){
                            window.location.reload(); 
                        }, 2000);
                    }else{
                        toastr.error("There is something wrong. Please contact administrator");
                    }   
                }
            });
        }
 </script>
 
@endsection
