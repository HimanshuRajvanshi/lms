<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Program Status | RedSky </title>
  

  <link rel="apple-touch-icon" sizes="180x180" href="<?=url('/')?>/backEnd/images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?=url('/')?>/backEnd/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?=url('/')?>/backEnd/images/favicon-16x16.png">


  <!-- Bootstrap core CSS -->
  <link href="{{ asset('backEnd/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backEnd/fonts/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backEnd/css/animate.min.css') }}" rel="stylesheet">
  
  <!-- Custom styling plus plugins -->
  <link href="{{ asset('backEnd/css/custom.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('backEnd/css/maps/jquery-jvectormap-2.0.3.css') }}" />
  <link href="{{ asset('backEnd/css/icheck/flat/green.css') }}" rel="stylesheet" />
  <link href="{{ asset('backEnd/css/floatexamples.css') }}" rel="stylesheet" type="text/css" />
  <script src="{{ asset('backEnd/js/jquery.min.js') }}"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

  <!--- Country select dropdown ---->
  <link rel="stylesheet" type="text/css" href="{{ asset('/backEnd/css/msdropdown/dd.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('/backEnd/css/msdropdown/flags.css') }}" />

  <!-- <script src="js/jquery/jquery-1.8.2.min.js"></script> -->
  <script src="{{ asset('/backEnd/js/msdropdown/jquery.dd.min.js') }}"></script>
  <script>
      $(document).ready(function() {
      $("#countries").msDropdown();
      })
  </script>
  {{-- <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  --}}
  {{-- <script src="http://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>  --}}
  <script>var FULL_PATH = "<?=url('/')?>";</script>
</head>
<?php
$countries = ['in'=>'IST', 'us'=>'CDT', 'nl'=>'CEST'];
// echo $timezone;
?>
<body  style="background-color: white">
  <div class="container body">

      <div class="container-fuild bg-red header-bg">
          <div class="container-main">
  
           <a href="https://redskymobility.com/"><div class="logo"><img src="<?=url('/')?>/backEnd/images/logo.svg"></div></a>
  
              
              <select name="countries" id="countries" style="width:170px; float:right; margin-top:10px;">
                  @foreach ($countries as $key=>$val)
                    <?php 
                    $selected = "";
                    if($val == $timezone)
                      $selected = 'selected';
                    ?>
                  <option value="{{$val}}"  {{$selected}} data-image="<?=url('/')?>/backEnd/images/msdropdown/icons/blank.gif" data-imagecss="flag {{$key}}" data-title="{{$val}}">{{$val}}</option>  
                  
                      
                  @endforeach
                  
                </select>

            <span class="glyphicon glyphicon-time watch"></span> 
  
          </div>
      </div>
      
    <div class="main_container">
    
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
  
  <script src="{{ asset('backEnd/js/bootstrap.min.js') }}"></script>
  
  <script type="text/javascript" src="{{ asset('backEnd/js/moment/moment.min.js') }}"></script>
  <script src="{{ asset('backEnd/js/custom.js') }}"></script>

  
  <!-- skycons -->
  @yield('script')
  <!-- /datepicker -->
  <!-- /footer content -->

  <div class="container-fuild footer-bg">
    <div class="container-main">
      <div class="foot-left">
        <a href="https://redskymobility.com/"><img src="<?=url('/')?>/backEnd/images/logo.svg"></a>
    </div>
      <p>Copyright RedSky Mobility Solutions © 2019</p>
      <div class="foot-right">
        <a href="https://www.facebook.com/RedSky-Mobility-312406786061081/" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.linkedin.com/company/redsky-mobility-solutions-llc/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        <a href="https://twitter.com/MobilityRedsky" target="_blank"><i class="fab fa-twitter"></i></a>
    </div>
    </div>
  </div>


  <!-- /footer content -->
</body>
</html>

