@extends('dashboard.layouts.ext-app')

@section('content')
<?php
 echo '<pre>';
 print_r($program_list);
 echo '</pre>';
 exit();
?>
<div style="background-color: white; width: 50%; min-width:250px;margin: auto;" role="main">
        <h1 class="clr-red mt-20 mb-20">Application</h1>
        <table id="table_id" class="table table-hover table-striped display nowrap" style="width:100%">
        <thead class="bg-red">
            <tr class="row m-0">
                <th class="font-midium col-4">Program</th>
                <th class="font-midium col-5">Server</th>
                <th class="font-midium col-3">Status</th>
            </tr>
        </thead>
        
        <tbody class="b-lbr accordion">
            @foreach($app_log as $key => $app)
            
            <tr class="row m-0">
                    <td class="col-4">{{$app['name']}}</td>       
                    <td class="col-5">{{$app['server']}}</td>
                        @if($app['app_down_time']=='')
                        <td class="col-3"><p class="text-success">Healthy</p></td>
                        @else
                                <td class="col-3"><a href="#" class="down-arrow">
                                    <i class="material-icons" type="button" data-toggle="collapse" data-target="#collapse{{$app['log_id']}}" aria-expanded="true" aria-controls="collapse{{$app['log_id']}}">keyboard_arrow_down</i>
                                </a></td>
                        @endif
                </tr>
                @if($app['app_down_time'] != "")
                <tr class="row m-0">
                        <td class="col-12 pt-0 pb-0" colspan="3">
                            <div id="collapse{{$app['log_id']}}" class="collapse" aria-labelledby="headingOne">
                              <div class="card-body pt-10 pb-10 down-arrow-card">
                                    <div class="down-card-left clr-red">Impact</div>
                                    <div class="down-card-mid">:</div>
                                    <div class="down-card-right">{{$app['impact']}}</div>
    
                                    <div class="down-card-left clr-red">Down Time</div>
                                    <div class="down-card-mid">:</div>
                                    <div class="down-card-right">{{$app['app_down_time']}}</div>
    
                                    <div class="down-card-left clr-red">Expected Up Time</div>
                                    <div class="down-card-mid">:</div>
                                    <div class="down-card-right">{{$app['expected_up_time']}}</div>
    
                                    <div class="down-card-left clr-red">Remarks</div>
                                    <div class="down-card-mid">:</div>
                                    <div class="down-card-right">{{$app['remarks']}}</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endif
            @endforeach

        </tbody>
        </table>
    
        <h1 class="clr-red mt-20 mb-20">Services</h1>

        <table id="table_id" class="table table-hover table-striped display nowrap" style="width:100%">
            <thead class="bg-red">
                <tr class="row m-0">
                    <th class="font-midium col-4">Program</th>
                    <th class="font-midium col-5">Server</th>
                    <th class="font-midium col-3">Status</th>
                </tr>
            </thead>
        
        <tbody class="b-lbr">
            @foreach($service_log as $service)
            <tr class="row m-0">
                <td class="font-midium col-4">{{$service['name']}}</td>       
                <td class="font-midium col-5">{{$service['server']}}</td>
                @if($service['app_down_time']=='')
                <td class="col-3"><p class="text-success">Healthy</p></td>
                @else
                        <td class="col-3"><a href="#" class="down-arrow">
                                <i class="material-icons" type="button" data-toggle="collapse" data-target="#collapse{{$service['log_id']}}" aria-expanded="true" aria-controls="collapse{{$service['log_id']}}">keyboard_arrow_down</i>
                        </a></td>
                @endif
        </tr>
        @if($service["app_down_time"]!="")
        <tr class="row m-0">
                <td class="col-12 pt-0 pb-0" colspan="3">
                    <div id="collapse{{$service['log_id']}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body pt-10 pb-10 down-arrow-card">
                            <div class="down-card-left clr-red">Impact</div>
                            <div class="down-card-mid">:</div>
                            <div class="down-card-right">{{$service['impact']}}</div>

                            <div class="down-card-left clr-red">Down Time</div>
                            <div class="down-card-mid">:</div>
                            <div class="down-card-right">{{$service['app_down_time']}}</div>

                            <div class="down-card-left clr-red">Expected Up Time</div>
                            <div class="down-card-mid">:</div>
                            <div class="down-card-right">{{$service['expected_up_time']}}</div>

                            <div class="down-card-left clr-red">Remarks</div>
                            <div class="down-card-mid">:</div>
                            <div class="down-card-right">{{$service['remarks']}}</div>
                        </div>
                    </div>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
        </table>
</div>
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('#table_id').DataTable({
        paging:false,
        responsive: {
            details: false
        };
    });
    var dateVar = new Date()
    var offset = dateVar.getTimezoneOffset();
    document.cookie = "offset="+offset;
  });
</script>
@endsection