<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
require '../../database/database.php';
?>

<div class="container-fluid pt-1 ps-5 pe-5 ">
    <h1>Dashboard</h1>

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
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
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
                            <h4 class="card-title">Referral</h4>
                            <p class="card-text">Total Referred: <strong id="referral" style="font-size:25px"></strong></p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
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
                            <h4 class="card-title">Action</h4>
                            <p class="card-text">Total Actioned: <strong id="action" style="font-size:25px"></strong></p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
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
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
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
                    <h5 class="card-title">Special title treatment</h5>
                    <canvas id="barChart" width="250" height="111"></canvas>
                </div>
            </div>

            <div class="card mb-3 text-center" style="width:46.5rem;">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <canvas id="barChart1" width="250" height="111"></canvas>
                </div>
            </div>
        </div>

        <div class="col-auto">
            <div class="card mb-3 text-center" style="width:46.5rem;">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>

<?php
$query = "SELECT
    COUNT(violations.id)
    FROM
    sanction_referrals
    JOIN students ON sanction_referrals.student_id = students.id
    JOIN violations ON sanction_referrals.violation_id = violations.id
    JOIN offenses ON violations.offenses_id = offenses.id
    JOIN programs ON students.program_id = programs.id
    WHERE offenses.id = '1';";
$query_run = mysqli_query($con, $query);

if (mysqli_num_rows($query_run) != 0) {

    $data = mysqli_num_rows($query_run);
} else {
    $data = 0;
}




?>

<script src="../../assets/js/chart.min.js"></script>
<script>
    $(document).ready(function() {
        student();
        referral();
        action();
        disciplinary();
        referralBarChart();

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

    function referralBarChart() {
        $.ajax({
            type: "GET",
            url: "../../php/store/dashboard.php?referralChart",
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    const data = [res.data1, res.data2, res.data3];
                    console.log(data);

                    const barChartID = document.getElementById('barChart').getContext('2d');
                    const barChart = new Chart(barChartID, {
                        type: 'bar',
                        data: {
                            labels: ['Light Offense', 'Serious Offense', 'Very Serious Offense'],
                            datasets: [{
                                label: '# of Votes',
                                data: data,
                                backgroundColor: [
                                    'rgba(255, 99, 132)',
                                    'rgba(54, 162, 235)',
                                    'rgba(255, 206, 86)',
                                    'rgba(75, 192, 192)',
                                    'rgba(153, 102, 255)',
                                    'rgba(255, 159, 64)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                } else if (res.status == 404) {

                    console.log(res.data);
                }
            }
        });
    }




    const barChartID1 = document.getElementById('barChart1').getContext('2d');
    const barChart1 = new Chart(barChartID1, {
        type: 'line',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(54, 162, 235)',
                    'rgba(255, 206, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(153, 102, 255)',
                    'rgba(255, 159, 64)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const pieChartID = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieChartID, {
        type: 'pie',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5],
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
            }
        }
    });
</script>

<?php
include('../includes/main/footer.php')
?>