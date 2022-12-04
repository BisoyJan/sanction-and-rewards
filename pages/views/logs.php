<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>

<div class="container-fluid pt-3 ps-5 pe-5">
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>System Logs Table</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search_box" id="search_box" placeholder="Search" aria-describedby="basic-addon2">
            </div>
        </div>
    </div>

    <div class="table-responsive pt-1">
        <table id="logsTable" class="table table-hover" style="text-align: center;">
            <thead>
                <th>ID</th>
                <th>UserID</th>
                <th>Full Name</th>
                <th>Type</th>
                <th>Section</th>
                <th>Description</th>
                <th>Date</th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('#logsTable').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
                'url': '../../php/fetchPaginate/logsTable.php',
                'type': 'post',
            },
            "aoColumnDefs": [{
                    "bSortable": false
                },

            ]
        });
    });
</script>


<?php
include('../includes/main/footer.php')
?>