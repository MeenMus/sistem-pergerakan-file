@extends('layouts.user')
@section('content')

<style>
    .fixed-table-pagination {
        padding-right: 10px;
        padding-left: 10px;
    }
</style>

<style>
    button:hover {
        background-color: #D1D0CE;
    }
</style>

<div class="content-header" style="height:56px">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Your Files</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Files</li>
            </ol>
        </div>
    </div>
</div>

<div class="card mx-auto">
    <div class="card-header">
        <h3 class="card-title" style="font-size:22px">File Details</h3>
        <div class="card-tools">
            <div class="input-group input-group-sm" style="padding-top:7px">
                <input type="text" name="table_search" class="form-control float-right" id="myInput" onkeyup="myFunction()" placeholder="Search">
                <div class="input-group-append">
                    <span class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-tools" style="position: relative; padding-right:170px; font-size:15px;">
            <select class="select2bs4" name="code" style="width:450px;" id="dynamic_select">
                <option value="/home/all-files">-All Files-</option>
                @foreach($centers as $center)
                <option value="/home/{{$center->code}}" {{ collect(request()->segments())->last() == $center->code ? 'selected="selected"' : '' }}>[{{$center->code}}] {{$center->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-head-fixed text-nowrap" style="width: 100%;" id="table" data-sort-name="name" data-sort-order="desc" data-pagination="true" data-page-size="6" data-pagination-parts="['pageInfo', 'pageList']">
            <thead>
                <tr>
                    <th data-field="file_number" data-sortable="true">File Number</th>
                    <th data-field="student_name" data-sortable="true">Student Name</th>
                    <th data-field="student_metric" data-sortable="true">Student Metric</th>
                    <th data-field="student_ic" data-sortable="true">Student IC</th>
                    <th data-field="purpose" data-sortable="true">Purpose</th>
                    <th data-field="return_date" data-sortable="true">Return Date</th>
                    <th data-field="status" data-sortable="true">Status</th>
                    <th data-field="updated_at" data-sortable="true">Date Time</th>
                    <th>Cancel</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($files as $file)
                <tr>
                    <td>{{ $file->file->file_number }}</td>
                    <td>{{ $file->file->student_name }}</td>
                    <td>{{ $file->file->student_metric }}</td>
                    <td>{{ $file->file->student_ic }}</td>
                    <td>{{ $file->purpose }}</td>
                    <td>{{ $file->return_date }}</td>
                    <td>{{ $file->status }}</td>
                    <td>{{ $file->updated_at }}</td>
                    <td>
                        <form action="/cancelapp" method="POST" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" class="btn btn-primary-outline" style="font-size:17px;" name="id" value="{{ $file->id }}" onclick="return confirm('Are you sure you want to cancel application?');" {{ $file->status  != "NEW" ? 'disabled="disabled"' : '' }}><i class="fas fa-minus-circle text-muted"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection