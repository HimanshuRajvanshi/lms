@extends('dashboard.layouts.app')

@section('content')

@php
 $users=Session::get('user');
 $role_name=$users['user']->getRole->name;
@endphp

<div class="right_col" role="main">
   <div class="col-md-12 col-sm-12 col-xs-12">
     <div class="x_panel">
        <table id="DataTable" class="table table-striped table-bordered sorting_desc">
           <thead>
              <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Leave Type</th>
                <th>Leave From</th>
                <th>Leave To</th>
                {{-- <th>Total Days</th> --}}
                <th>Reason</th>
                <th>Mobile</th>
                <th style="width:40px;">Action</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @if(count($apply_leaves))
          @foreach($apply_leaves as $key => $apply_leave)
        @php $key++ @endphp
          <tr>
            <td>{{$key++}}</td>
            <td>{{$apply_leave->getUserName->name}}</td>
            <td>{{$apply_leave->getLeaveType->leave_name}}</td>
            <td>{{$apply_leave->leave_start_date}}</td>
            <td>{{$apply_leave->leave_end_date}}</td>
            {{-- <td>{{$apply_leave->total_days}}</td> --}}
            <td>{{ str_limit($apply_leave->leave_reason, $limit = 50, $end = '...') }}</td>
            {{-- <td>{{$apply_leave->phone}}</td> --}}
            <td>{{$apply_leave->phone}}</td>
            {{-- <td>{{date('d-M-Y',strtotime($apply_leave->created_at))}}</td> --}}
            <td> <a href="{{route('edit_leave',$apply_leave->id)}}"><button type="button" class="btn btn-info btn-sm"><i class="far fa-edit"></i>
            </button></a></td>
            <td> 
                @if($role_name == 'Admin')
                    @if($apply_leave->is_status == 'Pending')
                        <button type="button" class="btn btn-danger btn-sm" onclick="leaveStatus('{{$apply_leave->id}}','REJECTED')">Reject</button>
                        <button type="button" class="btn btn-success btn-sm" onclick="leaveStatus('{{$apply_leave->id}}','APPROVED')">Approve</button>
                    @else
                        @if($apply_leave->is_status == 'Rejected')
                            <button type="button" class="btn btn-danger btn-sm" style="cursor:not-allowed;">Rejected</button>
                        @else
                            <button type="button" class="btn btn-success btn-sm" style="cursor:not-allowed;">Approved</button>
                        @endif 
                    @endif    
                @else
                    @if($apply_leave->is_status == 'Pending')
                        <button type="button" class="btn btn-info btn-sm" style="cursor:not-allowed;">Pending</button>
                        @else
                            @if($apply_leave->is_status == 'Rejected')
                                <button type="button" class="btn btn-danger btn-sm" style="cursor:not-allowed;">Rejected</button>
                            @else
                                <button type="button" class="btn btn-success btn-sm" style="cursor:not-allowed;">Approved</button>
                            @endif 
                    @endif    
                @endif  
             </td>
            </tr>
            @endforeach    
        </tbody>
        @endif
    </table>
</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready( function () {
        // console.log("testing");
        $('#DataTable').DataTable();
    });

       function leaveStatus(id,type){
         var baseUrl = FULL_PATH+"/leave/status/update/"+id +'/'+type;     
           $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : baseUrl,
                type: "GET",
                success: function(response){
                    console.log(response);
                    // if(response.status == 'success'){
                    //     toastr.success(response.message);  
                        
                    //     setTimeout(function(){
                    //         window.location.reload(); 
                    //     }, 2500);
                    // }else{
                    //     toastr.error(response.message);
                    // }   
                }
                // ,error: function (data) {
                //     alert("Oops!",data.error_message, "error");
                // }
            });
        }

  </script>
@endsection        


