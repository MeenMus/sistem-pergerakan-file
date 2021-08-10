@extends('layouts.admin')
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
                <h1 class="m-0">View Unarchived Log</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">View Unarchived Log</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card mx-auto" style="width:97%;">
    <div class="card-header">
        <h3 class="card-title">Files Details</h3>
        <div class="card-tools">
            <div class="input-group input-group-sm" style="padding-top:7px">
                <input type="text" name="table_search" class="form-control float-right" id="myInput" onkeyup="myFunction()" placeholder="Search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-tools" style="position: relative; padding-right:170px; font-size:15px;">
            <select class="select2bs4" name="code" style="width:450px;" id="dynamic_select">
                <option value="/view-unarchive-file/all-files">-All Archives-</option>
                @foreach($centers as $center)
                <option value="/view-unarchive-file/{{$center->code}}" {{ collect(request()->segments())->last() == $center->code ? 'selected="selected"' : '' }}>[{{$center->code}}] {{$center->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="card-body table-responsive p-0" style="max-height: 421px;">
        <table class="table table-head-fixed text-nowrap" style="width: 100%;" id="table" data-sort-name="name" data-sort-order="desc" data-pagination="true" data-page-size="6" data-pagination-parts="['pageInfo', 'pageList']">
            <thead>
                <tr>
                    <th data-field="archive_number" data-sortable="true">Archive Number</th>
                    <th data-field="archive_id" data-sortable="true">File Number</th>
                    <th data-field="created_at" data-sortable="true">Purpose</th>
                    <th data-field="total" data-sortable="true">Unarchived At</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($files as $file)
                <tr>
                    <td style="font-weight:bold; font-size:18px"><a href="/view-archive-file/{{ $file->archiveid->id }}">{{ $file->archiveid->archive_number }}</a></td>
                    <td style="font-weight:bold; font-size:18px"><a href="/file-page/{{ $file->fileid->id }}">{{ $file->fileid->file_number }}</a></td>
                    <td>{{ $file->purpose }}</td>
                    <td>{{ $file->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection