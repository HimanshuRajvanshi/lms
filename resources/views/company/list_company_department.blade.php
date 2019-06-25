@extends('dashboard.layouts.app')

@section('content')
<div class="right_col" role="main">
        
    <table id="table_id" class="table table-hover table-striped">
        <thead class="bg-primary">
            <tr>
                <th>Id</th>
                <th>Company Name</th>
                <th>Department Name</th>
                <th>Location</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach($departments as $key => $department)
            <tbody class="table-bordered">
                <tr>
                <td>{{$key+1}}</td>
                <td>{{$department->getDepartment->company_name}}</td>
                <td>{{$department->department_name}}</td>
                <td>{{$department->location}}</td>
                <td>{{$department->status}}</td>
                <td>
                    {{-- <a><i class="far fa-edit"></i></a> --}}
                    <a><i class="fas fa-eye"></i></a>
                    {{-- <i class="fas fa-trash-alt"></i> --}}
                </td>
                </tr>
                
            </tbody>

            @endforeach
        </table>
    </div>
@endsection


@section('script')
<script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
@endsection