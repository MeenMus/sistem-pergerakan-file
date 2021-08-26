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
    .fixed-table-pagination {
        padding-right: 10px;
        padding-left: 10px;
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Applications Log</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Applications Log</li>
                </ol>
            </div>
        </div>
    </div>
</div>

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
                <option value="/applications-log/all-files">-All Files-</option>
                @foreach($centers as $center)
                <option value="/applications-log/{{$center->code}}" {{ collect(request()->segments())->last() == $center->code ? 'selected="selected"' : '' }}>[{{$center->code}}] {{$center->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="card-body table-responsive p-0" style="max-height: 421px;">
        <table class="table table-head-fixed text-nowrap" style="width: 100%;" id="table" data-sort-name="name" data-sort-order="desc" data-pagination="true" data-page-size="6" data-pagination-parts="['pageInfo', 'pageList']">
            <thead>
                <tr>
                    <th data-field="applicant_id" data-sortable="true"> ID</th>
                    <th data-field="applicant_name" data-sortable="true">Applicant Name</th>
                    <th data-field="email" data-sortable="true">Applicant Email</th>
                    <th data-field="file_number" data-sortable="true">File Number</th>
                    <th data-field="status" data-sortable="true">Status</th>
                    <th data-field="purpose" data-sortable="true">Purpse</th>
                    <th data-field="created_at" data-sortable="true">Date Time</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($files as $file)
                <tr>
                    <td>{{ $file->applicant_id}}</td>
                    <td>{{ $file->applicant_name }}</td>
                    <td>{{ $file->email }}</td>
                    <td style="font-weight:bold; font-size:18px"><a href="/file-page/{{ $file->file->id }}">{{ $file->file->file_number }}</a></td>
                    <td>{{ $file->status }}</td>
                    <td>{{ $file->purpose }}</td>
                    <td>{{ $file->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection