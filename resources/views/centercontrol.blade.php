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
  button:hover {
    background-color: #D1D0CE;
  }
</style>

<div class="content-header" style="height:56px">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0">Center Control</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Center Control</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div style="margin-left: 15px; margin-bottom: 60px; margin-top: 5px;">
  <form action="/createcenter" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="button mr-1" style="float: left;">
      <button type="button" class="btn" style="background-color: #B048B5; color:white;" data-toggle="modal" data-target="#centerModal"><b>Create Center</b></button>
    </div>
    <div class="modal fade" id="centerModal" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="centerModalLabel">Center Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @if($errors->any())
            <center style="font-size:16px; color:red; font-weight:bold; padding-bottom:12px;">{{$errors->first()}}</center>
            @endif
            <div class="form-group">
              <label for="code">Center Code</label>
              <input type="text" class="form-control" id="code" placeholder="Enter code" name="code" maxlength="5" size="35" required>
            </div>
            <div class="form-group">
              <label for="name">Center Name</label>
              <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" maxlength="255" size="35" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <form action="/editcenter" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="button mr-1" style="float: left;">
      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal"><b>Edit Center</b></button>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Center Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @if($errors->any())
            <center style="font-size:16px; color:red; font-weight:bold; padding-bottom:12px;">{{$errors->first()}}</center>
            @endif
            <div class="form-group">
              <label for="code">Choose center to edit:</label>
              <select class="form-control select2bs4 select2-hidden-accessible" name="code" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" required>
                <option value="">-Choose Center-</option>
                @foreach($centers as $center)
                <option value="{{$center->code}}">[{{$center->code}}] {{$center->name}}</option>
                @endforeach
                <span class="select2 select2-container select2-container--bootstrap4 select2-container--below" dir="ltr" data-select2-id="1" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false" aria-labelledby="select2-st75-container"><span class="select2-selection__rendered" id="select2-st75-container" role="textbox" aria-readonly="true"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
              </select>
            </div>
            <div class="form-group">
              <label for="code_edit">Edit Code</label>
              <input type="text" class="form-control" id="edit_code" placeholder="Enter code" name="edit_code" value = "{{$center->code}}" maxlength="5" size="35" required>
            </div>
            <div class="form-group">
              <label for="name_edit">Edit Name</label>
              <input type="text" class="form-control" id="edit_name" placeholder="Enter name" name="edit_name" maxlength="255" size="35" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit center?\nThis will edit FILES associating with the center');">Edit</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>


<div class="card mx-auto" style="width:97%;">
  <div class="card-header">
    <h3 class="card-title">Center Details</h3>
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
  <div class="card-body table-responsive p-0" style="max-height: 390px;">
    <table class="table table-head-fixed text-nowrap table-striped" style="width: 100%;">
      <thead>
        <tr>
          <th>Center Code</th>
          <th>Center Name</th>
        </tr>
      </thead>
      <tbody id="myTable">
        @foreach ($centers as $center)
        <tr>
          <td>{{ $center->code }}</td>
          <td>{{ $center->name }}</td>
          <td>
            <form action="/deletecenter" method="POST" enctype="multipart/form-data">
              @csrf
              <button type="submit" class="btn btn-primary-outline" style="font-size:17px; margin-bottom:-13px; margin-top:-13px" name="code" value="{{ $center->code }}" onclick="return confirm('Are you sure you want to delete center?');"><i class="fas fa-trash-alt text-muted"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection