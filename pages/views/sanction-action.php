<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>

<div class="container-fluid pt-3 ps-5 pe-5">
    <div class="row mb-3">
        <div class="col-auto">
            <div class="input-group ">
                <h3>Disciplinary Action Table</h3>
            </div>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-auto">
            <div class="input-group mb-3">
                <select class="form-select" id="category" name="category">
                    <option selected value="1">Uncounselled</option>
                    <option value="2">Counselled</option>
                    <option value="3">All Data</option>
                </select>
            </div>
        </div>
    </div>

    <div class="table-responsive pt-1">
        <table id="actionTable" class="table table-hover" style="text-align: center;">
            <thead>
                <th>ID</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Section</th>
                <th>Course</th>
                <th>Offense Code</th>
                <th>Committed</th>
                <th>Counselling</th>
                <th>Date Issued</th>
                <th>Complainer</th>
                <th>Remarks</th>
                <th>Actions</th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ActionDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="deleteAction">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure to delete this?</h6>
                    <input type="hidden" name="delete_referral_id" id="delete_referral_id">
                    <input type="hidden" name="delete_action_id" id="delete_action_id">
                    <input type="hidden" name="delete_student_no" id="delete_student_no">
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" class="btn btn-primary" type="submit">Confirm</button>
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
        $('#actionTable').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
                'url': '../../php/fetchPaginate/sanction-actionTable.php',
                'type': 'post',
                'data': {
                    category: category
                }
            },
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [11]
            }, ]
        });
    }

    $(document).on('change', '#category', function() {
        var category = $(this).val();
        $('#actionTable').DataTable().destroy();
        if (category != '') {
            load_data(category);
        } else {
            load_data();
        }
    });

    //CRUD Function
    $(document).on('click', '.sanction-actionEditButton', function() {
        var action_id = $(this).val();

        sessionStorage.setItem("sanction-actionID", action_id);

    });

    $(document).on('click', '.sanction-counselAddButton', function() {
        var action_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/sanction-counselling.php?action_id=" + action_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    sessionStorage.setItem('sanction-counselFunction', 'Add');
                    sessionStorage.setItem("sanction-actionID", action_id);

                    window.location.href = "../forms/sanction-counselling.php";

                } else if (res.status == 200) {
                    //Message here
                    toastr.warning(res.message, res.status);
                }
            }
        });

    });

    $(document).on('click', '.actionDeleteButton', function() {
        var action_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/sanction-action.php?action_id=" + action_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    $('#delete_action_id').val(res.data.id);
                    $('#delete_student_no').val(res.data.student_no);
                    $('#delete_referral_id').val(res.data.sanction_referral_id);

                    console.log(res.data.sanction_referral_id);
                }
            }
        });
    });

    $(document).on('click', '.viewPDFButton', function() {
        var action_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/sanction-action.php?action_id=" + action_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    console.log(res.data);

                    window.open('../../assets/docs/processed/action/' + res.data.student_no + '_' + res.data.id + '.pdf', '_blank').focus();
                }
            }
        });
    });

    $(document).on('submit', '#deleteAction', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("delete_Action", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/sanction-action.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    $('#actionTable').DataTable().destroy();
                    load_data(1);
                    $('#ActionDeleteModal').modal('hide');
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