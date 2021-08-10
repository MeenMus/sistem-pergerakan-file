@extends('layouts.user')
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
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Request Files</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home/all-files">Home</a></li>
                <li class="breadcrumb-item active">Request Files</li>
            </ol>
        </div>
    </div>
</div>

<form class="request-form" action="/request-file" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-section">
        <div class="card mx-auto">
            <div class="card-header">
                <h3 class="card-title" style="font-size:22px">File Details</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="padding-top:7px">
                        <input type="text" name="table_search" class="form-control float-right" id="myInput" onkeyup="myFunction()" placeholder="Search">
                        <div class="input-group-append">
                            <span class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-tools" style="position: relative; padding-right:170px; font-size:15px;"> <select class="select2bs4" name="code" style="width:450px;" id="dynamic_select">
                        <option value="/request-file/all-files">-All Files-</option>
                        @foreach($centers as $center)
                        <option value="/request-file/{{$center->code}}" {{ collect(request()->segments())->last() == $center->code ? 'selected="selected"' : '' }}>[{{$center->code}}] {{$center->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body table-responsive p-0" style="max-height: 370px;">
                <table class="table table-head-fixed text-nowrap" id = "requestTable" style="width: 100%;">
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
                            <td style="padding-left:35px; padding-top:16px"><input type="checkbox" name="id[]" value="{{ $file->id }}" style="height:20px; width:20px;" {{  $file->filestatus->name != "AVAILABLE" ? 'disabled="disabled"' : '' }}></td>
                            <td>{{ $file->file_number }}</td>
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
                <h3 class="card-title">Request Details</h3>
            </div>
            <div class="card-body" style="height:185px">
                <div class="form-group">
                    <label class="control-label" for="date">Loan Purpose: </label>
                    <select class="form-control select2bs4 select2-hidden-accessible" name="purpose" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" required>
                        <option value="">-Select-</option>
                        <option value="Temporary Review">Temporary Review</option>
                        <option value="Graduate Application">Graduation Application</option>
                        <option value="Move File">Move File</option>
                        <option value="Discontinue">Discontinue</option>
                        <span class="select2 select2-container select2-container--bootstrap4 select2-container--below" dir="ltr" data-select2-id="1" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false" aria-labelledby="select2-st75-container"><span class="select2-selection__rendered" id="select2-st75-container" role="textbox" aria-readonly="true"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="date">Return Date: </label>
                    <div class="input-group date" name="return_date" id="return_date" data-target-input="nearest">
                        <input class="form-control" id="date" name="date" placeholder="YYYY/MM/DD" type="text" required>
                        <div class="input-group-append" data-target="date" data-toggle="date">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-navigation">
        <button type="button" class="next btn btn-info btn-primary float-right" style="font-size:18px;">Next</button>
        <center>
            <div style="width:50%">
                <button type="button" class="previous btn btn-info btn-primary float-left" style="font-size:18px;">Previous</button>
                <button type="submit" class="btn btn-success btn-primary float-right" name="value" value='1' style="font-size:18px;">Request Files</button>
            </div>
        </center>
    </div>
</form>



@endsection