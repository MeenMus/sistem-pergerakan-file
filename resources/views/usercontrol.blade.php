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

<div style="margin-left: 15px; margin-bottom: 60px; margin-top: 5px;">
    <form action="/createuser" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="button mr-1" style="float: left;">
            <button type="button" class="btn" style="background-color: #B048B5; color:white;" data-toggle="modal" data-target="#userModal"><b>Create User</b></button>
        </div>
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">User Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if($errors->any())
                        <center style="font-size:16px; color:red; font-weight:bold; padding-bottom:12px;">{{$errors->first()}}</center>
                        @endif
                        <div class="form-group">
                            <label for="staff_id">Staff ID</label>
                            <input type="text" class="form-control" id="staff_id" placeholder="Enter ID" name="staff_id" maxlength="255" size="35" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" maxlength="255" size="35" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" required>
                        </div>
                        <label for="name">Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Enter Password" id="password" name="password" required>
                            <span class="input-group-btn" id="eyeSlash">
                                <button class="btn btn-default reveal" onclick="visibility3()" type="button"><i style="font-size:14px" class="fa fa-eye-slash" aria-hidden="true"></i></button>
                            </span>
                            <span class="input-group-btn" id="eyeShow" style="display: none;">
                                <button class="btn btn-default reveal" onclick="visibility3()" type="button"><i style="font-size:14px" class="fa fa-eye" aria-hidden="true"></i></button>
                            </span>
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
</div>

<div class="card mx-auto" style="width:97%;">
    <div class="card-header">
        <h3 class="card-title">User Details</h3>
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
                    <th>Staff ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($users as $user)
                <tr>
                    <td style="padding-top:19px">{{ $user->staff_id }}</td>
                    <td style="padding-top:19px">{{ $user->name }}</td>
                    <td style="padding-top:19px">{{ $user->email }}</td>
                    <td style="padding-top:19px">{{ $user->roleid->name }}</td>
                    <td>
                        <form action="/rolecontrol" method="POST" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" class="btn btn-block" name="id[]" value="{{ $user->id }}">
                                @if($user->role_id == '3')
                                <b style="color:green;">Make Admin</b>
                                @else
                                <b style="color:blue;">Dismiss Admin</b>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="/deleteuser" method="POST" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" class="btn btn-primary-outline" style="font-size:17px;" name="id" value="{{ $user->id }}" onclick="return confirm('Are you sure you want to delete user?\nThis will delete all applications associating with the user.');"><i class="fas fa-trash-alt text-muted"></i></button>
                            <input type="hidden" name="staff_id" value="{{ $user->staff_id }}">
                        </form>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary-outline" style="font-size:17px;" onclick="window.location.href='/edit-user/{{ $user->id }}'"><i class="fas fa-edit text-muted"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection