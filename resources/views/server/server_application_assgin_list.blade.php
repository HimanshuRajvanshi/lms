@extends('dashboard.layouts.app')

@section('content')
<div class="right_col" role="main">
    <b>Add Server</b><br><br>
        <table id="table_id" class="display">
        <thead>
            <tr>
                <th>#</th>
                <th>Server Name</th>
                <th>Type</th>
                <th>Status</th>
                <th>Server Down At</th>
                <th>Server Up At</th>
                {{-- <th>Total Down Time</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        <?php //dd($servers) ?>

        @foreach($assigns as $key => $assign)
            <tbody>
                <tr>
                <td>{{$key++}}</td> 
                <td>{{$assign->getServers->name}}</td>    
                <td>{{$assign->getApplications->name}}</td>    
                <td>
                    <a href="#"><i class="far fa-edit"></i></a>
                    <a href="#"><i class="fas fa-eye"></i></a>
                    <i class="fas fa-trash-alt"></i>
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