<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>

<div class="container-fluid pt-3 ps-5 pe-5">
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>Lost and Found Table</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <input type="text" class="form-control" ame="search_box" id="search_box" placeholder="Search" aria-describedby="basic-addon2">
            </div>
        </div>
        <div class="col">
            <div class="d-grid gap-2 d-flex justify-content-end">
                <a href="../forms/lost-found.php" style="text-decoration: none;">
                    <button class="btn btn-primary" type="button">Add Item</button>
                </a>
            </div>
        </div>
    </div>

    <div id="dynamicTable">
        <!-- The contents of  the tables at the ../php/fetchPaginate/studentTable.php -->

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="viewImage" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">
                    <img src="#" id="img_url" style=" height:auto; width: 100%;" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="LostFoundDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="deleteLostFound">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure to delete this Account?</h6>
                    <input type="hidden" name="delete_LostFound_id" id="delete_LostFound_id">
                    <input type="hidden" name="delete_image_path" id="delete_image_path">

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

    function load_data(page = 1, query = '') {
        $.ajax({
            url: "../../php/fetchPaginate/lost-foundTable.php",
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

    //CRUD Function
    $(document).on('click', '.lost-foundViewImage', function() {
        var found_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/lost-found.php?lost-found-id=" + found_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    console.log(res.data);
                    $('#img_url')[0].src = res.data.picture;
                }
            }
        });

    });

    $(document).on('click', '.lost-foundEditButton', function() {
        var found_id = $(this).val();

        sessionStorage.setItem("Found_id", found_id);

    });

    $(document).on('click', '.lost-foundDeleteButton', function() {
        var found_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/lost-found.php?lost-found-id=" + found_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    console.log(res.data)
                    $('#delete_LostFound_id').val(res.data.id);
                    $('#delete_image_path').val(res.data.picture);
                }
            }
        });
    });

    $(document).on('submit', '#deleteLostFound', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("delete_LostFound", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/lost-found.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    load_data(1);
                    $('#LostFoundDeleteModal').modal('hide');
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