@extends('dashboard.layouts.app')

@section('content')

<div class="right_col" role="main">
  <div class="col-md-12 col-sm-12 col-xs-12">
     {{-- <div class="x_panel"> --}}
        <h2>Department List</h2><br>
           <table id="DataTable" class="table table-striped table-bordered sorting_desc">
                <thead class="bg-primary">
                    <tr>
                        <th>Id</th>
                        <th>Department Name</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach($departments  as $key=> $department)
                <tbody class="table-bordered">
                    <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$department->department_name}}</td>
                    <td>{{$department->location}}</td>
                    <td>
                    <a href="{{url('add/department',$department->_id)}}"><i class="far fa-edit"></i></a>
                    {{-- <i class="fas fa-eye"></i> --}}
                        {{-- <i class="fas fa-trash-alt"></i> --}}
                    </td>
                    </tr>
                    
                </tbody>
                @endforeach
            </table>
        {{-- </div>    --}}

        
    </div>   
</div>
@endsection


@section('script')
<script>
    $(document).ready( function () {
        $('#DataTable').DataTable({});
    });
</script>
@endsection











