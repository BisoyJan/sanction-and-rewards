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
        <div class="col-auto">
            <div class="input-group mb-3">
                <select class="form-select" id="category" name="category">
                    <option selected value="1">Un-actioned</option>
                    <option value="2">Actioned</option>
                    <option value="3">All Data</option>
                </select>
            </div>
        </div>
        <div class="col-auto">
            <div class="input-group mb-3">
                <button class="btn btn-success" type="button" onclick="refresh()">Refresh</button>
            </div>
        </div>
        <div class="col">
            <div class="d-grid gap-2 d-flex justify-content-end">
                <a href="../forms/sanction-referral.php" style="text-decoration: none;">
                    <button class="btn btn-primary" type="button">Add Report</button>
                </a>
            </div>
        </div>
    </div>

    <div id="dynamicTable">
        <!-- The contents of  the tables at the ../php/fetchPaginate//sanction-referralTable.php -->

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ReferralDeleteModal" tabindex="-1" aria-labelledby="ReferralDeleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="deleteReferral">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure to delete this?</h6>
                    <br>
                    <p>Other related Data will also be Deleted</p>
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


<script>
    //To inject the table in fetchPaginate folder
    $(document).ready(function() {
        load_data(1);
    });

    function refresh() {
        var query = $('#search_box').val();
        var category = $('#category').val();
        load_data(1, query, category);
    }

    function load_data(page = 1, query = '', category = '') {
        $.ajax({
            url: "../../php/fetchPaginate/sanction-referralTable.php",
            method: "POST",
            data: {
                page: page,
                query: query,
                category: category
            },
            success: function(data) {
                $('#dynamicTable').html(data);
            }
        });
    }

    $(document).on('click', '.page-link', function() {
        var page = $(this).data('page_number');
        var query = $('#search_box').val();
        var category = $('#category').val();
        load_data(page, query, category);
    });

    $('#search_box').keyup(function() {
        var query = $('#search_box').val();
        var category = $('#category').val();
        load_data(1, query, category);
    });

    //CRUD
    $(document).on('click', '.sanction-referralEditButton', function() {
        var referral_id = $(this).val();

        sessionStorage.setItem("sanction-referralID", referral_id);

    });

    $(document).on('click', '.sanction-actionAddButton', function() {

        var referral_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/sanction-action.php?referral_id=" + referral_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    sessionStorage.setItem('sanction-referralFunction', 'Add')
                    sessionStorage.setItem("sanction-referralID", referral_id);

                    window.location.href = "../forms/sanction-action.php";

                } else if (res.status == 200) {
                    //Message here
                    toastr.warning(res.message, res.status);
                }
            }
        });

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

    $(document).on('click', '.viewPDFButton', function() {
        var referral_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/sanction-referral.php?referral_id=" + referral_id,
            async: false,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    console.log(res.data);
                    //$('#view_pdf')[0].src = location;

                    window.open('../../assets/docs/processed/referrals/' + res.data.student_no + '_' + res.data.id + '.pdf', '_blank').focus();
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

                    console.log(res.console);
                }
            }
        });
    });
</script>

<?php
include('../includes/main/footer.php')
?>