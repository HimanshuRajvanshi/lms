@extends('dashboard.layouts.app') 
@section('content')
<div class="right_col" role="main">
  <!---Form Start--->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>{{$txt}} Server Program Incident <small>fill all details</small></h2>

          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br /> {!! Form::open(array('url' => route('post_server_log'),'method'=>'POST', 'id'=>'post_leave_apply','name'=>'post_leave_apply','class'=>"form-horizontal
          form-label-left" ,'enctype'=>'multipart/form-data')) !!} {!! csrf_field() !!} @if(isset($company))
          <input type="hidden" name="postServerId" id="postServerId" value="{{$company->_id}}" /> @endif

          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Program <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="program_id" name="program_id" class="form-control" required>
                        <option value="">-- Select Program--</option>
                        @foreach ($programs as $program)
                            <option value="{{$program->_id}}">{{$program->name}}</option>
                        @endforeach
                    </select>
            </div>
          </div>

          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Server <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="server_id" name="server_id" class="form-control" required>
                       <option value="">-- Select Server --</option>
                        @foreach ($servers as $server)
                           <option value="{{$server->_id}}">{{$server->name}}</option>
                        @endforeach
                    </select>
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Impact <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{-- {!! Form::text('impact', isset($company) ? $company->impact:old('impact'), array("id" => "impact", 'placeholder' =>
              'Enter impact code','class' => 'form-control col-md-7 col-xs-12','required')) !!} --}}
              <select id="impact" name="impact" class="form-control" required>
                      <option value="">-- Select Impact --</option>
                        <option value="Major">Major</option>
                       <option value="Minor">Minor</option>
                   </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Reason <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{-- {!! Form::text('impact', isset($company) ? $company->impact:old('impact'), array("id" => "impact", 'placeholder' =>
              'Enter impact code','class' => 'form-control col-md-7 col-xs-12','required')) !!} --}}
              <select id="reason" name="reason" class="form-control" required>
                      <option value="">-- Select Reason --</option>
                        <option value="Maintenance">Maintenance</option>
                       <option value="Error">Error</option>
                   </select>
            </div>
          </div>

          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Program Down At <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="app_down_time" id="app_down_time" class="form-control" autocomplete="off" placeholder="Program Down At"
                required/>
            </div>
          </div>

          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Expected Up Time <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="expected_up_time" id="expected_up_time" class="form-control" autocomplete="off" placeholder="Expected Up Time"
                required/>
            </div>
          </div>

          <input type="hidden" name="downtime" id="downtime" />
          <input type="hidden" name="uptime" id="uptime" />

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!! Form::text('description', isset($company) ? $company->description:old('description'), array("id" => "description", 'placeholder'
              => 'Enter Description code','class' => 'form-control col-md-7 col-xs-12','required')) !!}
            </div>
          </div>


          {{--
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Root Cause <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!! Form::text('root_cause', isset($company) ? $company->root_cause:old('root_cause'), array("id" => "root_cause", 'placeholder'
              => 'Enter Root Cause ','class' => 'form-control col-md-7 col-xs-12','required')) !!}
            </div>
          </div> --}}


          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="reset" class="btn btn-primary">Cancel</button>
              <button type="submit" class="btn btn-success">{{$btn}}</button>
            </div>
          </div>

          </form>
        </div>
      </div>
    </div>
  </div>


  <!---Form End--->
</div>
@endsection
 
@section('script')
<script>
  $(function() {
    $('input[name="app_down_time"]').daterangepicker({
      minDate: moment(),
      timePicker: true,
      singleDatePicker: true,
      autoUpdateInput: false,
      minDate: +2,  // disable past date
      minTime: 0,
      startDate: moment().startOf('hour'),
      locale: {
        format: 'M/DD/YYYY hh:mm A'
      }
    });


    $('input[name="app_down_time"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('M/DD/YYYY hh:mm A'));
    });

    $('input[name="expected_up_time"]').daterangepicker({
      minDate: moment(),
      timePicker: true,
      singleDatePicker: true,
      autoUpdateInput: false,
      startDate: moment().startOf('hour'),
      locale: {
        format: 'M/DD/YYYY hh:mm A'
      }
    });


    $('input[name="expected_up_time"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('M/DD/YYYY hh:mm A'));
    });

  });

</script>
@endsection