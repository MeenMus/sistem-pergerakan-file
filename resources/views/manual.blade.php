@extends('layouts.admin')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User Manual</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">User Manual</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-12" id="accordion">
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                    <div class="card-header">
                        <h4 class="card-title w-100" style = "font-weight:bold;">
                            1. Dashboard
                        </h4>
                    </div>
                </a>
                <div id="collapseOne" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/dashboard.png" style = "width:940px; height:650px; margin-left:55px;"alt="dashboard.png">
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                    <div class="card-header">
                        <h4 class="card-title w-100"  style = "font-weight:bold;">
                            2. Create File
                        </h4>
                    </div>
                </a>
                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/createfile.png" style = "width:1000px; height:550px; margin-left:40px;"alt="createfile.png">
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                    <div class="card-header">
                        <h4 class="card-title w-100"  style = "font-weight:bold;">
                            3. Create Center
                        </h4>
                    </div>
                </a>
                <div id="collapseThree" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/createcenter.png" style = "width:1000px; height:550px; margin-left:40px;"alt="createcenter.png">
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                    <div class="card-header">
                        <h4 class="card-title w-100"  style = "font-weight:bold;">
                            4. Check Out
                        </h4>
                    </div>
                </a>
                <div id="collapseFour" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/checkout.png" style = "width:1000px; height:800px; margin-left:40px;"alt="checkout.png">
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                    <div class="card-header">
                        <h4 class="card-title w-100"  style = "font-weight:bold;">
                            5. Check In
                        </h4>
                    </div>
                </a>
                <div id="collapseFive" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/checkin.png" style = "width:1000px; height:800px; margin-left:40px;"alt="checkin.png">
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseSix">
                    <div class="card-header">
                        <h4 class="card-title w-100"  style = "font-weight:bold;">
                            6. Archive Files
                        </h4>
                    </div>
                </a>
                <div id="collapseSix" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/archive.png" style = "width:1000px; height:1300px; margin-left:40px;"alt="archive.png">
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseSeven">
                    <div class="card-header">
                        <h4 class="card-title w-100"  style = "font-weight:bold;">
                            7. Unarchive
                        </h4>
                    </div>
                </a>
                <div id="collapseSeven" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/unarchive.png" style = "width:1000px; height:800px; margin-left:40px;"alt="unarchive.png">
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseEight">
                    <div class="card-header">
                        <h4 class="card-title w-100"  style = "font-weight:bold;">
                            8. Move Files
                        </h4>
                    </div>
                </a>
                <div id="collapseEight" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/move.png" style = "width:1000px; height:800px; margin-left:40px;"alt="move.png">
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseNine">
                    <div class="card-header">
                        <h4 class="card-title w-100"  style = "font-weight:bold;">
                            9. View Files
                        </h4>
                    </div>
                </a>
                <div id="collapseNine" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/viewfile.png" style = "width:1000px; height:280px; margin-left:40px;"alt="viewfile.png">
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseTen">
                    <div class="card-header">
                        <h4 class="card-title w-100"  style = "font-weight:bold;">
                            10. File Page
                        </h4>
                    </div>
                </a>
                <div id="collapseTen" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/filepage.png" style = "width:1000px; height:500px; margin-left:40px;"alt="filepage.png">
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseEleven">
                    <div class="card-header">
                        <h4 class="card-title w-100"  style = "font-weight:bold;">
                            11. Edit File
                        </h4>
                    </div>
                </a>
                <div id="collapseEleven" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/editfile.png" style = "width:1000px; height:800px; margin-left:40px;"alt="editfile.png">
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseTwelve">
                    <div class="card-header">
                        <h4 class="card-title w-100"  style = "font-weight:bold;">
                            12. View Archives
                        </h4>
                    </div>
                </a>
                <div id="collapseTwelve" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/viewarchives.png" style = "width:1000px; height:800px; margin-left:40px;"alt="viewarchives.png">
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseThirteen">
                    <div class="card-header">
                        <h4 class="card-title w-100"  style = "font-weight:bold;">
                            13. Edit Archive
                        </h4>
                    </div>
                </a>
                <div id="collapseThirteen" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/editarchive.png" style = "width:1000px; height:800px; margin-left:40px;"alt="editarchive.png">
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseFourteen">
                    <div class="card-header">
                        <h4 class="card-title w-100"  style = "font-weight:bold;">
                            14. Applications Log
                        </h4>
                    </div>
                </a>
                <div id="collapseFourteen" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/applog.png" style = "width:1000px; height:280px; margin-left:40px;"alt="applog.png">
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseFifteen">
                    <div class="card-header">
                        <h4 class="card-title w-100"  style = "font-weight:bold;">
                            15. Search Files
                        </h4>
                    </div>
                </a>
                <div id="collapseFifteen" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <img src="../../dist/img/manual/search.png" style = "width:1000px; height:550px; margin-left:40px;"alt="search.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




















@endsection