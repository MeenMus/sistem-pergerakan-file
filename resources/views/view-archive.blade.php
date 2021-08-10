@extends('layouts.admin')
@section('content')

<style>
    .fixed-table-pagination {
        padding-right: 10px;
        padding-left: 10px;
    }
</style>

<div class="content-header" style="height:56px">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">View Archives</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">View Archives</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card mx-auto" style="width:97%;">
    <div class="card-header">
        <h3 class="card-title">Archive Details</h3>
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
                <option value="/view-archive/all-files">-All Archives-</option>
                @foreach($centers as $center)
                <option value="/view-archive/{{$center->code}}" {{ collect(request()->segments())->last() == $center->code ? 'selected="selected"' : '' }}>[{{$center->code}}] {{$center->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="card-body table-responsive p-0" style="max-height: 421px;">
        <table class="table table-head-fixed text-nowrap" style="width: 100%;" id="table" data-sort-name="name" data-sort-order="desc" data-pagination="true" data-page-size="5" data-pagination-parts="['pageInfo', 'pageList']">
            <thead>
                <tr>
                    <th data-field="id" data-sortable="true">ID</th>
                    <th data-field="archive_number" data-sortable="true">Archive Number</th>
                    <th data-field="created_at" data-sortable="true">Created At</th>
                    <th data-field="total" data-sortable="true">Files</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($archives as $archive)
                <tr>
                    <td>{{ $archive->archiveid->id }}</td>
                    <td>{{ $archive->archiveid->archive_number }}</td>
                    <td>{{ $archive->archiveid->created_at}}</td>
                    <td style="font-weight:bold; font-size:18px"><a href="/view-archive-file/{{ $archive->archiveid->id }}">{{ $archive->total }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<center style = "padding-right:20px"><button onclick="location.href = '/view-unarchive-file/all-files';" class="btn btn-primary">View Unarchived Log</button></center>

@endsection