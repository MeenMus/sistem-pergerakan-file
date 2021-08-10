@extends('layouts.admin')
@section('content')

<div class="content-header" style="height:56px">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0">Edit File</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Edit File</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="card mx-auto card-primary center" style="width:70%;">
  <div class="card-header">
    <h3 class="card-title">File : <b>{{$file->file_number}}</b></h3>
  </div>
  <form method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="existing_file_number">Existing File Number (Optional)</label>
        <input type="text" class="form-control" id="existing_file_number" value = "{{$file->existing_file_number}}" placeholder="Enter File Number" name="existing_file_number" maxlength="255" size="35">
      </div>
      <div class="form-group">
        <label for="student_name">Student Name</label>
        <input type="text" class="form-control" id="student_name" value = "{{$file->student_name}}" placeholder="Enter name" name="student_name" maxlength="255" size="35" required>
      </div>
      <div class="form-group">
        <label for="student_metric">Metric Number</label>
        <input type="text" class="form-control" id="student_metric" value = "{{$file->student_metric}}" placeholder="Enter number" name="student_metric" maxlength="255" size="35" required>
      </div>
      <div class="form-group">
        <label for="student_ic">Identification Card</label>
        <input type="text" class="form-control" id="student_ic" value = "{{$file->student_ic}}" placeholder="Enter IC number" name="student_ic" maxlength="14" size="35" required>
      </div>
    </div>
    <div class="card-footer">
      <center style = "padding-right:20px;"><button style ="width:100px; font-size:18px" type="submit" class="btn btn-primary">Edit File</button></center>
    </div>
  </form>
</div>

@endsection