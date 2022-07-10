<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>

<div class="container-fluid pt-3 ps-5 pe-5">
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>Referrals Table</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search_box" id="search_box" placeholder="Search" aria-describedby="basic-addon2">
            </div>
        </div>
        <div class="col">
            <div class="d-grid gap-2 d-flex justify-content-end">
                <a href="../forms/sanction-referral.php" style="text-decoration: none;">
                    <button class="btn btn-primary" type="button">Add Button</button>
                </a>
            </div>
        </div>
    </div>

    <div id="dynamicTable">
        <!-- The contents of  the tables at the ../php/fetchPaginate//sanction-referralTable.php -->

    </div>
    <!-- Modal -->
    <div class="modal fade" id="ReferralDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="deleteReferral">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Are you sure to delete this Account?</h6>
                        <input type="hidden" name="delete_referral_id" id="delete_referral_id">
                        <input type="hidden" name="delete_student_no" id="delete_student_no">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary deleteLostFound" type="submit">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    //To inject the table in fetchPaginate folder
    $(document).ready(function() {
        load_data(1);
    });

    function load_data(page = 1, query = '') {
        $.ajax({
            url: "../../php/fetchPaginate/sanction-referralTable.php",
            method: "POST",
            data: {
                page: page,
                query: query
            },
            success: function(data) {
                $('#dynamicTable').html(data);
            }
        });
    }

    $(document).on('click', '.page-link', function() {
        var page = $(this).data('page_number');
        var query = $('#search_box').val();
        load_data(page, query);
    });

    $('#search_box').keyup(function() {
        var query = $('#search_box').val();
        load_data(1, query);
    });

    //CRUD
    $(document).on('click', '.sanction-referralEditButton', function() {
        var referral_id = $(this).val();

        sessionStorage.setItem("sanction-referralID", referral_id);

    });

    $(document).on('click', '.referralDeleteButton', function() {
        var referral_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/sanction-referral.php?referral_id=" + referral_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    $('#delete_referral_id').val(res.data.id);
                    $('#delete_student_no').val(res.data.student_no);
                }
            }
        });
    });

    $(document).on('submit', '#deleteReferral', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("delete_Referral", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/sanction-referral.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    load_data(1);
                    $('#ReferralDeleteModal').modal('hide');
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