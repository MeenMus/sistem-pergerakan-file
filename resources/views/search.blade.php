@extends('layouts.admin')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Search Results</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Search Results</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card mx-auto" style="width:97%;">
    <div class="card-header">
        <h3 class="card-title">File Details</h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-head-fixed text-nowrap" style="width: 100%;" id="table" data-sort-name="name" data-sort-order="desc">
            <thead>
                <tr>
                    <th data-field="id" data-sortable="true">ID</th>
                    <th data-field="existing_file_number" data-sortable="true">File Number (Existing)</th>
                    <th data-field="file_number" data-sortable="true">File Number</th>
                    <th data-field="student_name" data-sortable="true">Student Name</th>
                    <th data-field="student_metric" data-sortable="true">Student Metric</th>
                    <th data-field="student_ic" data-sortable="true">Student IC</th>
                    <th data-field="file_status" data-sortable="true">Status</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($files as $file)
                <tr>
                    <td>{{ $file->id }}</td>
                    <td>{{ $file->existing_file_number }}</td>
                    <td style="font-weight:bold; font-size:18px"><a href="/file-page/{{ $file->id }}">{{ $file->file_number }}</a></td>
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







@endsection