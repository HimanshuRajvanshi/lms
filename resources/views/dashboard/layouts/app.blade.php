<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>RedSky</title>
  <!-- Bootstrap core CSS -->
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> --}}

  <link href="{{ asset('backEnd/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backEnd/fonts/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backEnd/css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backEnd/css/dropzone.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/qtip2/3.0.3/jquery.qtip.min.css"/>
  <link href="{{ asset('backEnd/css/custom.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('backEnd/css/maps/jquery-jvectormap-2.0.3.css') }}" />
  <link href="{{ asset('backEnd/css/icheck/flat/green.css') }}" rel="stylesheet" />
  <link href="{{ asset('backEnd/css/floatexamples.css') }}" rel="stylesheet" type="text/css" />
  {!! Html::style( asset('backEnd/css/toastr.css')) !!} 
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://colorlib.com/polygon/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


  <script src="{{ asset('backEnd/js/jquery.min.js') }}"></script>
  <script src="{{ asset('backEnd/js/nprogress.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  {!! Html::script( asset('backEnd/js/toastr.min.js')) !!}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.3/fullcalendar.min.css"/>
  {{-- <script type="text/javascript" src='https://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script> --}}

  <script src="{{ asset('backEnd/js/fullcalendar/moment.min.js') }}"></script>
  
  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.3/fullcalendar.min.js'></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.0.1/main.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.0.1/main.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.0.1/main.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/qtip2/3.0.3/jquery.qtip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script> 
  {{-- <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  --}}
  {{-- <script src="http://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>  --}}
  {{-- <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery.min.js'></script> --}}
  {{-- <script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script> --}}

  <script>var FULL_PATH = "<?=url('/')?>";</script>
</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title">
              <strong class="intranet">Status</strong>
              <strong style="color: red;">Red</strong>
              <strong class="text-primary">Sky</strong>
        </span></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="http://127.0.0.1:8000/backEnd/images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2>
                 <?php
                    $users=Session::get('user');
                      $name=$users['user']->name;
                      $role_name=$users['user']->getRole->name;
                      echo $name.'<br/>'.$role_name;             
                  ?>
              </h2>
            </div>
          </div>
          <!-- /menu prile quick info -->

          <br />
           @include('dashboard.layouts.sidebar')

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="top" title="Logout">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
           </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="http://127.0.0.1:8000/backEnd/images/img.jpg" alt="">
                  
                  <?php
                    $users=Session::get('user');
                    echo $users['user']->name; 
                  ?>

                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <li><a href="javascript:;">Profile</a></li>
                  <li><a href="javascript:;"><span class="badge bg-red pull-right">50%</span><span>Settings</span></a></li>
                  <li><a href="javascript:;">Help</a></li>
                  <li>
                     <a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </li>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>

                </ul>
              </li>

              <li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i><span class="badge bg-green">6</span></a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                  <li><a><span class="image"><img src="http://127.0.0.1:8000/backEnd/images/img.jpg" alt="Profile Image" /></span><span>
                         <span>John Smith</span>
                         <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">Film festivals used to be do-or-die moments for movie makers. They were where...</span>
                    </a>
                  </li>
                  <li><a><span class="image"><img src="http://127.0.0.1:8000/backEnd/images/img.jpg" alt="Profile Image" /></span><span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                         </span>
                      <span class="message">Film festivals used to be do-or-die moments for movie makers. They were where...</span>
                    </a>
                  </li>

                  <li><a><span class="image"><img src="http://127.0.0.1:8000/backEnd/images/img.jpg" alt="Profile Image" /></span>
                          <span><span>John Smith</span>
                          <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">Film festivals used to be do-or-die moments for movie makers. They were where...</span>
                    </a>
                  </li>

                  <li><a><span class="image"><img src="http://127.0.0.1:8000/backEnd/images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <div class="text-center">
                      <a href="inbox.html">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </nav>
        </div>

      </div>
      <!-- /top navigation -->
      @include('error')  
      @yield('content')

     

    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>
  
  {{-- <script src="{{ asset('backEnd/js/bootstrap.min.js') }}"></script> --}}
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <!-- gauge js -->
  {{-- <script type="text/javascript" src="{{ asset('backEnd/js/gauge/gauge.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backEnd/js/gauge/gauge_demo.js') }}"></script> --}}
  <!-- bootstrap progress js -->
  <script src="{{ asset('backEnd/js/progressbar/bootstrap-progressbar.min.js') }}"></script>
  <script src="{{ asset('backEnd/js/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <!-- icheck -->
  <script src="{{ asset('backEnd/js/icheck/icheck.min.js') }}"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="{{ asset('backEnd/js/moment/moment.min.js') }}"></script>
  {{-- <script type="text/javascript" src="{{ asset('backEnd/js/datepicker/daterangepicker.js') }}"></script> --}}
  
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <!-- chart js -->
  {{-- <script src="{{ asset('backEnd/js/chartjs/chart.min.js') }}"></script> --}}

  <script src="{{ asset('backEnd/js/custom.js') }}"></script>

  <!-- flot js -->
  <!--[if lte IE 8]>-->
    <script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/excanvas.min.js') }}"></script>
  <!--<![endif]-->
  
  <script type="text/javascript" src="{{ asset('backEnd/js/flot/jquery.flot.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backEnd/js/flot/jquery.flot.pie.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backEnd/js/flot/jquery.flot.orderBars.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backEnd/js/flot/jquery.flot.time.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backEnd/js/flot/date.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backEnd/js/flot/jquery.flot.spline.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backEnd/js/flot/jquery.flot.stack.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backEnd/js/flot/curvedLines.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backEnd/js/flot/jquery.flot.resize.js') }}"></script>
  {!! Html::script( asset('backEnd/js/jsvalidation.js')) !!}
  <script>
    $(document).ready(function() {
      // [17, 74, 6, 39, 20, 85, 7]
      //[82, 23, 66, 9, 99, 6, 2]
      var data1 = [
        [gd(2012, 1, 1), 17],
        [gd(2012, 1, 2), 74],
        [gd(2012, 1, 3), 6],
        [gd(2012, 1, 4), 39],
        [gd(2012, 1, 5), 20],
        [gd(2012, 1, 6), 85],
        [gd(2012, 1, 7), 7]
      ];

      var data2 = [
        [gd(2012, 1, 1), 82],
        [gd(2012, 1, 2), 23],
        [gd(2012, 1, 3), 66],
        [gd(2012, 1, 4), 9],
        [gd(2012, 1, 5), 119],
        [gd(2012, 1, 6), 6],
        [gd(2012, 1, 7), 9]
      ];
      $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
        data1, data2
      ], {
        series: {
          lines: {
            show: false,
            fill: true
          },
          splines: {
            show: true,
            tension: 0.4,
            lineWidth: 1,
            fill: 0.4
          },
          points: {
            radius: 0,
            show: true
          },
          shadowSize: 2
        },
        grid: {
          verticalLines: true,
          hoverable: true,
          clickable: true,
          tickColor: "#d5d5d5",
          borderWidth: 1,
          color: '#fff'
        },
        colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
        xaxis: {
          tickColor: "rgba(51, 51, 51, 0.06)",
          mode: "time",
          tickSize: [1, "day"],
          //tickLength: 10,
          axisLabel: "Date",
          axisLabelUseCanvas: true,
          axisLabelFontSizePixels: 12,
          axisLabelFontFamily: 'Verdana, Arial',
          axisLabelPadding: 10
            //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
        },
        yaxis: {
          ticks: 8,
          tickColor: "rgba(51, 51, 51, 0.06)",
        },
        tooltip: false
      });

      function gd(year, month, day) {
        return new Date(year, month - 1, day).getTime();
      }
    });
  </script>

  <!-- worldmap -->
  <script type="text/javascript" src="{{ asset('backEnd/js/maps/jquery-jvectormap-2.0.3.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backEnd/js/maps/gdp-data.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backEnd/js/maps/jquery-jvectormap-world-mill-en.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backEnd/js/maps/jquery-jvectormap-us-aea-en.js') }}"></script>

  {{-- <script type="text/javascript" src="{{ asset('backEnd/js/dropzone/jquery-jvectormap-us-aea-en.js') }}"></script> --}}
   <script src="{{ asset('backEnd/js/dropzone/dropzone.js') }}"></script>

  {{-- <script>
    $(function() {
      $('#world-map-gdp').vectorMap({
        map: 'world_mill_en',
        backgroundColor: 'transparent',
        zoomOnScroll: false,
        series: {
          regions: [{
            values: gdpData,
            scale: ['#E6F2F0', '#149B7E'],
            normalizeFunction: 'polynomial'
          }]
        },
        onRegionTipShow: function(e, el, code) {
          el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
        }
      });
    });
  </script> --}}
  <!-- skycons -->
  <script src="{{ asset('backEnd/js/skycons/skycons.min.js') }}"></script>
  <script>
    var icons = new Skycons({
        "color": "#73879C"
      }),
      list = [
        "clear-day", "clear-night", "partly-cloudy-day",
        "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
        "fog"
      ],
      i;

    for (i = list.length; i--;)
      icons.set(list[i], list[i]);

    icons.play();
  </script>

  {{-- <!-- dashbord linegraph -->
  <script>
    Chart.defaults.global.legend = {
      enabled: false
    };

    var data = {
      labels: [
        "Symbian",
        "Blackberry",
        "Other",
        "Android",
        "IOS"
      ],
      datasets: [{
        data: [15, 20, 30, 10, 30],
        backgroundColor: [
          "#BDC3C7",
          "#9B59B6",
          "#455C73",
          "#26B99A",
          "#3498DB"
        ],
        hoverBackgroundColor: [
          "#CFD4D8",
          "#B370CF",
          "#34495E",
          "#36CAAB",
          "#49A9EA"
        ]

      }]
    };

    // var canvasDoughnut = new Chart(document.getElementById("canvas1"), {
    //   type: 'doughnut',
    //   tooltipFillColor: "rgba(51, 51, 51, 0.55)",
    //   data: data
    // });
  </script> --}}
  <!-- /dashbord linegraph -->
  <!-- datepicker -->
  <script type="text/javascript">
    $(document).ready(function() {

      var cb = function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
      }

      var optionSet1 = {
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: {
          days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
          applyLabel: 'Submit',
          cancelLabel: 'Clear',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        }
      };
      $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
      $('#reportrange').daterangepicker(optionSet1, cb);
      $('#reportrange').on('show.daterangepicker', function() {
        console.log("show event fired");
      });
      $('#reportrange').on('hide.daterangepicker', function() {
        console.log("hide event fired");
      });
      $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
      });
      $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
        console.log("cancel event fired");
      });
      $('#options1').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
      });
      $('#options2').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
      });
      $('#destroy').click(function() {
        $('#reportrange').data('daterangepicker').remove();
      });
    });
  </script>
  <script>
    NProgress.done();
  </script>
  @yield('script')
  <!-- /datepicker -->
  <!-- /footer content -->
</body>

</html>

