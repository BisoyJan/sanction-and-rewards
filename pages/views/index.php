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


        <div class=" col-auto">
            <div class="card mb-3 text-center" style="width:46.5rem;">
                <div class="card-body">
                    <h5 class="card-title">Number of Sanctions by Category</h5>
                    <canvas id="barChart" width="250" height="111"></canvas>
                </div>
            </div>

            <div class="card mb-3 text-center" style="width:46.5rem;">
                <div class="card-body">
                    <h5 class="card-title">Total Number of Sanctioned Students by Month</h5>
                    <canvas id="lineChart" width="250" height="111"></canvas>
                </div>
            </div>
        </div>

        <div class="col-auto">
            <div class="card mb-3 text-center" style="width:46.5rem;">
                <div class="card-body">
                    <h5 class="card-title">Total Number of Sanctions by Colleges</h5>
                    <canvas id="pieChart"></canvas>
                </div>
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
        SanctionCategoryBarChart();
        CollegesCategoryPieChart();
        MonthSanctionsLineChart();
        refreshTime();
        studentSanctionbyMonthTable(1);
        violationCommonToViolateTable(1);
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

    function SanctionCategoryBarChart() {
        $.ajax({
            type: "GET",
            url: "../../php/store/dashboard.php?barChart",
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    const barChartID = document.getElementById('barChart').getContext('2d');
                    const barChart = new Chart(barChartID, {
                        type: 'bar',
                        data: {
                            labels: res.labels,
                            datasets: [{
                                label: '# of Sanctioned',
                                data: res.numbers,
                                backgroundColor: [
                                    'rgba(255, 99, 132)',
                                    'rgba(54, 162, 235)',
                                    'rgba(255, 206, 86)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: false,
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                        }
                    });

                } else if (res.status == 404) {

                    console.log(res.data);
                }
            }
        });
    }

    function CollegesCategoryPieChart() {

        $.ajax({
            type: "GET",
            url: "../../php/store/dashboard.php?pieChart",
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    const pieChartID = document.getElementById('pieChart').getContext('2d');
                    const pieChart = new Chart(pieChartID, {
                        type: 'pie',
                        data: {
                            labels: res.labels,
                            datasets: [{
                                data: res.numbers,
                                backgroundColor: [
                                    'rgba(255, 99, 132)',
                                    'rgba(54, 162, 235)',
                                    'rgba(255, 206, 86)',
                                    'rgba(75, 192, 192)'
                                ],

                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                        }
                    });

                } else if (res.status == 404) {

                    console.log(res.data);
                }
            }
        });
    }

    function MonthSanctionsLineChart() {
        $.ajax({
            type: "GET",
            url: "../../php/store/dashboard.php?lineChart",
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    const lineChartID = document.getElementById('lineChart').getContext('2d');
                    const lineChart = new Chart(lineChartID, {
                        type: 'line',
                        data: {
                            labels: res.labels,
                            datasets: [{
                                label: "Months",
                                data: res.numbers,
                                backgroundColor: [
                                    'rgba(255, 99, 132)',
                                    'rgba(54, 162, 235)',
                                    'rgba(255, 206, 86)',
                                    'rgba(75, 192, 192)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: false,
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                        }
                    });

                } else if (res.status == 404) {

                    console.log(res.data);
                }
            }
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

    $(document).on('click', '.studentSanctionbyMonth', function() {
        var page = $(this).data('page_number');
        studentSanctionbyMonthTable(page);
    });

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

    $(document).on('click', '.violationCommonToViolate', function() {
        var page = $(this).data('page_number');
        violationCommonToViolateTable(page);
    });
</script>

<?php
include('../includes/main/footer.php')
?>