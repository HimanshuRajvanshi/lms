@extends('dashboard.layouts.app')

@section('content')
<div class="right_col" role="main">
    {{-- <button type="submit"  class="btn btn-primary" data-toggle="modal" data-target="#add_server">Add Server</button> --}}
        <table id="table_id" class="table table-hover table-striped ">
        <thead class="bg-primary">
            <tr>
                <th>#</th>
                <th>Server Name</th>
                <th>Type</th>
                <th>Status</th>
                <th>Server Down At</th>
                <th>Server Up At</th>
            </tr>
        </thead>
        <?php $index = 1; ?>

        
            <tbody class="table-bordered">
                    @foreach($servers as $key => $server)
                <tr>
                <td>{{$index++}}</td>    
                <td>{{$server['server_name']}}</td>
                <td>{{$server['server_type']}}</td>
                <td>{{$server['server_status']}}</td>
                <td>{{$server['server_down_at']}}</td>
                <td>{{$server['server_up_at']}}</td>
                </tr>
                @endforeach    
            </tbody>
            
        </table>

</div>
@endsection


