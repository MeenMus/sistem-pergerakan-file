@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Create Center</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Create Center</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="card mx-auto card-primary center" style="width:70%;">
  <div class="card-header">
    <h3 class="card-title">Center Details</h3>
  </div>
  <form action="create-center" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body" style="height:185px">
      <div class="form-group">
        <label for="code">Center Code</label>
        <input type="text" class="form-control" id="code" placeholder="Enter code" name="code" maxlength="5" size="35" required>
      </div>
      <div class="form-group">
        <label for="name">Center Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" maxlength="255" size="35" required>
      </div>
    </div>
    <div class="card-footer">
      <center><button type="submit" class="btn btn-primary">Create Center</button></center>
    </div>
  </form>
</div>

@endsection