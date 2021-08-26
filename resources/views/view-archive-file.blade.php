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
    .fixed-table-pagination {
        padding-right: 10px;
        padding-left: 10px;
    }
</style>

<div class="content-header" style="height:56px">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">Archived Files</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Archived Files</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="form-section">
    <div class="card mx-auto" style="width:97%;">
        <div class="card-header">
            <h1 class="card-title" style="font-size:17px"><b>Archive Number: <a href data-toggle="modal" data-target="#editModal">{{ $archive_details->archive_number }}</b></a>&emsp;&emsp;<b>Center: <a href data-toggle="modal" data-target="#edit2Modal">[{{ $archive_details->center_id }}] {{ $archive_details->centerid->name }}</a></b>&emsp;&emsp;<b>Created At: </b>{{ $archive_details->created_at }}&emsp;&emsp;</h1>
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
        <div class="card-body table-responsive p-0" style="max-height: 421px;">
            <table class="table table-head-fixed text-nowrap" style="width: 100%;" id="table" data-sort-name="name" data-sort-order="desc" data-pagination="true" data-page-size="6" data-pagination-parts="['pageInfo', 'pageList']">
                <thead>
                    <tr>
                        <th data-field="id" data-sortable="true">ID</th>
                        <th data-field="file_number" data-sortable="true">File Number</th>
                        <th data-field="student_name" data-sortable="true">Student Name</th>
                        <th data-field="student_metric" data-sortable="true">Student Metric</th>
                        <th data-field="student_ic" data-sortable="true">Student IC</th>
                        <th data-field="purpose" data-sortable="true">Purpose</th>
                        <th data-field="created_at" data-sortable="true">Archived At</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    @foreach ($archivefile as $file)
                    <tr>
                        <td>{{ $file->fileid->id }}</td>
                        <td style="font-weight:bold; font-size:18px"><a href="/file-page/{{ $file->fileid->id }}">{{ $file->fileid->file_number }}</a></td>
                        <td>{{ $file->fileid->student_name }}</td>
                        <td>{{ $file->fileid->student_metric }}</td>
                        <td>{{ $file->fileid->student_ic }}</td>
                        <td>{{ $file->purpose }}</td>
                        <td>{{ $file->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<form action = "/editarchive/{{collect(request()->segments())->last()}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Rename Archive</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="existing_file_number">Archive Number:</label>
                        <input type="text" class="form-control" id="other_number" placeholder="Enter Archive Number" name="archive_number" maxlength="255" size="35" enabled="disabled">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action = "/editcenter/{{collect(request()->segments())->last()}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="edit2Modal" tabindex="-1" role="dialog" aria-labelledby="edit2ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit2ModalLabel">Change Archive Center</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Change Center:</label>
                        <select class="form-control select2bs4 select2-hidden-accessible" name="center_id" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" required>
                            <option value="">-Choose Center-</option>
                            @foreach($centers as $center)
                            <option value="{{$center->code}}">[{{$center->code}}] {{$center->name}}</option>
                            @endforeach
                            <span class="select2 select2-container select2-container--bootstrap4 select2-container--below" dir="ltr" data-select2-id="1" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false" aria-labelledby="select2-st75-container"><span class="select2-selection__rendered" id="select2-st75-container" role="textbox" aria-readonly="true"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection