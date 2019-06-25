<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Assign Server</h4>
</div>

<?php 
$types = ['Application'=>'Application', 'Service'=>'Service'];
?>


{!! Form::open(array('url' => route('assign_server_program'),'method'=>'POST', 'id'=>'assign_server_program','name'=>'assign_server_program','class'=>"form-horizontal
      form-label-left" ,'enctype'=>'multipart/form-data')) !!} {!! csrf_field() !!} 
<div class="modal-body">
      
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Type <span class="required">*</span></label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <select id="type" name="type" class="form-control" required>
          <option value="">-- Select Type --</option>
          @foreach ($types as $key=>$val)
          <?php 
            $selected = "";
            if($val == $type)
              $selected = 'selected';
            ?>
          <option value="{{$val}}"  {{$selected}} >{{$val}}</option>  
          @endforeach
       
              </select>
      </div>
    </div>

    <div class="form-group">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Program Name <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" name="program_name" id="assign_program_name" value="{{$program_name}}" class="form-control" autocomplete="off" placeholder="program_name"
            required/>
        </div>
      </div>

      <div class="form-group">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Environment <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" name="environment" id="assign_environment" value="{{$environment}}" class="form-control" autocomplete="off" placeholder="Enter Environment"
            required/>
        </div>
      </div>


      <div class="form-group">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
        <textarea name="description" id="description" class="form-control" autocomplete="off" rows="5" placeholder="Description"
        required><?php $val=str_replace('-','/',$description); echo $val; ?> 
        </textarea>
        </div>
      </div>

      <input type="hidden" name="program_id" value="{{$program_id}}">
      <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Server <span class="required">*</span></label>
      <div class="col-md-6 col-sm-6 col-xs-12">
          <div class=".checkbox-inline">
            
            @if(!empty($app_servers))
              @foreach ($servers as $server)
                @if (in_array($server->_id, $app_servers))
                  <input checked="checked" type="checkbox" name="server[]" value="{{$server->_id}}" class="custom-control-input" id="{{$server->_id}}">
                  @else
                  <input type="checkbox" name="server[]" value="{{$server->_id}}" class="custom-control-input" id="{{$server->_id}}">
                  @endif
                  <label class="custom-control-label" for="{{$server->_id}}">{{$server->name}}</label>    
              @endforeach
              @else
                @foreach ($servers as $server)
                  <input type="checkbox" name="server[]" value="{{$server->_id}}" class="custom-control-input" id="{{$server->_id}}">
                  <label class="custom-control-label" for="{{$server->_id}}">{{$server->name}}</label>    
              @endforeach 
              @endif
              
          </div>
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
</form>

