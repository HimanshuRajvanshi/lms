@extends('dashboard.layouts.app')

@section('content')

<div class="right_col" role="main">
    <div class="container">

         <!---For Calendar Tab-->   
        <div class="panel panel-primary">
            <div class="panel-heading" id="asdf">
                Punch In/Punch Out Calender  
            </div>
            <div id='calendar'></div>
        </div>
      </div>
    </div>
    
@endsection                

@section('script')

<script type= text/javascript>
 $(document).ready(function () {
  // var data = [{title: "9:30 - 7:10", start: "2019-06-01", end: "2019-06-02"},{title: "9:55AM - 8:20PM", start: "2019-06-02", end: "2019-06-03"},{title: "10:00 - 7:00", start: "2019-07-15", end: "2019-07-18"}]
    var data =<?php print_r(json_encode($attendances)) ?>;
    // console.log(data);  
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
      // weekNumbers: true, // side show time
      // editable:true, 
      height:690,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      
      select: function(startDate, endDate,info) {
        // console.log(info);
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
        },
       
        // eventClick: function (event) {
        //     console.log(event);
        //     var confirmMsg = confirm("Do you really want to edit?");
        //     if (confirmMsg){
            
        //       $("#editModal").modal('show');

        //     }
        // },
      });
  }

 </script>
 
@endsection
