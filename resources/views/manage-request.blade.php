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
        <h1 class="m-0">Requested Files</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Check Out Files</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="card mx-auto" style="width:97%;">
  <div class="card-header">
    <h3 class="card-title">Applicant Details</h3>
    <div class="card-tools">
      <div class="input-group input-group-sm">
        <input type="text" name="table_search" class="form-control float-right" id="myInput" onkeyup="myFunction()" placeholder="Search">
        <div class="input-group-append">
          <button type="submit" class="btn btn-default">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body table-responsive p-0" style="max-height: 438px;">
    <table class="table table-head-fixed text-nowrap" style="width: 100%;" id="table" data-sort-order="desc" data-pagination="true" data-page-size="6" data-pagination-parts="['pageInfo', 'pageList']">
      <thead>
        <tr>
          <th data-sortable="true">Applicant ID</th>
          <th data-sortable="true">Applicant Name</th>
          <th data-sortable="true">Email</th>
          <th data-sortable="true" data-sorter="linksSorter">Files</th>
        </tr>
      </thead>
      <tbody id="myTable">
        @foreach ($files as $file)
        <tr>
          <td>{{ $file->applicant_id }}</td>
          <td>{{ $file->applicant_name }}</td>
          <td>{{ $file->email }}</td>
          <td><a href="/manage-checkout/{{ collect(request()->segments())->last() }}/{{$file->applicant_id}}" style="font-weight:bold; font-size:20px;">{{ $file->total }}</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection