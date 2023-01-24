<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>

<div class="container-fluid pt-1 ps-5 pe-5 ">
    <div class="row">
        <div class="col-auto">
            <h1>Dashboard</h1>
        </div>
        <?php if (empty($_SESSION['school_year'])) { ?>
            <div class="col-auto">
                <div class="input-group mb-3 pt-2">
                    <input type="text" class="form-control " id="SchoolYear" name="SchoolYear" placeholder="School Year Ex 2022-2023" required>
                </div>
            </div>
        <?php } ?>
        <div class="col-auto">
            <div class="d-grid gap-2 d-flex pt-2 justify-content-start">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" id="studentAddButton" data-bs-target="#StudentModal">Generate Report</button>
            </div>
        </div>
        <div class="col pt-2 d-flex justify-content-end">

            <div class="d-flex flex-row-reverse">
                <div class=" p-2 bd-highlight h5" id="time">Time</div>

                <?php if (empty($_SESSION['school_year'])) { ?>
                    <div class="p-2 bd-highlight h5">Semester not yet set </div>
                <?php } else { ?>
                    <div class="p-2 bd-highlight h5"><?= $_SESSION['semester']; ?> | <?= $_SESSION['school_year']; ?> </div>
                <?php } ?>


            </div>

        </div>
    </div>

    <div class="row pt-2 d-flex justify-content-center">
        <div class="col-auto">
            <div class="card mb-3">
                <div class="row ">
                    <div class="col-md-4">
                        <img src="../../assets/images/read_online_96px.png" class="mx-auto d-block pt-4 px-4" alt=" ...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body pt-4">
                            <h4 class="card-title ps-4">Student</h4>
                            <p class="card-text ps-4">Total Students: <strong id="students" style="font-size:26px"></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-auto">
            <div class="card mb-3">
                <div class="row ">
                    <div class="col-md-4">
                        <img src="../../assets/images/he_skin_type_3_96px.png" class="mx-auto d-block pt-4 px-4" alt=" ...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body pt-4">
                            <h4 class="card-title ps-4">Referred</h4>
                            <p class="card-text ps-4">Total Referred: <strong id="referral" style="font-size:26px"></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-auto">
            <div class="card mb-3">
                <div class="row ">
                    <div class="col-md-4">
                        <img src="../../assets/images/police_fine_96px.png" class="mx-auto d-block pt-4 px-4" alt=" ...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body pt-4">
                            <h4 class="card-title ps-4">Actioned</h4>
                            <p class="card-text ps-4">Total Actioned: <strong id="action" style="font-size:26px"></strong></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-auto">
            <div class="card mb-3">
                <div class="row ">
                    <div class="col-md-4">
                        <img src="../../assets/images/law_96px.png" class="mx-auto d-block pt-4 px-4" alt=" ...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body pt-4">
                            <h4 class="card-title ps-4">Case</h4>
                            <p class="card-text ps-4">Total Case: <strong id="case" style="font-size:26px"></strong></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3 m-2">
            <div class="table-responsive py-2 px-2">
                <table id="studentSanctionsTable" class="table table-hover" style="text-align: center;">
                    <thead>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Course</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th style="width:15%;">Description</th>
                        <th>Complainant</th>
                        <th>Date Issued</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-auto">
            <div class="card mb-3 text-center" style="width:46.5rem;">
                <div class="card-body">
                    <h5 class="card-title" id="studentSanctionByCurrentMonth"></h5>
                    <div class="table-responsive">
                        <table id="studentSanctionByCurrentMonthTable" class="table table-hover" style="text-align: center;">
                            <thead>
                                <th>Student Number</th>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th>Section</th>
                                <th>Program</th>
                                <th>Total Count</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-auto">
            <div class="card mb-3 text-center" style="width:46.5rem;">
                <div class="card-body">
                    <h5 class="card-title">Common Violations Students Commits</h5>
                    <div class="table-responsive">
                        <table id="violationCommonToViolateTable" class="table table-hover" style="text-align: center;">
                            <thead>
                                <th>Violation Code</th>
                                <th>Offense Type</th>
                                <th>Total Students Under this Violation</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="StudentModal" tabindex="-1" aria-labelledby="StudentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Select Report to Generate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="pt-2 d-flex justify-content-center">
                        <h5>Student Referral</h5>
                    </div>

                    <div class="row d-flex justify-content-center pt-3">
                        <div class="col-4 d-flex justify-content-center">
                            <div class="input-group mb-3 ps-4">
                                <span class="input-group-text">All Students Referred :</span>
                                <a href="../../php/reportGenerate/allStudentReferral.php" target="_blank" class="btn btn-success btn-sm"><img class="pt-1" src="../../assets/images/report_file_50px.png" width="20" /></a>
                            </div>
                        </div>
                        <div class="col-3 d-flex justify-content-center">
                            <div class="input-group mb-3 ps-4">
                                <span class="input-group-text">By Semester:</span>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../../php/reportGenerate/referralbySemester.php?semester=1st" target="_blank">1st Semester</a></li>
                                        <li><a class="dropdown-item" href="../../php/reportGenerate/referralbySemester.php?semester=2nd" target="_blank">2nd Semester</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 d-flex justify-content-center">
                            <form class="row g-3 d-flex justify-content-center" method="POST" target="_blank" action="../../php/reportGenerate/referralByMonth.php">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">By Month:</span>
                                    <input type="month" class="form-control" name="datepicker" id="datepicker" />
                                    <button type="submit" class="btn btn-success btn-sm"><img class="pt-1" src="../../assets/images/report_file_50px.png" width="20" /></button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="warningModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Notice!</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5><span class=" badge bg-warning rounded-pill" id="warningSanctionNotificationSerious"></span></h5>
                <h5><span class=" badge bg-danger rounded-pill" id="warningSanctionNotificationVerySerious"></span></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>


