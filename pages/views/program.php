<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>


<div class="container-fluid pt-3 ps-5 pe-5">
    <div class="row justify-content-between">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>Programs Table</h3>
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
            <form class="row g-3 requires-validation" id="Program" novalidate>
                <div class="row pt-3">
                    <div class="col">
                        <input type="hidden" name="program_id" id="program_id">

                        <label for="abbreviation" class="form-label">Abbreviation</label>
                        <input type="text" class="form-control" id="abbreviation" name="abbreviation" placeholder="Ex. BSIT" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide Abbreviation.
                        </div>
                    </div>

                    <div class="col">
                        <label for="userType" class="form-label">College</label>
                        <select class="form-select" id="college" name="college" required>
                            <option selected disabled value="">Select College</option>

                            <?php
                            $query = "SELECT * FROM `colleges`";
                            $result = $con->query($query);
                            if ($result->num_rows > 0) {
                                while ($optionData = $result->fetch_assoc()) {
                                    $option = $optionData['college'];
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
                            Please select a College.
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <label for="userName" class="form-label">Program</label>
                        <div class="input-group has-validation">
                            <textarea class="form-control" aria-label="With textarea" id="program" name="program" placeholder="Ex. Bachelor of Science in Information Technology" aria-describedby="inputGroupPrepend" required></textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Type Program.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end pt-3 ">
                    <div class="col-3">
                        <div class="bd-highlight pt-3">
                            <button class="btn btn-secondary me-3" type="reset" onclick="buttonIDChange()">Clear</button>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="bd-highlight pt-3">
                            <button class="btn btn-primary" type="submit" id="programButton">Add Program</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-8">

            <div id="dynamicTable">
                <!-- The contents of  the tables at the ../php/fetchPaginate/programTable.php -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ProgramDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="deleteProgram">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure to delete this Program?</h6>
                    <input type="hidden" name="delete_program_id" id="delete_program_id">
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

    function load_data(page = 1, query = '') {
        $.ajax({
            url: "../../php/fetchPaginate/programTable.php",
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

    function buttonIDChange() {
        const btn = document.getElementById("programButton")

        if (btn.innerText === "Add Program") {
            btn.innerText = "Edit Program";
        } else {
            btn.innerText = "Add Program";
        }
    };

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


    // CRUD function 
    $(document).on('click', '.programEditButton', function() {
        var program_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/program.php?program_id=" + program_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {


                    $('#program_id').val(res.data.id);
                    $('#abbreviation').val(res.data.abbreviation);
                    $('#college').val(res.data.college_id);
                    $('#program').val(res.data.program_name);

                }
            }
        });

    });

    $(document).on('click', '.programDeleteButton', function() {
        var program_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/program.php?program_id=" + program_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    $('#delete_program_id').val(res.data.id);

                }
            }
        });

    });

    $(document).on('submit', '#Program', function(e) {
        e.preventDefault();

        const btn = document.getElementById("programButton")

        if (btn.innerText === "Add Program") {

            var formData = new FormData(this);
            formData.append("create_Program", true)

            $.ajax({
                type: "POST",
                url: "../../php/store/program.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response)
                    if (res.status == 422) {

                        toastr.warning(res.message, res.status);
                        console.log(res.console);

                    } else if (res.status == 200) {

                        $('#Program')[0].reset();
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
            formData.append("update_Program", true);

            $.ajax({
                type: "POST",
                url: "../../php/store/program.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response)
                    if (res.status == 422) {

                        toastr.warning(res.message, res.status);

                    } else if (res.status == 200) {

                        $('#Program')[0].reset();
                        btn.innerText = "Add Program";
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

    $(document).on('submit', '#deleteProgram', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("delete_Program", true);

        $.ajax({
            type: "POST",
            url: "../../php/store/program.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    load_data(1);
                    $('#ProgramDeleteModal').modal('hide');
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