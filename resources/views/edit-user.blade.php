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
                <h4 class="m-0">User Control</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">User Control</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="card mx-auto card-primary center" style="width:70%;">
    <div class="card-header">
        <h3 class="card-title">User Details</h3>
    </div>
    @csrf
    <div class="card-body">
        <form action="/editid/{{ collect(request()->segments())->last() }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="staff_id">Staff ID</label>
                <div class="input-group">
                    <input type="text" class="form-control width100" id="staff_id" placeholder="Enter ID" name="staff_id" maxlength="255" size="35" value="{{ $user->staff_id }}" required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary" style="margin-left:10px"><b>Edit</b></button>
                    </span>
                </div>
            </div>
        </form>
        <form action="/editname/{{ collect(request()->segments())->last() }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <div class="input-group">
                    <input type="text" class="form-control width100" id="name" placeholder="Enter Name" name="name" maxlength="255" size="35" value="{{ $user->name }}" required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary" style="margin-left:10px"><b>Edit</b></button>
                    </span>
                </div>
            </div>
        </form>
        <form action="/editemail/{{ collect(request()->segments())->last() }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Email</label>
                <div class="input-group">
                    <input type="email" class="form-control width100" placeholder="Enter Email" id="email" name="email" value="{{ $user->email }}" required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary" style="margin-left:10px"><b>Edit</b></button>
                    </span>
                </div>
            </div>
        </form>
        <form action="/editpassword/{{ collect(request()->segments())->last() }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="name">Change Password:</label>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Enter Password" id="password" name="password" required>
                <span class="input-group-btn" id="eyeSlash">
                    <button class="btn btn-default reveal" onclick="visibility3()" type="button"><i style="font-size:14px" class="fa fa-eye-slash" aria-hidden="true"></i></button>
                </span>
                <span class="input-group-btn" id="eyeShow" style="display: none;">
                    <button class="btn btn-default reveal" onclick="visibility3()" type="button"><i style="font-size:14px" class="fa fa-eye" aria-hidden="true"></i></button>
                </span>
                <span class="input-group-btn">
                    <button type="submit" style="margin-left:10px" class="btn btn-warning"><b>Change Password</b></button>
                </span>
            </div>
        </form>
    </div>
</div>

@endsection