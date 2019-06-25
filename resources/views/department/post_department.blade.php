@extends('dashboard.layouts.app')

@section('content')
<div class="right_col" role="main">
    <!---Form Start--->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
            <h2>{{$txt}} Department <small>fill all company details</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                  </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              {!! Form::open(array('url' => route('post_Department'),'method'=>'POST', 'id'=>'post_department','name'=>'post_department','class'=>"form-horizontal form-label-left" ,'enctype'=>'multipart/form-data')) !!}
                 {!! csrf_field() !!}
                 
                 @if(isset($department))  
                  <input type="hidden" name="departmentId" id="departmentId" value="{{$department->_id}}"/> 
                 @endif

                 <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Company Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="comany_id" name="comany_id" class="form-control"> 
                            <option value="">-- Select Company Name --</option>
                            @foreach ($companys as $company)
                                <option value="{{$company->_id}}">{{$company->company_name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>    

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Department Name <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <p class="form-control-static has-feedback{{ $errors->has('department_name') ? ' has-error' : '' }}"> 
                      {!! Form::text('department_name', isset($department) ? $department->department_name:old('department_name'), array("id" => "department_name", 'placeholder' => 'Enter company code','class' => 'form-control col-md-7 col-xs-12')) !!}
                      </p>  
                    </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Location <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                   <p class="form-control-static has-feedback{{ $errors->has('location') ? ' has-error' : '' }}"> 
                    {!! Form::text('location', isset($department) ? $department->location:old('location'), array("id" => "location", 'placeholder' => 'Enter Location code','class' => 'form-control col-md-7 col-xs-12')) !!}
                   </p> 
                  </div>
                </div>

                {{-- <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('address', isset($department) ? $department->address:old('address'), array("id" => "address", 'placeholder' => 'Enter address code','class' => 'form-control col-md-7 col-xs-12','required')) !!}
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
  {!! JsValidator::formRequest('App\Http\Requests\AddDepartmentRequest', '#post_department'); !!}
@endsection
