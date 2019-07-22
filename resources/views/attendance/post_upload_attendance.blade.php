@extends('dashboard.layouts.app')
@section('content')
<div class="right_col" role="main">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Attendance file uploader</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-togglechoices/form_upload.htmlchoices/form_upload.html="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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

                  <p>Please upload only txt file.</p>
                  {{-- <form action="post_attendance" class="dropzone dz-clickable" style="border: 1px solid #e5e5e5; height: 150px; "> --}}
                    <form action="post_attendance" method="post" enctype="multipart/form-data">
                      {!! csrf_field() !!}
                      
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Upload Attendance sheet</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="file" id="file" required/>
                        </div>
                      </div><br><br>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>

                      
                     </form> 
                {{-- <button type="button" class="btn btn-primary">Upload</button> --}}
                   <br/>
                  <br/>
                 <br/>
                 <br/>
               </div>
              </div>
            </div>
          </div>
        </div>
    </div>

@endsection