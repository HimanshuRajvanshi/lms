@extends('dashboard.layouts.app')

@section('content')
<div class="right_col" role="main">
    <!---Form Start--->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
            <h2>{{$txt}} Company <small>fill all company details</small></h2>
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
              
              {!! Form::open(array('url' => route('post_company'),'method'=>'POST', 'id'=>'post_company','name'=>'post_company','class'=>"form-horizontal form-label-left" ,'enctype'=>'multipart/form-data')) !!}
                 {!! csrf_field() !!}
                 
                 @if(isset($company))  
                  <input type="hidden" name="cId" id="cId" value="{{$company->_id}}"/> 
                 @endif

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Name <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <p class="form-control-static has-feedback{{ $errors->has('company_name') ? ' has-error' : '' }}">  
                          {!! Form::text('company_name', isset($company) ? $company->company_name:old('company_name'), array("id" => "company_name", 'placeholder' => 'Enter company code','class' => 'form-control col-md-7 col-xs-12')) !!}
                      </p> 
                    </div>
                </div>
                 
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Gst Number <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <p class="form-control-static has-feedback{{ $errors->has('gst_number') ? ' has-error' : '' }}">
                    {!! Form::text('gst_number', isset($company) ? $company->gst_number:old('gst_number'), array("id" => "gst_number", 'placeholder' => 'Enter company code','class' => 'form-control col-md-7 col-xs-12')) !!}
                      </p>      
                  </div>
                </div>

                <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <p class="form-control-static has-feedback{{ $errors->has('address') ? ' has-error' : '' }}">
                    {!! Form::text('address', isset($company) ? $company->address:old('address'), array("id" => "address", 'placeholder' => 'Enter address code','class' => 'form-control col-md-7 col-xs-12')) !!}
                      </p>    
                  </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Head Branch</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="radio">
                            <p class="form-control-static has-feedback{{ $errors->has('is_head_quarter') ? ' has-error' : '' }}">
                            <label><input type="radio" class="flat" value="No" checked name="is_head_quarter"> No</label>
                            <label><input type="radio" class="flat" value="Yes" name="is_head_quarter"> Yes</label>
                            </p>
                        </div>
                    </div>
                  </div>
                    
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
  {!! JsValidator::formRequest('App\Http\Requests\AddCompanyRequest', '#post_company'); !!}
@endsection


  