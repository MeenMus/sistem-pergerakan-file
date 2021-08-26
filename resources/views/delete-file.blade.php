@php
if(auth()->user()->role_id == 1) {
$layoutDirectory = 'layouts.superadmin';
} else {
$layoutDirectory = 'layouts.admin';
}
@endphp

@extends($layoutDirectory)
@section('content')
<style>
    .form-section {
        display: none;
    }

    .form-section.current {
        display: inherit;
    }
</style>

<div class="content-header" style="height:56px">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">Delete Files</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Delete Files</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<form method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-section">
        <div class="card mx-auto" style="width:97%;">
            <div class="card-header">
                <h3 class="card-title">File Details</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="padding-top:7px; width:230px;">
                        <input type="text" name="table_search" class="form-control float-right" id="myInput" onkeyup="myFunction()" placeholder="Search by File/Name/Metric/IC">
                        <div class="input-group-append">
                            <span class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-tools" style="position: relative; padding-right:120px; font-size:15px;">
                    <select class="select2bs4" name="code" style="width:450px;" id="dynamic_select">
                        <option value="/delete-file/all-files">-All Files-</option>
                        @foreach($centers as $center)
                        <option value="/delete-file/{{$center->code}}" {{ collect(request()->segments())->last() == $center->code ? 'selected="selected"' : '' }}>[{{$center->code}}] {{$center->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body table-responsive p-0" style="max-height: 370px;">
                <table class="table table-head-fixed text-nowrap" id="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th data-sortable="true">Existing File Number</th>
                            <th data-sortable="true">File Number</th>
                            <th data-sortable="true">Student Name</th>
                            <th data-sortable="true">Student Metric</th>
                            <th data-sortable="true">Student IC</th>
                            <th data-sortable="true">Status</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach ($files as $file)
                        <tr>
                            <td style="padding-left:45px; padding-top:16px"><input type="checkbox" name="id[]" value="{{ $file->id }}" style="height:20px; width:20px;"></td>
                            <td>{{ $file->existing_file_number }}</a></td>
                            <td>{{ $file->file_number }}</a></td>
                            <td>{{ $file->student_name }}</td>
                            <td>{{ $file->student_metric }}</td>
                            <td>{{ $file->student_ic }}</td>
                            <td>{{ $file->filestatus->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div style="margin-right:20px;"><button type="submit" style="width:80px; font-size:18px" class="btn btn-danger float-right" style="font-size:18px;" onclick="return confirm('Are you sure you want to DELETE file?\nThis will DELETE EVERYTHING associating with the file.');">Delete</button></div>
</form>

@endsection