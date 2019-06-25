@extends('dashboard.layouts.app')

@section('content')
<div class="right_col" role="main">
    <button type="submit"  class="btn btn-primary" data-toggle="modal" data-target="#add_program">Add Program</button>
        <table id="table_id" class="table table-hover table-striped ">
        <thead class="bg-primary">
                <tr>
                    <th>#</th>
                    <th>Program Name</th>
                    <th>Type</th>
                    <th>Environment</th>
                    <th>Description</th>
                    {{-- <th>Create Date</th> --}}
                    <th>Action</th>
                </tr>
        </thead>
        <?php //dd($servers) ?>
        <tbody class="table-bordered">
        <?php $index = 1;?>    
        @foreach($programs as $key => $program)
        <tr>
            <td>{{$index}}</td>
            <td>{{$program->name}}</td>
            <td>{{$program->type}}</td>
            <td>{{$program->environment}}</td>
            <td>
              <?php
                  $val=str_replace('-','/',$program->description);
                  echo $val;
              ?>  
              
            </td>
            {{-- <td>{{$program->created_at}}</td> --}}
            <td>
              <i class="fas fa-edit fa-lg" id="map_program" data-target="#assign_server" data-url="server_list/{{$program->_id}}" data-toggle="modal"></i>
                  {{-- <i class="fas fa-eye"></i>
                  <i class="fas fa-trash-alt"></i> --}}
            </td>
        </tr>
        <?php $index++;?>
            @endforeach
        </tbody>
        </table>
        {{ $programs->onEachSide(1)->links() }}


</div>

{{-- ==============================Add Program popup================================== --}}
<div class="modal fade" id="add_program" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Program</h4>
        </div>
        {!! Form::open(array('url' => route('save_program'),'method'=>'POST', 'id'=>'save_program','name'=>'save_program','class'=>"form-horizontal
            form-label-left" ,'enctype'=>'multipart/form-data')) !!} {!! csrf_field() !!} 
  
        <div class="modal-body">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Type <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="type" name="type" class="form-control" required>
                        <option value="">-- Select Type --</option>
                          <option value="Application">Application</option>
                         <option value="Service">Service</option>
                     </select>
              </div>
            </div>
  
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Program Name <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="program_name" id="program_name" class="form-control" autocomplete="off" placeholder="Program Name"
                  required/>
              </div>
            </div>
            
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Environment <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="environment" id="environment" class="form-control" autocomplete="off" placeholder="Environment "
                  required/>
              </div>
            </div>


            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="description" id="description" class="form-control" autocomplete="off" placeholder="Description"
                  required></textarea>
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Server <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class=".checkbox-inline">
                    @foreach ($servers as $server)
                        <input type="checkbox" name="server[]" value="{{$server->_id}}" class="custom-control-input" id="{{$server->_id}}">
                        <label class="custom-control-label" for="{{$server->_id}}">{{$server->name}}</label>    
                    @endforeach
                </div>
              </div>
            </div>

        </div>
        <div class="modal-footer">
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="reset" data-dismiss="modal" class="btn btn-primary">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
          </div>
        </div>
        </form>    
        </div>
      </div>
    </div>
  </div>
  {{-- ==============================Add Program popup================================== --}}



  {{-- ==============================Map with Server popup================================== --}}
<div class="modal fade" id="assign_server" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content" id="dynamic-content">
        {{-- =================Server Assign Modal Placed here======================= --}}      
      </div>
    </div>
  </div>
  {{-- ==============================Map with Server popup================================== --}}

@endsection



@section('script')
{!! JsValidator::formRequest('App\Http\Requests\AddProgramRequest', '#save_program'); !!}
<script>
  $(document).ready(function(){
      $(document).on('click', '#map_program', function(e){
          e.preventDefault();
          var url = $(this).data('url');
          $('#dynamic-content').html(''); // leave it blank before ajax call
          $('#modal-loader').show();      // load ajax loader
  
          $.ajax({
              url: url,
              type: 'GET',
              dataType: 'html'
          })
          .done(function(data){
              $('#dynamic-content').html('');    
              $('#dynamic-content').html(data); // load response 
              $('#modal-loader').hide();        // hide ajax loader   
          })
          .fail(function(){
              $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
              $('#modal-loader').hide();
          });
      });
  });
</script>
    
@endsection