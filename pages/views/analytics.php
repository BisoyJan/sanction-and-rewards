<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>

<div class="container-fluid pt-1 ps-5 pe-5 ">
    <div class="row">
        <div class="col-auto">
            <h1>Analytics</h1>
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
    </div>

</div>

<script>
    $(document).ready(function() {
        all_functions();
    });



    function all_functions() {
        SanctionCategoryBarChart();
        CollegesCategoryPieChart();
        MonthSanctionsLineChart();
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
</script>

<?php
include('../includes/main/footer.php')
?>