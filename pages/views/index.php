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
        <div class="col pt-2 d-flex justify-content-end">

            <div class="d-flex flex-row-reverse">
                <?php if (empty($_SESSION['school_year'])) { ?>
                    <!-- If school year empty nothings shows -->
                <?php } else { ?>
                    <div class="p-2 bd-highlight h5"><?= $_SESSION['semester']; ?> | <?= $_SESSION['school_year']; ?> </div>
                <?php } ?>
                <div class=" p-2 bd-highlight h5" id="time">Time</div>

            </div>

        </div>
    </div>

    <div class="row pt-2 d-flex justify-content-center">
        <div class="col-auto">
            <div class="card mb-3">
                <div class="row ">
                    <div class="col-md-4">
                        <img src="../../assets/images/read_online_96px.png" class="mx-auto d-block pt-4 px-3" alt=" ...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">Student</h4>
                            <p class="card-text">Total Students: <strong id="students" style="font-size:25px"></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-auto">
            <div class="card mb-3">
                <div class="row ">
                    <div class="col-md-4">
                        <img src="../../assets/images/he_skin_type_3_96px.png" class="mx-auto d-block pt-4 px-3" alt=" ...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">Referred</h4>
                            <p class="card-text">Total Referred: <strong id="referral" style="font-size:25px"></strong></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-auto">
            <div class="card mb-3">
                <div class="row ">
                    <div class="col-md-4">
                        <img src="../../assets/images/police_fine_96px.png" class="mx-auto d-block pt-4 px-3" alt=" ...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">Actioned</h4>
                            <p class="card-text">Total Actioned: <strong id="action" style="font-size:25px"></strong></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-auto">
            <div class="card mb-3">
                <div class="row ">
                    <div class="col-md-4">
                        <img src="../../assets/images/law_96px.png" class="mx-auto d-block pt-4 px-3" alt=" ...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">Case</h4>
                            <p class="card-text">Total Case: <strong id="case" style="font-size:25px"></strong></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row pt-2 d-flex justify-content-center">
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
                    <div id="dynamicTable">
                        <!-- The contents of  the tables at the ../php/fetchPaginate/.....php -->

                    </div>
                </div>
            </div>
        </div>


        <div class="col-auto">
            <div class="card mb-3 text-center" style="width:46.5rem;">
                <div class="card-body">
                    <h5 class="card-title">Common Violations Students Commits</h5>
                    <div id="dynamicTable1">
                        <!-- The contents of  the tables at the ../php/fetchPaginate/.....php -->

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

    function studentSanctionbyMonthTable(page = 1) {
        $.ajax({
            url: "../../php/fetchPaginate/dashboard_studentSanctionbyMonthTable.php",
            method: "POST",
            data: {
                page: page,
            },
            success: function(data) {

                const date = new Date();

                var label = document.getElementById('studentSanctionByCurrentMonth');
                label.innerHTML = "List of Student Referred by the Month of " + moment(date).format('MMMM');
                $('#dynamicTable').html(data);

            }
        });
    }

    $(document).on('click', '.studentSanctionbyMonth', function() {
        var page = $(this).data('page_number');
        studentSanctionbyMonthTable(page);
    });

    function violationCommonToViolateTable(page = 1) {
        $.ajax({
            url: "../../php/fetchPaginate/dashboard_violationCommonToViolateTable.php",
            method: "POST",
            data: {
                page: page,
            },
            success: function(data) {
                $('#dynamicTable1').html(data);
            }
        });
    }

    $(document).on('click', '.violationCommonToViolate', function() {
        var page = $(this).data('page_number');
        violationCommonToViolateTable(page);
    });






    // const barChartID1 = document.getElementById('lineChart').getContext('2d');
    // const barChart1 = new Chart(barChartID1, {
    //     type: 'line',
    //     data: {
    //         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    //         datasets: [{
    //             label: '# of Votes',
    //             data: [12, 19, 3, 5, 2, 3],
    //             backgroundColor: [
    //                 'rgba(255, 99, 132)',
    //                 'rgba(54, 162, 235)',
    //                 'rgba(255, 206, 86)',
    //                 'rgba(75, 192, 192)',
    //                 'rgba(153, 102, 255)',
    //                 'rgba(255, 159, 64)'
    //             ],
    //             borderColor: [
    //                 'rgba(255, 99, 132, 1)',
    //                 'rgba(54, 162, 235, 1)',
    //                 'rgba(255, 206, 86, 1)',
    //                 'rgba(75, 192, 192, 1)',
    //                 'rgba(153, 102, 255, 1)',
    //                 'rgba(255, 159, 64, 1)'
    //             ],
    //             borderWidth: 3
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });

    // const pieChartID = document.getElementById('pieChart').getContext('2d');
    // const pieChart = new Chart(pieChartID, {
    //     type: 'pie',
    //     data: {
    //         labels: ['Red', 'Blue', 'Yellow', 'Green'],
    //         datasets: [{
    //             label: '# of Votes',
    //             data: [12, 19, 3, 5],
    //             backgroundColor: [
    //                 'rgba(255, 99, 132)',
    //                 'rgba(54, 162, 235)',
    //                 'rgba(255, 206, 86)',
    //                 'rgba(75, 192, 192)'
    //             ],

    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });
</script>

<?php
include('../includes/main/footer.php')
?>