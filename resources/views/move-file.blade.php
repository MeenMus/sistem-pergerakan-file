@extends('layouts.admin')
@section('content')

<style>
    .form-section {
        display: none;
    }

    .form-section.current {
        display: inherit;
    }
</style>

<div class="content-header" style="height:56px">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">Move Files</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Move Files</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<form class="request-form" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-section">
    <div class="card mx-auto" style="width:97%;">
        <div class="card-header">
            <h3 class="card-title" style="padding-top:7px" ><b>Move files to : </b></h3>
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
            <select class="select2bs4" name="center_id" style="width:450px;" id = "center_id" required>
                <option value="">-Select Center-</option>
                @foreach($centers as $center)
                <option value="{{$center->code}}" {{ collect(request()->segments())->last() == $center->code ? 'disabled' : '' }}>[{{$center->code}}] {{$center->name}}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="card-body table-responsive p-0" style="max-height: 370px;">
            <table class="table table-head-fixed text-nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>File Number</th>
                        <th>Student Name</th>
                        <th>Student Metric</th>
                        <th>Student IC</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    @foreach ($files as $file)
                    <tr>
                        <td style="padding-left:35px; padding-top:16px"><input type="checkbox" name="id[]" value="{{ $file->id }}" style="height:20px; width:20px;"></td>
                        <td style="font-weight:bold; font-size:18px"><a href="/file-page/{{ $file->id }}">{{ $file->file_number }}</a></td>
                        <td>{{ $file->student_name }}</td>
                        <td>{{ $file->student_metric }}</td>
                        <td>{{ $file->student_ic }}</td>
                        <td>{{ $file->filestatus->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <div class="form-section" style="padding-top:30px;">
        <div class="card mx-auto card-primary center" style="width:50%; height:260px;">
            <div class="card-header">
                <h3 class="card-title">Movement Details</h3>
            </div>
            <div class="card-body" style="height:185px">
                <div class="form-group">
                    <label class="control-label" for="date">Movement Purpose: </label>
                    <select class="form-control select2bs4 select2-hidden-accessible" id = "select_purpose" name="purpose" style="width: 100%;"  tabindex="-1" aria-hidden="true" required>
                        <option value="">-Select-</option>
                        <option value="Student Movement">Student Movement</option>
                        <option value="Student Graduation">Student Graduation</option>
                        <option value= "1">Other</option>
                        <span class="select2 select2-container select2-container--bootstrap4 select2-container--below" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false" aria-labelledby="select2-st75-container"><span class="select2-selection__rendered"  role="textbox" aria-readonly="true"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                    </select>
                </div>
                <div class="form-group">
                    <label for="purpose">Other:</label>
                    <input type="text" class="form-control" id="other_purpose" placeholder="State Purpose" name="purpose" maxlength="255" size="35"  disabled="disabled" required>
                </div>
            </div>
        </div>
    </div>
    <div class="form-navigation">
        <div style ="padding-right:20px;" ><button type="button" style="width:80px; font-size:18px" class="next btn btn-info btn-primary float-right" style="font-size:18px;">Next</button></div>
        <center>
            <div style="width:50%">
                <button type="button" class="previous btn btn-info btn-primary float-left" style="font-size:18px;">Previous</button>
                <button type="submit" class="btn btn-success btn-primary float-right" style="font-size:18px;">Move Files</button>
            </div>
        </center>
    </div>
</form>


@endsection