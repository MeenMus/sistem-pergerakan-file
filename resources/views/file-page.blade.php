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
    .dataTables_filter {
        margin-right: 10px;
        margin-top: 10px;
    }

    .dataTables_info {
        margin-top: -10px;
        margin-left: 10px;
    }

    #table1_paginate {
        margin-right: 10px;
        margin-bottom: 5px;
        margin-top: -5px;
    }

    #table2_paginate {
        margin-right: 10px;
        margin-bottom: 5px;
        margin-top: -5px;
    }
</style>

<style>
    button:hover {
        background-color: #D1D0CE;
    }
</style>

<div class="content-header" style="height:56px">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">Student File Page</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Student File Page</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div style="margin-left: 15px; margin-bottom: 60px; margin-top: 5px;">
    <div class="dropdown mr-1" style="float: left;">
        <form action="/manage-checkout/null/null" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" class="btn dropdown-toggle btn-success" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="brand-text font-weight-bold font-size-md"><b>Check Out</b></span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset" style="width:400px">
                @foreach($new as $new)
                <button type="submit" class="btn btn-block" style="text-align:left;" name="id[]" value="{{ $new->id }}">
                    <b>ID:</b> {{$new->applicant_id}}&emsp;<br><b>Name:</b> {{ $new->applicant_name }}&emsp;<br><b>Email:</b> {{ $new->email }}<br><b>Purpose:</b> {{ $new->purpose }}<br><b>Return Date:</b> {{ $new->return_date }}
                </button>
                <input type="hidden" name="value" value="1">
                <input type="hidden" name="value2" value="1">
                @endforeach
            </div>
        </form>
    </div>
    <div class="dropdown mr-1" style="float: left">
        <form action="/manage-checkin/null/null" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" class="btn dropdown-toggle btn-danger" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="brand-text font-weight-bold font-size-md"><b>Check In</b></span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset" style="width:400px">
                @foreach($checkedout as $checkedout)
                <button type="submit" class="btn btn-block" style="text-align:left;" name="id[]" value="{{ $checkedout->id }}">
                    <b>ID:</b> {{$checkedout->applicant_id}}&emsp;<br><b>Name:</b> {{ $checkedout->applicant_name }}&emsp;<br><b>Email:</b> {{ $checkedout->email }}<br><b>Purpose:</b> {{ $checkedout->purpose }}<br><b>Return Date:</b> {{ $checkedout->return_date }}
                </button>
                <input type="hidden" name="value" value="1">
                @endforeach
            </div>
        </form>
    </div>
    <div class="dropdown mr-1" style="float: left">
        <form action="/manage-checkout/null/null" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" class="btn dropdown-toggle btn-warning" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="brand-text font-weight-bold font-size-md"><b>Cancel</b></span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset" style="width:400px">
                @foreach($cancel as $cancel)
                <button type="submit" class="btn btn-block" style="text-align:left;" name="id[]" value="{{ $cancel->id }}">
                    <b>ID:</b> {{$cancel->applicant_id}}&emsp;<br><b>Name:</b> {{ $cancel->applicant_name }}&emsp;<br><b>Email:</b> {{ $cancel->email }}<br><b>Purpose:</b> {{ $cancel->purpose }}<br><b>Return Date:</b> {{ $cancel->return_date }}
                </button>
                <input type="hidden" name="value" value="0">
                <input type="hidden" name="value2" value="1">
                @endforeach
            </div>
        </form>
    </div>
    <div class="button mr-3" style="float: right;">
        @foreach ($file_number as $id)
        <button type="button" class="btn btn-primary" onclick="window.location.href='/edit-file/{{ $id->id }}'">
            <span class="brand-text font-weight-bold font-size-md"><b>Edit</b></span>
        </button>
        @endforeach
    </div>
    @foreach ($file_number as $id)
    <form action="/archive-file/{{ $id->center->name->code}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="button mr-1" style="float: left;">
            <button type="button" class="btn" style="background-color: #3A3B3C; color:white;" data-toggle="modal" data-target="#archiveModal" {{ $id->file_status == "3" ? 'disabled' : '' }}><b>Archive</b></button>
        </div>
        <div class="modal fade" id="archiveModal" tabindex="-1" role="dialog" aria-labelledby="archiveModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="archiveModalLabel">Archive Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="date">Archive into: </label>
                            <select class="form-control select2bs4 select2-hidden-accessible" id="archive_number" name="archive_id" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="null">NEW</option>
                                @foreach($archives as $archive)
                                <option value="{{$archive->id}}">{{$archive->archive_number}}</option>
                                @endforeach
                                <span class="select2 select2-container select2-container--bootstrap4 select2-container--below" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false" aria-labelledby="select2-st75-container"><span class="select2-selection__rendered" role="textbox" aria-readonly="true"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="existing_file_number">Archive Number (Optional):</label>
                            <input type="text" class="form-control" id="other_number" placeholder="Enter Archive Number" name="archive_id" maxlength="255" size="35" enabled="disabled">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="id[]" value="{{ $id->id }}">Archive File</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endforeach

    @foreach ($file_number as $id)
    <form action="/unarchive-file/{{ $id->center->name->code}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="button mr-1" style="float: left;">
            <button type="button" class="btn" style="background-color: #3A3B3C; color:white;" data-toggle="modal" data-target="#unarchiveModal" {{ $id->file_status != "3" ? 'disabled' : '' }}><b>Unarchive</b></button>
        </div>
        <div class="modal fade" id="unarchiveModal" tabindex="-1" role="dialog" aria-labelledby="unarchiveModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="unarchiveModalLabel">Unarchive Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="date">Unarchive Purpose: </label>
                            <select class="form-control select2bs4 select2-hidden-accessible" id="select_purpose" name="purpose" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">-Select-</option>
                                <option value="Reference">Reference</option>
                                <option value="1">Other</option>
                                <span class="select2 select2-container select2-container--bootstrap4 select2-container--below" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false" aria-labelledby="select2-st75-container"><span class="select2-selection__rendered" role="textbox" aria-readonly="true"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="unarchive_purpose">Other:</label>
                            <input type="text" class="form-control" id="other_purpose" placeholder="State Purpose" name="purpose" maxlength="255" size="35" disabled="disabled" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="id[]" value="{{ $id->id }}">Unarchive File</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endforeach

    @foreach ($file_number as $id)
    <form action="/move-file/{{ $id->center->name->code}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="button mr-1" style="float: left;">
            <button type="button" class="btn" style="background-color: #B048B5; color:white;" data-toggle="modal" data-target="#moveModal"><b>Move Center</b></button>
        </div>
        <div class="modal fade" id="moveModal" tabindex="-1" role="dialog" aria-labelledby="moveModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="moveModalLabel">Movement Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="date">Move to: </label>
                            <select class="select2bs4" name="center_id" id="center_id" required>
                                <option value="">-Select Center-</option>
                                @foreach($centers as $center)
                                <option value="{{$center->code}}" {{ $id->center->name->code  == $center->code ? 'disabled' : '' }}>[{{$center->code}}] {{$center->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="date">Movement Purpose: </label>
                            <select class="form-control select2bs4 select2-hidden-accessible" id="move_purpose" name="purpose" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">-Select-</option>
                                <option value="Student Movement">Student Movement</option>
                                <option value="Student Graduation">Student Graduation</option>
                                <option value="1">Other</option>
                                <span class="select2 select2-container select2-container--bootstrap4 select2-container--below" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false" aria-labelledby="select2-st75-container"><span class="select2-selection__rendered" role="textbox" aria-readonly="true"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="purpose">Other:</label>
                            <input type="text" class="form-control" id="other_move_purpose" placeholder="State Purpose" name="purpose" maxlength="255" size="35" disabled="disabled" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="id[]" value="{{ $id->id }}">Move File</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endforeach
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">File Details</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($file_number as $id)
                        <strong><i class="fas fa-file mr-1"></i>File</strong>
                        <p class="text-muted">
                            {{ $id->file_number }}
                        </p>
                        <hr>
                        <strong><i class="fas fa-file-alt mr-1"></i>Existing File</strong>
                        <p class="text-muted">
                            {{ $id->existing_file_number }}
                        </p>
                        <hr>
                        <strong><i class="fas fa-building mr-1"></i>Center</strong>
                        <p class="text-muted">
                            [{{ $id->center->name->code }}] {{ $id->center->name->name }}
                        </p>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i>Student</strong>
                        <p class="text-muted">
                            {{ $id->student_name }}
                        </p>
                        <hr>
                        <strong><i class="fas fa-id-badge mr-1"></i>Metric</strong>
                        <p class="text-muted">
                            {{ $id->student_metric }}
                        </p>
                        <hr>
                        <strong><i class="fas fa-id-card mr-1"></i>Identification Card</strong>
                        <p class="text-muted">
                            {{ $id->student_ic }}
                        </p>
                        <hr>
                        <strong><i class="fas fa-file-signature mr-1"></i>Status</strong>
                        <p class="text-muted">
                            {{ $id->filestatus->name }}
                        </p>
                        <hr>
                        @if(!empty($id->archive->archive_id))
                        <strong><i class="fas fa-archive mr-1"></i>Archive</strong>
                        <p class="text-muted">
                            <a href="/view-archive-file/{{ $id->archive->archive_id }}"><b>{{ $id->archive->archiveid->archive_number }}</b></a></td>
                        </p>
                        <hr>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <h3 class="card-title" style="margin-top:15px; margin-left:10px; font-weight:bold;">File Application History</h3>
                        <table id="table1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Purpose</th>
                                    <th>Status</th>
                                    <th>Date Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apphistory as $file)
                                <tr>
                                    <td>{{ $file->applicant_id }}</td>
                                    <td>{{ $file->applicant_name }}</td>
                                    <td>{{ $file->email }}</td>
                                    <td>{{ $file->purpose }}</td>
                                    <td>{{ $file->status }}</td>
                                    <td>{{ $file->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <h3 class="card-title" style="margin-top:15px; margin-left:10px; font-weight:bold;">File Center History</h3>
                        <table id="table2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Original Number</th>
                                    <th>New Number</th>
                                    <th>Orginal Center</th>
                                    <th>New Center</th>
                                    <th>Purpose</th>
                                    <th>Received At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movehistory as $file)
                                <tr>
                                    <td>{{ $file->original_filenumber}}</td>
                                    <td>{{ $file->new_filenumber }}</td>
                                    <td>{{ $file->fileid->originalcenter }}</td>
                                    <td>{{ $file->fileid->newcenter }}</td>
                                    <td>{{ $file->fileid->purpose }}</td>
                                    <td>{{ $file->fileid->receivedat }}</td>
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

@endsection