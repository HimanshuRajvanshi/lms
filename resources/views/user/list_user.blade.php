@extends('dashboard.layouts.app')

@section('content')
<div class="right_col" role="main">
      <!-- page content -->
            <div class="">
              <div class="page-title">
                <div class="title_left">
                  <h3>User List</h3>
                </div>
    
                <div class="title_right">
                  <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search employee...">
                      <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
    
              <div class="row">
                <div class="col-md-12">
                  <div class="x_panel">
                    <div class="x_content">
                     
                      @if(count($users))   
                       <div class="row">
                        {{-- <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
                          <ul class="pagination pagination-split">
                            <li><a href="#">A</a>
                            </li>
                            <li><a href="#">B</a>
                            </li>
                            <li><a href="#">C</a>
                            </li>
                            <li><a href="#">D</a>
                            </li>
                            <li><a href="#">E</a>
                            </li>
                            <li>...</li>
                            <li><a href="#">W</a>
                            </li>
                            <li><a href="#">X</a>
                            </li>
                            <li><a href="#">Y</a>
                            </li>
                            <li><a href="#">Z</a>
                            </li>
                          </ul>
                        </div>
                        <div class="clearfix"></div> --}}
                        
                        
                        @foreach ($users as $user)
                        <div class="col-md-4 col-sm-4 col-xs-12 animated fadeInDown">
                          <div class="well profile_view">
                            <div class="col-sm-12">
                            <h4 class="brief"><i>{{$user->userDepartments->department_name ?? 'Admin'}}</i></h4>
                              <div class="left col-xs-7">
                              <h2>{{$user->name}}</h2>
                                <p><strong>About: </strong> {{$user->designation}} </p>
                                <ul class="list-unstyled">
                                  <li><i class="fa fa-phone"></i> Mobile: {{$user->contact_number ?? 'na'}}</li>
                                  <li><i class="fa fa-envelope"></i> Address: {{$user->email}}</li>      
                                  <li><i class="fa fa-home"></i> Address: {{$user->present_address}}</li>
                                </ul>
                              </div>
                              <div class="right col-xs-5 text-center">
                                  @if($user->photo ==null)
                                  <img src="{{ URL::to('backEnd/images/user.png') }}" alt="" class="img-circle img-responsive img_setting" style="height: 100px;width:100px" >
                                 @else
                                   <img src="{{ asset('profile/')}}/{{$user->photo}}" alt="" class="img-circle img-responsive img_setting" style="height: 100px;width:100px">
                                 @endif
                              </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">
                              <div class="col-xs-12 col-sm-6 emphasis">
                                <p class="ratings">
                                    user Id: {{$user->user_code}}
                                </p>
                              </div>
                              <div class="col-xs-12 col-sm-6 emphasis">
                                <a href="skype:live:rtripathi@trilasoft.com?chat"><button type="button" class="btn btn-success btn-xs"> <i class="fa fa-phone"></i> Call  </button></a>
                                <a href="{{route('user_profile_view',base64_encode($user->_id))}}"> <button type="button" class="btn btn-primary btn-xs"> <i class="fa fa-user"></i> View Profile </button></a>
                              </div>
                            </div>
                          </div>
                        </div>
    
                        @endforeach
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

@endsection                


@section('script')

@endsection                

