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
    @media print {
        .noPrint {
            display: none;
        }

        .table,
        th,
        td {
            border: 2px solid black;
        }

        thead {
            border: 3px solid black;
        }

        .card-body {
            max-height: none !important;
        }

    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Check In Files</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Check In Files</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<form action="manage-checkin" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card mx-auto" style="width:97%;">
        <div class="card-header">
            <h1 class="card-title" style="font-size:17px"><b>ID: </b>{{ $applicant_details->applicant_id }}&emsp;&emsp;<b>Name: </b>{{ $applicant_details->applicant_name }}&emsp;&emsp;<b>Email: </b>{{ $applicant_details->email }}&emsp;&emsp;</h1>
            <div class="card-tools noPrint">
                <div class="input-group input-group-sm" style="width:230px;">
                    <input type="text" name="table_search" class="form-control float-right" id="myInput" onkeyup="myFunction()" placeholder="Search by File/Name/Metric/IC">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0" style="max-height: 370px;">
            <table class="table table-head-fixed text-nowrap" id="table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th data-sortable="true">File Number</th>
                        <th data-sortable="true">Student Name</th>
                        <th data-sortable="true">Student Metric</th>
                        <th data-sortable="true">Student IC</th>
                        <th data-sortable="true">Purpose</th>
                        <th data-sortable="true">Return Date</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    @foreach ($applicant_id as $applicant)
                    <tr>
                        <td style="padding-left:40px; padding-top:16px"><input type="checkbox" name="id[]" value="{{ $applicant->id }}" style="height:20px; width:20px;"></td>
                        <td>{{ $applicant->file->file_number }}</td>
                        <td>{{ $applicant->file->student_name }}</td>
                        <td>{{ $applicant->file->student_metric }}</td>
                        <td>{{ $applicant->file->student_ic }}</td>
                        <td>{{ $applicant->purpose }}</td>
                        <td>{{ $applicant->return_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer noPrint" style="height: 60px">
            <button type="button" class="btn btn-secondary" onclick="window.print()">Print</button>
            <button type="submit" class="btn btn-primary float-right" name="value">Check In</button>
        </div>
    </div>
</form>

@endsection