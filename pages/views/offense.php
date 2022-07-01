<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>

<div class="container-fluid pt-3 ps-5 pe-5">
    <div class="row justify-content-between">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>Offenses Table</h3>
            </div>
        </div>
        <div class="col-auto">
            <div class="input-group mb-3">
                <input type="text" class="form-control" ame="search_box" id="search_box" placeholder="Search" aria-describedby="basic-addon2">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col pt-5">
            <form class="row g-3 requires-validation" id="Offense" novalidate>
                <div class="row pt-3">
                    <div class="col">
                        <input type="hidden" name="offense_id" id="offense_id">

                        <label for="userType" class="form-label">Type of Offense</label>
                        <select class="form-select" id="offenseType" name="offenseType" required>
                            <option selected disabled value="">Select..</option>

                            <?php
                            $query = "SELECT * FROM `offenses`";
                            $result = $con->query($query);
                            if ($result->num_rows > 0) {
                                while ($optionData = $result->fetch_assoc()) {
                                    $option = $optionData['offense'];
                                    $id = $optionData['id'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $option; ?></option>

                            <?php }
                            } ?>

                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a Offense Category.
                        </div>
                    </div>
                    <div class="col">
                        <label for="offenseCode" class="form-label">Offense Code</label>
                        <input type="text" class="form-control" id="offenseCode" name="offenseCode" placeholder="Ex. LO1" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide Offense Code.
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <label for="offenseDescription" class="form-label">Offense Description</label>
                        <div class="input-group has-validation">
                            <textarea class="form-control" rows="5" aria-label="With textarea" id="offenseDescription" name="offenseDescription" aria-describedby="inputGroupPrepend" required></textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Type Offense Description.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end pt-3 ">
                    <div class="col-3">
                        <div class="bd-highlight pt-3">
                            <button class="btn btn-secondary me-3" type="reset">Clear</button>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="bd-highlight pt-3">
                            <button class="btn btn-primary" type="submit" id="offenseButton">Add Offense</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-8">

            <div id="dynamicTable">
                <!-- The contents of  the tables at the ../php/fetchPaginate/offenseTable.php -->
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="OffenseDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="deleteOffense">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Offense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure to delete this Offense?</h6>
                    <input type="hidden" name="delete_offense_id" id="delete_offense_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary " type="submit">Confirm</button>
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

    function load_data(page, query = '') {
        $.ajax({
            url: "../../php/fetchPaginate/offenseTable.php",
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

    //Bootstrap input validation 5 Validation
    (function() {
        'use strict';

        const forms = document.querySelectorAll('.requires-validation');
        Array.from(forms).forEach(function(form) {
            form.addEventListener(
                'submit',
                function(event) {
                    if (!form.checkValidity()) {

                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');
                },
                false
            );
        });
    })();

    function buttonIDChange() {
        const btn = document.getElementById("offenseButton")

        if (btn.innerText === "Add Offense") {
            btn.innerText = "Edit Offense";
        } else {
            btn.innerText = "Add Offense";
        }
    };

    //CRUD Function
    $(document).on('click', '.offenseEditButton', function() {
        var offense_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/offense.php?offense_id=" + offense_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    console.log(res.data)

                    $('#offense_id').val(res.data.id);
                    $('#offenseType').val(res.data.offenses_id);
                    $('#offenseCode').val(res.data.code);
                    $('#offenseDescription').val(res.data.violation);

                }
            }
        });

    });

    $(document).on('click', '.offenseDeleteButton', function() {
        var offense_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/offense.php?offense_id=" + offense_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    $('#delete_offense_id').val(res.data.id);

                }
            }
        });

    });

    $(document).on('submit', '#Offense', function(e) {
        e.preventDefault();

        const btn = document.getElementById("offenseButton")

        if (btn.innerText === "Add Offense") {

            var formData = new FormData(this);
            formData.append("create_Offense", true)

            $.ajax({
                type: "POST",
                url: "../../php/store/offense.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response)
                    if (res.status == 422) {

                        toastr.warning(res.message, res.status);
                        console.log(res.console);

                    } else if (res.status == 200) {

                        $('#Offense')[0].reset();
                        load_data(1);
                        toastr.success(res.message, res.status);
                        console.log(res.console);

                    } else if (res.status == 500) {

                        toastr.error(res.message, res.status);
                        console.log(res.console);

                    } else if (res.status == 401) {

                        toastr.error(res.message, res.status);
                    }
                }
            });

        } else {

            var formData = new FormData(this);
            formData.append("update_Offense", true);

            $.ajax({
                type: "POST",
                url: "../../php/store/offense.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response)
                    if (res.status == 422) {

                        toastr.warning(res.message, res.status);

                    } else if (res.status == 200) {

                        $('#Offense')[0].reset();
                        btn.innerText = "Add Offense";
                        load_data(1);
                        toastr.success(res.message, res.status);
                        console.log(res.console);

                    } else if (res.status == 500) {

                        toastr.error(res.message, res.status);

                    }
                }
            });
        }

    });

    $(document).on('submit', '#deleteOffense', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("delete_Offense", true);

        $.ajax({
            type: "POST",
            url: "../../php/store/offense.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    load_data(1);
                    $('#OffenseDeleteModal').modal('hide');
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