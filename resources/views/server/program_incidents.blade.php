@extends('dashboard.layouts.app')

@section('content')
<div class="right_col" role="main">
    <button type="submit"  class="btn btn-primary" data-toggle="modal" data-target="#log_program_incident">Log Program Incident</button>
    
        <table id="table_id" class="table table-hover table-striped ">
        <thead class="bg-primary">
            <tr>
                
                <th>Program Name</th>
                <th>Server Name</th>
                <th>Remarks</th>
                <th>Impact</th>
                <th>Reason</th>
                <th>Application Down At</th>
                <th>Expected Up Time</th>
                <th>Actual Up Time</th>
                {{-- <th>Total Down Time</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        
        <tbody class="table-bordered">
        @foreach($programs as $key => $program)
              <?php if($program->incident_status == true){
                $class = 'text-danger';
              }  else{
                $class = 'text-success';
              }
              ?>
              <tr class="{{$class}}">
                <td>{{$program->getPrograms->name}}</td>       
                <td>{{$program->getServers->name}}</td>       
                <td>{{$program->remarks}}</td>                           
                <td>{{$program->impact}}</td>
                <td>{{$program->reason}}</td>
                <td>{{$program->app_down_time}}</td>
                <td>{{$program->expected_up_time}}</td>
                <td>{{$program->actual_up_time}}</td>
                <td>
                  @if($program->actual_up_time == null)
                    <i class="fa fa-edit" data-toggle="modal" data-id="{{ $program->_id }}" data-expected-time="{{$program->expected_up_time}}" data-title="{{ $program->_id }}" data-target="#edit_program_incident"></i>
                  @else
                      <i class="fa fa-check" aria-hidden="true"></i>
                  @endif
                </td>
                </tr>
                
            
            @endforeach
        </tbody>
        </table>
        {{ $programs->links() }}

</div>

{{-- ==============================Log Incident popup================================== --}}
<div class="modal fade" id="log_program_incident" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Log Program Incidents</h4>
      </div>
      <div class="modal-body">
          {!! Form::open(array('url' => route('post_server_program_log'),'method'=>'POST', 'id'=>'post_server_program_log','name'=>'post_server_program_log','class'=>"form-horizontal
          form-label-left" ,'enctype'=>'multipart/form-data')) !!} {!! csrf_field() !!} 

          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Program <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="program_id" name="program_id" class="form-control" required>
                        <option value="">-- Select Program--</option>
                        @foreach ($program_list as $program)
                            <option value="{{$program->_id}}">{{$program->name}}</option>
                        @endforeach
                    </select>
            </div>
          </div>

          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Server <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="server_id" name="server_id" class="form-control" required>
                  <option>Select </option>
              </select>
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Impact <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
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
              <select id="reason" name="reason" class="form-control" required>
                      <option value="">-- Select Reason --</option>
                        <option value="Maintenance">Maintenance</option>
                       <option value="Error">Error</option>
                       <option value="Slowness">Slowness</option>
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
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Remarks <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!! Form::text('remarks', isset($company) ? $company->remarks:old('remarks'), array("id" => "remarks", 'placeholder'
              => 'Enter remarks here','class' => 'form-control col-md-7 col-xs-12','required')) !!}
            </div>
          </div>
    </div>
    <div class="modal-footer">
      <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="reset" data-dismiss="modal" class="btn btn-primary">Cancel</button>
            <button type="submit" class="btn btn-success">{{$btn}}</button>
          </div>
        </div>
    </div>
  </form>    
      </div>
    </div>
  </div>
</div>
{{-- ==============================Log Incident popup================================== --}}

{{-- ==============================Edit Incident popup================================== --}}
<div class="modal fade" id="edit_program_incident" role="dialog" aria-labelledby="editProgramIncident">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit Program Incidents</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => route('edit_server_program_log'),'method'=>'POST', 'id'=>'edit_server_program_log','name'=>'edit_server_program_log','class'=>"form-horizontal
                form-label-left" ,'enctype'=>'multipart/form-data')) !!} {!! csrf_field() !!} 
                
                <input type="hidden" name="log_id" id="log_id" class="form-control" autocomplete="off" placeholder="Expected Up Time" required/>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Impact <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="impact" name="impact" class="form-control" required>
                            <option value="">-- Select Impact --</option>
                              <option value="Major">Major</option>
                             <option value="Minor">Minor</option>
                         </select>
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Incident Resolve <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="radio" name="resolve" value="yes" onClick="IncidentResolvefn('yes')"> Yes<br>
                        <input type="radio" name="resolve" value="no" onClick="IncidentResolvefn('no')"> No<br>
                    </div>
                  </div>
      
                <div class="form-group ActualUpTime" style="display: none;" id="ActualUpTime">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Actual Up Time <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="actual_up_time" id="actual_up_time" class="form-control" autocomplete="off" placeholder="Actual Up Time"
                        />
                    </div>
                </div>


                <div class="form-group ExpectedUpTime" style="display:none" id="ExpectedUpTime">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Expected Up Time <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="expected_up_time" id="expected_up_time" class="form-control" autocomplete="off" placeholder="Expected Up Time"
                      />
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Remarks <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('remarks', isset($company) ? $company->remarks:old('remarks'), array("id" => "remarks", 'placeholder'
                    => 'Enter remarks here','class' => 'form-control col-md-7 col-xs-12','required')) !!}
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="reset" data-dismiss="modal" class="btn btn-primary">Cancel</button>
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
                </div>
            </div>
      </div>
  </div>
</div>  

{{-- ==============================Edit Incident popup================================== --}}

@endsection

@section('script')
  {!! JsValidator::formRequest('App\Http\Requests\LogProgramIncidentRequest', '#post_server_program_log'); !!}

<script>
    
  $(document).ready(function() {
    $('input[name="app_down_time"]').daterangepicker({
      minDate: moment(),
      timePicker: true,
      singleDatePicker: true,
      autoUpdateInput: false,
      minDate: 0, 
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
      minDate: 0, 
      minTime: 0,
      startDate: moment().startOf('hour'),
      locale: {
        format: 'M/DD/YYYY hh:mm A'
      }
    });

    $('input[name="expected_up_time"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('M/DD/YYYY hh:mm A'));
    });

    $('input[name="actual_up_time"]').daterangepicker({
      minDate: moment(),
      timePicker: true,
      singleDatePicker: true,
      autoUpdateInput: false,
      minDate: 0, 
      minTime: 0,
      startDate: moment().startOf('hour'),
      locale: {
        format: 'M/DD/YYYY hh:mm A'
      }
    });

    $('input[name="actual_up_time"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('M/DD/YYYY hh:mm A'));
    });

    //$('#table_id').DataTable();
  });
  
  $(document).on("click", ".fa-edit", function() {
    var log_id = $(this).data("id");
    $("#log_id").val(log_id);
  });

  /**
    *For Get Program Id to Server name
  **/
  $(document).on("change", "#program_id", function() {
    var program_id = $(this).val();
    var url = FULL_PATH+'/assigned/program/server/'+program_id;
   
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json'
    })

   .done(function(data){
    console.log(data);
    $('#server_id').empty();

    if(data.data.length != 0){
      for (var j = 0; j < data.data.length; j++){                 
        // alert(data.data[j].get_servers.name);
        $('<option/>', {
          'value': data.data[j].get_servers._id,
          'text': data.data[j].get_servers.name
          }).appendTo('#server_id');
      }     
    }else{
      $('<option/>', {
          'value': '',
          'text':'No server assign'
          }).appendTo('#server_id');
    }
  })
    .fail(function(){
        alert('Something going wrrong!');
    });
  });

//Incident Resolve To show and hide time
function IncidentResolvefn(typ){
  if(typ == 'yes'){
    document.getElementById('ActualUpTime').style.display = 'block';
    document.getElementById('ExpectedUpTime').style.display = 'none';
  }else{
    document.getElementById('ActualUpTime').style.display = 'none';
    document.getElementById('ExpectedUpTime').style.display = 'block';
  }
}


</script>
@endsection