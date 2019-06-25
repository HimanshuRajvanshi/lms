@extends('dashboard.layouts.app')

@section('content')
<?php 
$index = 1;
?>
<div class="right_col" role="main">
        
    <table id="table_id" class="table table-hover table-striped">
        <thead class="bg-primary">
            <tr>
                <th>Id</th>
                <th>Company Name</th>
                <th>GST Number</th>
                <th>Address</th>
                <th>Create Date</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach($companys as  $company)
            <tbody class="table-bordered">
                <tr>
                <td>{{$index}}</td>
                <td>{{$company->company_name}}</td>
                <td>{{$company->gst_number}}</td>
                <td>{{$company->address}}</td>
                <td>{{$company->created_at}}</td>
                <td>
                    <a href="{{route('edit_company',$company->_id)}}"><i class="far fa-edit"></i></a>
                    <a href="{{route('view_company_department',$company->_id)}}"><i class="fas fa-eye"></i></a>
                    {{-- <i class="fas fa-trash-alt"></i> --}}
                </td>
                </tr>
                
            </tbody>
            <?php
            $index++;
            ?>
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