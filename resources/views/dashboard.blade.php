@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$data['filenum']}}</h3>
            <p style="font-size:19px">Student Files</p>
          </div>
          <div class="icon">
            <i class="fa fa-file fa-fw"></i>
          </div>
          <a href="/view-file/all-files" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$data['request']}}</h3>
            <p style="font-size:19px">Requested Files</p>
          </div>
          <div class="icon">
            <i class="fa fa-file-export"></i>
          </div>
          <a href="/manage-request/all-files" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$data['unreturned']}}</h3>
            <p style="font-size:19px">Unreturned Files</p>
          </div>
          <div class="icon">
            <i class="fa fa-file-import fa-fw"></i>
          </div>
          <a href="/manage-unreturned/all-files" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$data['archived']}}</h3>
            <p style="font-size:19px">Archived Files</p>
          </div>
          <div class="icon">
            <i class="fa fa-file-archive fa-fw"></i>
          </div>
          <a href="/view-archive/all-files" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <div class="card" style="width: 33.5rem;">
          <div class="card-header border-0">
            <h3 class="card-title">Latest Request</h3>
          </div>
          <div class="card-body table-responsive p-0" style="height: 269px;">
            <table class="table table-striped table-valign-middle table-head-fixed">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>File</th>
                  <th>Center</th>
                  <th style="width:10px;">More</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($app_request as $applicant)
                <tr>
                  <td>{{ $applicant->applicant_name }}</td>
                  <td><a href="/file-page/{{ $applicant->file->id }}"><b>{{ $applicant->file->file_number }}</b></a></td>
                  <td>[{{ $applicant->center->code}}] {{ $applicant->center->name->name}}</td>
                  <td style="text-align:center">
                    <a href="/manage-checkout/{{ $applicant->center->code}}/{{ $applicant->applicant_id }}" class="text-muted">
                      <i class="fas fa-search"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card" style="width: 33.5rem;">
          <div class="card-header border-0">
            <h3 class="card-title">Latest Check Out</h3>
          </div>
          <div class="card-body table-responsive p-0" style="height: 269px;">
            <table class="table table-striped table-valign-middle table-head-fixed">
              <thead>
                <tr>
                  <th>Applicant ID</th>
                  <th>File</th>
                  <th>Center</th>
                  <th style="width:10px;">More</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($app_unreturned as $applicant)
                <tr>
                  <td>{{ $applicant->applicant_id }}</td>
                  <td><a href="/file-page/{{ $applicant->file->id }}"><b>{{ $applicant->file->file_number }}</b></a></td>
                  <td>[{{ $applicant->center->code}}] {{ $applicant->center->name->name}}</td>
                  <td style="text-align:center">
                    <a href="/manage-checkin/{{ $applicant->center->code}}/{{ $applicant->applicant_id }}" class="text-muted">
                      <i class="fas fa-search"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<span class = "navicon"></span>

@endsection