<script>
    setInterval(refreshTime, 1000);

    $(document).ready(function() {
        all_functions();
    });

    function all_functions() {
        student();
        referral();
        action();
        disciplinary();
        refreshTime();
        studentSanctionbyMonthTable(1);
        violationCommonToViolateTable(1);
        currentMonth();
        studentSanctionTable(1);
        warningNotification();
    }

    function refreshTime() {
        const timeDisplay = document.getElementById("time");
        const dateString = new Date().toLocaleString();
        const formattedString = dateString.replace(", ", " - ");
        timeDisplay.textContent = formattedString;
    }


    $(document).on('keyup keypress', '#SchoolYear', function(e) {
        var SchoolYear = $('#SchoolYear').val();

        if (e.which == 13) {
            e.preventDefault();

            $.ajax({
                type: "GET",
                url: "../../php/store/semester.php?select_semesters=" + SchoolYear,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        toastr.error(res.message, res.status);
                    } else if (res.status == 200) {

                        console.log(res.console);
                        toastr.success(res.message, res.status);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);

                    }
                }
            });

        }
    });

    function student() {
        $.ajax({
            type: "GET",
            url: "../../php/store/dashboard.php?student",
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    var label = document.getElementById('students');
                    label.innerHTML = res.data;


                } else if (res.status == 404) {

                    var label = document.getElementById('students');
                    label.innerHTML = "No Data";

                }
            }
        });
    }

    function referral() {
        $.ajax({
            type: "GET",
            url: "../../php/store/dashboard.php?referral",
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    var label = document.getElementById('referral');
                    label.innerHTML = res.data;



                } else if (res.status == 404) {

                    var label = document.getElementById('referral');
                    label.innerHTML = "No Data";


                }
            }
        });
    }

    function action() {
        $.ajax({
            type: "GET",
            url: "../../php/store/dashboard.php?action",
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    var label = document.getElementById('action');
                    label.innerHTML = res.data;

                } else if (res.status == 404) {

                    var label = document.getElementById('action');
                    label.innerHTML = "No Data";


                }
            }
        });
    }

    function disciplinary() {
        $.ajax({
            type: "GET",
            url: "../../php/store/dashboard.php?case",
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    var label = document.getElementById('case');
                    label.innerHTML = res.data;


                } else if (res.status == 404) {

                    var label = document.getElementById('case');
                    label.innerHTML = "No Data";


                }
            }
        });
    }

    function studentSanctionTable() {
        $('#studentSanctionsTable').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
                'url': '../../php/fetchPaginate/dashboard_studentSanctionsTable.php',
                'type': 'post'
            },
            lengthMenu: [5, 10, 20],
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [1]
            }, ]
        });
    }

    function studentSanctionbyMonthTable() {

        $('#studentSanctionByCurrentMonthTable').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
                'url': '../../php/fetchPaginate/dashboard_studentSanctionbyMonthTable.php',
                'type': 'post',
            },
            "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [3]
                },

            ]
        });
    }

    function warningNotification() {

        $.ajax({
            type: "GET",
            url: "../../php/store/dashboard.php?sanction_NotificationWarning",

            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 404) {

                    toastr.error(res.message, res.status);

                } else if (res.status == 200) {

                    var warningSanctionNotificationSerious = document.getElementById('warningSanctionNotificationSerious')
                    warningSanctionNotificationSerious.innerHTML = res.labels[0] + " has " + res.numbers[0] + " pending "

                    var warningSanctionNotificationVerySerious = document.getElementById('warningSanctionNotificationVerySerious')
                    warningSanctionNotificationVerySerious.innerHTML = res.labels[1] + " has " + res.numbers[1] + " pending "

                    $("#warningModal").modal("show")
                    console.log(res.data);
                }
            }
        });
    }


    function currentMonth() {
        const date = new Date();

        var label = document.getElementById('studentSanctionByCurrentMonth');
        label.innerHTML = "List of Student Referred by the Month of " + moment(date).format('MMMM');
    }

    function violationCommonToViolateTable() {
        $('#violationCommonToViolateTable').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
                'url': '../../php/fetchPaginate/dashboard_violationCommonToViolateTable.php',
                'type': 'post',
            },
            "aoColumnDefs": [{
                "bSortable": false,
            }, ]
        });
    }
</script>

<?php
include('../includes/main/footer.php')
?>