@extends('dashboard.layouts.ext-app') 
@section('content')
<?php
// $timezone=date_default_timezone_set('America/New_York');
$tz = new DateTimeZone($timezone);
// echo $timezone;
?>

<div  class="container-main">
    {{----------------------------Application Status-------------------------------}}
    <h1 class="clr-red mt-20 mb-20">Applications</h1>
    <table id="table_id" class="table table-hover display nowrap" style="width:100%">
        <thead class="bg-red">
            <tr>
                <th class="font-midium tlt-left"><strong>Program</strong></th>
                <th class="font-midium tlt-right"><strong>Status</strong></th>
            </tr>
        </thead>

        <tbody class="b-lbr">
            @foreach($application_list as $key => $app)

            <tr>
                <td class="tlt-left">
                        <span>{{$app['name']}}</span>   
                </td>
                @if($app->logs->isEmpty())
                <td class="tlt-right">
                    <span class="text-success">Healthy</span>
                </td>
                @else
                <td>
                        <span>
                    <i class="fas fa-chevron-circle-down fa-lg red" data-toggle="collapse" data-target="#collapse{{$app['_id']}}" aria-expanded="true" aria-controls="collapse{{$app['log_id']}}"aria-hidden="true"></i>
                        </span>
                </td>
                @endif
            </tr>
            @if($app->logs->isNotEmpty())
            <tr>
                <td colspan="2" class="pb-0 bb-0 pt-0 bt-0">
                    <div class="collapse" id="collapse{{$app['_id']}}">
                        <div class="well mt-10">
                            <table>
                                @foreach($app->logs as $key => $log)
                                    <tr>
                                        <td class="col-12 pt-0 pb-0" colspan="3">
                                            <div  aria-labelledby="headingOne">
                                                <div class="card-body pt-10 pb-0 down-arrow-card">
                                                
                                                    <div class="down-card-left clr-red">Server</div>
                                                    <div class="down-card-mid">:</div>
                                                    <div class="down-card-right">{{$log->getServers->name}}</div>

                                                    <div class="down-card-left clr-red">Impact</div>
                                                    <div class="down-card-mid">:</div>
                                                    <div class="down-card-right">{{$log['impact']}}</div>

                                                    <div class="down-card-left clr-red">Down Time</div>
                                                    <div class="down-card-mid">:</div>
                                                    <?php 
                                                        if($timezone == 'IST'){
                                                            $d_time2 = $log['app_down_time'];  
                                                            $d_time = date('d-m-y H:i',strtotime($d_time2));
                                                        }else{
                                                            $down_time = new DateTime($log['app_down_time']);
                                                            $down_time->setTimezone($tz);   
                                                            $d_time2 = $down_time->format('F j Y H:i:s');
                                                            $d_time = date('d-m-y H:i',strtotime('+1 hour',strtotime($d_time2)));
                                                        }
                                                    ?>
                                                    <div class="down-card-right">{{$d_time}}</div>

                                                    <div class="down-card-left clr-red">Expected Up Time</div>
                                                    <div class="down-card-mid">:</div>
                                                    <?php 
                                                        if($timezone == 'IST'){
                                                            $e_time2 = $log['expected_up_time']; 
                                                            $e_time = date('d-m-y H:i',strtotime($e_time2));     
                                                        }else{
                                                            $expected_up_time = new DateTime($log['expected_up_time']);
                                                            $expected_up_time->setTimezone($tz);    
                                                            $tmp = $expected_up_time->format('F j Y H:i:s');
                                                            $e_time = date('d-m-y H:i',strtotime('+1 hour',strtotime($tmp)));     
                                                        }
                                                        
                                                    ?>

                                                    <div class="down-card-right">{{$e_time}}</div>
                                                    <div class="down-card-left clr-red">Remarks</div>
                                                    <div class="down-card-mid">:</div>
                                                    <div class="down-card-right">{{$log['remarks']}}</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
            @endif 
            @endforeach
        </tbody>
    </table>

    {{----------------------------Service Status-------------------------------}}
    <h1 class="clr-red mt-20 mb-20">Services</h1>
    <table id="table_id" class="table table-hover display nowrap" style="width:100%">
        <thead class="bg-red">
            <tr>
                <th class="font-midium tlt-left"><strong>Program</strong></th>
                <th class="font-midium tlt-right"><strong>Status</strong></th>
            </tr>
        </thead>

        <tbody class="b-lbr">
            @foreach($service_list as $key => $app)

            <tr>
                <td class="tlt-left"><span>{{$app['name']}}</span></td>
                @if($app->logs->isEmpty())
                <td class="tlt-right">
                    <span class="text-success">Healthy</span>
                </td>
                @else
                <td>
                    <i class="fas fa-chevron-circle-down fa-lg red" data-toggle="collapse" data-target="#collapse{{$app['_id']}}" aria-expanded="true" aria-controls="collapse{{$app['log_id']}}"aria-hidden="true"></i>
                </td>
                @endif
            </tr>
            @if($app->logs->isNotEmpty())
            <tr>
                <td colspan="2" class="pb-0 bb-0 pt-0 bt-0">
                    <div class="collapse" id="collapse{{$app['_id']}}">
                        <div class="well mt-10">
                            <table>
                                @foreach($app->logs as $key => $log)
                                    <tr>
                                        <td class="col-12 pt-0 pb-0" colspan="3">
                                            <div  aria-labelledby="headingOne">
                                                <div class="card-body pt-10 pb-10 down-arrow-card">
                                                
                                                    <div class="down-card-left clr-red">Server</div>
                                                    <div class="down-card-mid">:</div>
                                                    <div class="down-card-right">{{$log->getServers->name}}</div>

                                                    <div class="down-card-left clr-red">Impact</div>
                                                    <div class="down-card-mid">:</div>
                                                    <div class="down-card-right">{{$log['impact']}}</div>

                                                    <div class="down-card-left clr-red">Down Time</div>
                                                    <div class="down-card-mid">:</div>
                                                    <?php 
                                                        if($timezone == 'IST'){
                                                            $d_time2 = $log['app_down_time'];  
                                                            $d_time = date('d-m-y H:i',strtotime($d_time2));
                                                        }else{
                                                            $down_time = new DateTime($log['app_down_time']);
                                                            $down_time->setTimezone($tz);   
                                                            $d_time2 = $down_time->format('F j Y H:i:s');
                                                            $d_time = date('d-m-y H:i',strtotime('+1 hour',strtotime($d_time2)));
                                                        }
                                                    ?>

                                                    <div class="down-card-right">{{$d_time}}</div>
                                                    <div class="down-card-left clr-red">Expected Up Time</div>
                                                    <div class="down-card-mid">:</div>
                                                    <?php 
                                                        if($timezone == 'IST'){
                                                            $e_time2 = $log['expected_up_time']; 
                                                            $e_time = date('d-m-y H:i',strtotime($e_time2));     
                                                        }else{
                                                            $expected_up_time = new DateTime($log['expected_up_time']);
                                                            $expected_up_time->setTimezone($tz);    
                                                            $tmp = $expected_up_time->format('F j Y H:i:s');
                                                            $e_time = date('d-m-y H:i',strtotime('+1 hour',strtotime($tmp)));     
                                                        }
                                                    ?>
                                                    <div class="down-card-right">{{$e_time}}</div>

                                                    <div class="down-card-left clr-red">Remarks</div>
                                                    <div class="down-card-mid">:</div>
                                                    <div class="down-card-right">{{$log['remarks']}}</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
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
    $("#countries").change(function() {
        var timezone = $("#countries").val();
        var url = FULL_PATH +'/'+timezone;
        window.location.href = url;
    });
</script>
@endsection

