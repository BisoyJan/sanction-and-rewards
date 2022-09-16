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
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search_box" id="search_box" placeholder="Search" aria-describedby="basic-addon2">
            </div>
        </div>
        <div class="col-auto">
            <div class="input-group mb-3">
                <select class="form-select" id="category" name="category">
                    <option selected value="1">For Continuing Hearing</option>
                    <option value="2">For Formal Investigation</option>
                    <option value="3">Closed/Resolved</option>
                    <option value="4">All Data</option>
                </select>
            </div>
        </div>
        <div class="col-auto">
            <div class="input-group mb-3">
                <button class="btn btn-success" type="button" onclick="refresh()">Refresh</button>
            </div>
        </div>
    </div>

    <div id="dynamicTable">
        <!-- The contents of  the tables at the ../php/fetchPaginate//sanction-CounsellingTable.php -->

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
                </div>
                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary" type="submit">Confirm</button>
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
            url: "../../php/fetchPaginate/sanction-counsellingTable.php",
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