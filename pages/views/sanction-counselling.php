<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>

<div class="container-fluid pt-3 ps-5 pe-5">
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>Counselling Table</h3>
            </div>
        </div>
    </div>
    <div class="row justify-content-end mb-2">
        <div class="col-auto">
            <div class="input-group">
                <select class="form-select" id="category" name="category">
                    <option selected value="1">For Continuing Hearing</option>
                    <option value="2">For Formal Investigation</option>
                    <option value="3">Closed/Resolved</option>
                    <option value="4">All Data</option>
                </select>
            </div>
        </div>
    </div>

    <div class="table-responsive pt-1">
        <table id="counsellingTable" class="table table-hover" style="text-align: center;">
            <thead>
                <th>ID</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Section</th>
                <th>Course</th>
                <th>Offense Code</th>
                <th>Recommendations</th>
                <th>Hearing Date</th>
                <th>Date Issued</th>
                <th>Chairman</th>
                <th style="width:10%;">Actions</th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="CounselDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="deleteCounsel">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure to delete this?</h6>
                    <input type="hidden" name="delete_counsel_id" id="delete_counsel_id">
                    <input type="hidden" name="delete_action_id" id="delete_action_id">
                    <input type="hidden" name="delete_student_no" id="delete_student_no">
                    <input type="hidden" name="delete_referral_no" id="delete_referral_no">
                </div>
                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary" type="submit">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        load_data(1);
    });

    function load_data(category) {
        $('#counsellingTable').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
                'url': '../../php/fetchPaginate/sanction-counsellingTable.php',
                'type': 'post',
                'data': {
                    category: category
                }
            },
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [10]
            }, ]
        });
    }

    $(document).on('change', '#category', function() {
        var category = $(this).val();
        $('#counsellingTable').DataTable().destroy();
        if (category != '') {
            load_data(category);
        } else {
            load_data();
        }
    });

    //To inject the table in fetchPaginate folder
    // $(document).ready(function() {

    //     load_data(1);

    //     function load_data(category) {
    //         $('#counsellingTable').DataTable({
    //             "fnCreatedRow": function(nRow, aData, iDataIndex) {
    //                 $(nRow).attr('id', aData[0]);
    //             },
    //             'serverSide': 'true',
    //             'processing': 'true',
    //             'paging': 'true',
    //             'order': [],
    //             'ajax': {
    //                 'url': '../../php/fetchPaginate/sanction-counselling.php',
    //                 'type': 'post',
    //                 'data': {
    //                     category: category
    //                 }
    //             },
    //             "aoColumnDefs": [{
    //                 "bSortable": false,
    //                 "aTargets": [11]
    //             }, ]
    //         });
    //     }

    //     $(document).on('change', '#category', function() {
    //         var category = $(this).val();
    //         $('#counsellingTable').DataTable().destroy();
    //         if (category != '') {
    //             load_data(category);
    //         } else {
    //             load_data();
    //         }
    //     });


    // });

    //CRUD Function
    $(document).on('click', '.sanction-counsellingEditButton', function() {
        var counsel_id = $(this).val();
        sessionStorage.setItem("sanction-counselID", counsel_id);
    });

    $(document).on('click', '.counselDeleteButton', function() {
        var counsel_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/sanction-counselling.php?counsel_id=" + counsel_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    $('#delete_counsel_id').val(res.data.id);
                    $('#delete_student_no').val(res.data.student_no);
                    $('#delete_action_id').val(res.data.sanction_disciplinary_action_id);
                    $('#delete_referral_id').val(res.data.referral_id);

                    console.log(res.data);
                }
            }
        });
    });

    $(document).on('click', '.viewPDFButton', function() {
        var counsel_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/sanction-counselling.php?counsel_id=" + counsel_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    console.log(res.data);

                    window.open('../../assets/docs/processed/counselling/' + res.data.student_no + '_' + res.data.id + '.pdf', '_blank').focus();
                }
            }
        });
    });

    $(document).on('submit', '#deleteCounsel', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("delete_Counsel", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/sanction-counselling.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    $('#counsellingTable').DataTable().destroy();
                    load_data(1);
                    $('#CounselDeleteModal').modal('hide');
                    toastr.success(res.message, res.status);

                } else if (res.status == 500) {
                    toastr.error(res.message, res.status);
                }
            }
        });
    });
</script>

<?php
include('../includes/main/footer.php')
?>