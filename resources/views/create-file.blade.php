@php
if(auth()->user()->role_id == 1) {
$layoutDirectory = 'layouts.superadmin';
} else {
$layoutDirectory = 'layouts.admin';
}
@endphp

@extends($layoutDirectory)
@section('content')

<div class="content-header" style="height:56px">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0">Create File</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Create File</li>
        </ol>
      </div>
    </div>
  </div>
</div>


<div class="card mx-auto card-primary center" style="width:70%;">
  <div class="card-header">
    <h3 class="card-title" style="margin-top:10px;">File Details</h3>
    <h3 class="card-title float-right"><button class="btn btn-success" data-toggle="modal" data-target="#fileModal" style="background-color:#16CC32; font-weight:bold;">Excel Import</button></h3>
  </div>
  <form action="create-file" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body" style="height:440px">
      <div class="form-group">
        <label>Center</label>
        <select class="form-control select2bs4 select2-hidden-accessible" name="code" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" required>
          <option value="">-Choose Center-</option>
          @foreach($centers as $center)
          <option value="{{$center->code}}">[{{$center->code}}] {{$center->name}}</option>
          @endforeach
          <span class="select2 select2-container select2-container--bootstrap4 select2-container--below" dir="ltr" data-select2-id="1" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false" aria-labelledby="select2-st75-container"><span class="select2-selection__rendered" id="select2-st75-container" role="textbox" aria-readonly="true"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
        </select>
      </div>
      <div class="form-group">
        <label for="student_name">Student Name</label>
        <input type="text" class="form-control" id="student_name" placeholder="Enter name" name="student_name" maxlength="255" size="35" required>
      </div>
      <div class="form-group">
        <label for="student_metric">Metric Number</label>
        <input type="text" class="form-control" id="student_metric" placeholder="Enter number" name="student_metric" maxlength="255" size="35" required>
      </div>
      <div class="form-group">
        <label for="student_ic">Identification Card</label>
        <input type="text" class="form-control" id="student_ic" placeholder="Enter IC number" name="student_ic" maxlength="14" size="35" required>
      </div>
      <div class="form-group">
        <label for="existing_file_number">Existing File Number (Optional)</label>
        <input type="text" class="form-control" id="existing_file_number" placeholder="Enter File Number" name="existing_file_number" maxlength="255" size="35">
      </div>
    </div>
    <div class="card-footer">
      <center style="padding-right:20px;"><button style="width:100px;" type="submit" class="btn btn-primary">Create File</button></center>
    </div>
  </form>
</div>

<form action="importfile" method="post" enctype="multipart/form-data">
  @csrf
  <div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="fileModalLabel">Excel Upload</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <a href={{ asset('dist/file/student_files.xlsx') }}><button type="button" class="btn btn-warning" style="font-weight:bold; margin-bottom:10px">DOWNLOAD TEMPLATE</button></a>
          </div>
          <div class="form-group">
            <label for="code">Choose files center:</label>
            <select class="form-control select2bs4 select2-hidden-accessible" name="code" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true" required>
              <option value="">-Choose Center-</option>
              @foreach($centers as $center)
              <option value="{{$center->code}}">[{{$center->code}}] {{$center->name}}</option>
              @endforeach
              <span class="select2 select2-container select2-container--bootstrap4 select2-container--below" dir="ltr" data-select2-id="1" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false" aria-labelledby="select2-st75-container"><span class="select2-selection__rendered" id="select2-st75-container" role="textbox" aria-readonly="true"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
            </select>
          </div>
          <div class="form-group">
            <input type="file" accept=".xlsx" style="padding-bottom:20px; padding-top:25px;" name="student_files" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>



@endsection