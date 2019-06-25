@extends('dashboard.layouts.app')

@section('content')
<div class="right_col" role="main">
    <div class="">
      <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>{{$header_txt}} <small>fill all fields</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br/>

                {!! Form::open(array('url' => route('post_user'),'method'=>'POST', 'id'=>'post_add_employee','name'=>'post_add_employee','class'=>"form-horizontal form-label-left" ,'enctype'=>'multipart/form-data')) !!}
                 {!! csrf_field() !!}

                 @if(isset($user))  
                  <input type="hidden" name="empId" id="empId" value="{{$user->id}}"/> 
                 @endif

                 <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Department <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        
                     <select id="department_Id" name="department_Id" class="form-control">
                       <option value="">--- Select ---</option>
                          @foreach ($departments as $department)
                             <option value="{{$department->_id}}">{{$department->department_name}}</option>
                            @endforeach
                        </select>
                         </div>
                      </div>
 
                   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">User Code <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <p class="form-control-static has-feedback{{ $errors->has('user_code') ? ' has-error' : '' }}">  
                        {!! Form::text('user_code', isset($user) ? $user->user_code:old('user_code'), array("id" => "user_code", 'placeholder' => 'Enter employee code','class' => 'form-control col-md-7 col-xs-12')) !!}
                        </p>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Joining <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <p class="form-control-static has-feedback{{ $errors->has('date_of_join') ? ' has-error' : '' }}">
                            <input id="date_of_join" name="date_of_join" class="date-picker form-control col-md-7 col-xs-12" autocomplete="off" >
                          </p>    
                          </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <p class="form-control-static has-feedback{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            {!! Form::text('first_name', isset($user) ? $user->first_name:old('first_name'), array("id" => "first_name", 'placeholder' => 'Enter first name','class' => 'form-control col-md-7 col-xs-12')) !!}
                          </p>  
                      </div>
                    </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <p class="form-control-static has-feedback{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        {!! Form::text('last_name', isset($user) ? $user->last_name:old('last_name'), array("id" => "last_name", 'placeholder' => 'Enter last name','class' => 'form-control col-md-7 col-xs-12')) !!}
                      </p>  
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <p class="form-control-static has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">   
                      {!! Form::email('email', isset($user) ? $user->email:old('email'), array("id" => "email", 'placeholder' => 'Enter email','class' => 'form-control col-md-7 col-xs-12')) !!}
                      </p>  
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <p class="form-control-static has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">  
                        {!! Form::password('password', array("id" => "password", 'placeholder' => 'Enter password','class' => 'form-control col-md-7 col-xs-12')) !!}
                      </p>  
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <p>
                      Male: <input type="radio" class="flat" name="gender" id="genderM" value="Male" checked="" required /> 
                      Female: <input type="radio" class="flat" name="gender" id="genderF" value="Female" />
                    </p>
                    </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="date_of_birth" name="date_of_birth" class="form-control col-md-7 col-xs-12" placeholder="Select your dob" type="text" autocomplete="off" value="10/24/1984">
                      </div>
                   </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_number">Contact Number <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <p class="form-control-static has-feedback{{ $errors->has('contact_number') ? ' has-error' : '' }}">  
                        {!! Form::number('contact_number', isset($user) ? $user->contact_number:old('contact_number'), array("id" => "contact_number", 'placeholder' => 'Enter contact number','class' => 'form-control col-md-7 col-xs-12')) !!}
                      </p>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="emergency_number">Emergency Number <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <p class="form-control-static has-feedback{{ $errors->has('emergency_number') ? ' has-error' : '' }}">
                        {!! Form::number('emergency_number', isset($user) ? $user->emergency_number:old('emergency_number'), array("id" => "emergency_number", 'placeholder' => 'Enter emergency number','class' => 'form-control col-md-7 col-xs-12')) !!}
                        </p>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="designation">Designation <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <p class="form-control-static has-feedback{{ $errors->has('designation') ? ' has-error' : '' }}">
                            {!! Form::text('designation', isset($user) ? $user->designation:old('designation'), array("id" => "designation", 'placeholder' => 'Enter designation','class' => 'form-control col-md-7 col-xs-12')) !!}
                          </p>    
                          </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="emergency_number">Present Address<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <p class="form-control-static has-feedback{{ $errors->has('present_address') ? ' has-error' : '' }}">
                            {!! Form::textarea('present_address', isset($user) ? $user->present_address:old('present_address'), array("id" => "present_address", 'placeholder' => 'Enter present address','class' => 'form-control col-md-7 col-xs-12' ,"style"=>'height:70px;padding-top: 7px;')) !!}
                          </p>  
                          </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Same as above</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="checkbox" name="address_same" id="address_same" /> Same
                        </div>
                    </div>
                        
                        
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="emergency_number">Permanent Address <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <p class="form-control-static has-feedback{{ $errors->has('permanent_address') ? ' has-error' : '' }}">
                            {!! Form::textarea('permanent_address', isset($user) ? $user->permanent_address:old('permanent_address'), array("id" => "permanent_address", 'placeholder' => 'Enter premanent address','class' => 'form-control col-md-7 col-xs-12' ,"style"=>'height:70px;padding-top: 7px;')) !!}
                          </p>  
                          </div>
                    </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="emergency_number">User Status<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="user_status" name="user_status" class="form-control">
                            <option value="">--- Select ---</option>
                            <option value="Probation">Probation</option>
                            <option value="Confirmed">Confirmed</option>
                          </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="emergency_number">Role<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="role_id" name="role_id" class="form-control">
                          <option value="">--- Select Role---</option>
                            @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                   
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="emergency_number">Photo</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="image" id="image" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button type="reset" class="btn btn-primary">Cancel</button>
                      <button type="submit" name="submit" id="submit" class="btn btn-success" >{{$button}}</button>
                    </div>
                  </div>
                  {!! Form::close() !!}

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection                


@section('script')
  {!! JsValidator::formRequest('App\Http\Requests\AddUserRequest', '#post_add_employee'); !!}

    <script type="text/javascript">
      $(document).ready(function() {
        //for Date of Join Date show into UI
        $('#date_of_join').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4"
         }, function(start, end, label) {
        });

        //for copy present address as premanent address
        $('#address_same').change(function() {
          $('#address_same').val($(this).is(':checked'));
            permanent_address.value =  present_address.value;
          });
        });

        //for Date of brith this use
        $(function() {
            $('input[name="date_of_birth"]').daterangepicker({
              singleDatePicker: true,
              showDropdowns: true,
              minYear: 1901,
              maxYear: parseInt(moment().format('YYYY'),10)
            }, function(start, end, label) {
              // var years = moment().diff(start, 'years');
              // alert("You are " + years + " years old!");
            });
          });
    </script>

    
@endsection