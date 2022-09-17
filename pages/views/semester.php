<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>
<div class="container-fluid pt-3 ps-5 pe-5">
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>Semester Table</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search_box" id="search_box" placeholder="Search ex. 2022-2023" aria-describedby="basic-addon2">
            </div>
        </div>
        <div class="col-auto">
            <div class="input-group mb-3">
                <button class="btn btn-success" type="button" onclick="refresh()">Refresh</button>
            </div>
        </div>
        <div class="col">
            <div class="d-grid gap-2 d-flex justify-content-end">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" id="semesterAddButton" onclick="formIDChangeAdd()" data-bs-target="#SemesterModal">Add Button</button>
            </div>
        </div>
    </div>

    <div id="dynamicTable">
        <!-- The contents of  the tables at the ../php/fetchPaginate//sanction-referralTable.php -->

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="SemesterModal" tabindex="-1" aria-labelledby="SemesterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Add Semester</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <form class="row g-2 requires-validation" id="Semester" novalidate>
                        <div class="pt-2 d-flex justify-content-center">
                            <h5>1st Semester Date</h5>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <input type="hidden" name="semester_id" id="semester_id">
                                <label for="1stSemStarting" class="form-label">Starting Date</label>
                                <input type="date" class="form-control" id="1stSemStarting" name="1stSemStarting" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Starting Date.
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="1stSemEnding" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="1stSemEnding" name="1stSemEnding" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide End Date.
                                </div>
                            </div>
                        </div>
                        <div class="pt-2 d-flex justify-content-center">
                            <h5>2nd Semester Date</h5>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <label for="2ndSemStarting" class="form-label">Starting Date</label>
                                <input type="date" class="form-control" id="2ndSemStarting" name="2ndSemStarting" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Starting Date.
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="2ndSemEnding" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="2ndSemEnding" name="2ndSemEnding" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide End Date.
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center pt-3">
                            <div class="d-flex flex-row-reverse bd-highlight pt-3">
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="SemesterDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="deleteSemester">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Semester</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure to delete this Account?</h6>
                    <input type="hidden" name="delete_semester_id" id="delete_semester_id">

                </div>
                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary deleteSemester" type="submit">Confirm</button>
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
            url: "../../php/fetchPaginate/semesterTable.php",
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

    //Form ID Change click of the button
    function formIDChangeAdd() {
        $("form").attr('id', 'Semester')
        $('#Semester')[0].reset();
        var label = document.getElementById('ModalLabel');
        label.innerHTML = "Add Semester";
    };

    function formIDChangeEdit() {
        $("form").attr('id', 'EditSemester')
        var label = document.getElementById('ModalLabel');
        label.innerHTML = "Edit Semester";
    }

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

    $(document).on('click', '.semesterDeleteButton', function() {
        var semester_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/semester.php?semester_id=" + semester_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    console.log(res.data)
                    $('#delete_semester_id').val(res.data.id);
                }
            }
        });

    });

    //CRUD Function
    $(document).on('click', '.semesterEditButton', function() {
        var semester_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/semester.php?semester_id=" + semester_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);

                } else if (res.status == 200) {

                    console.log(res.data)

                    $('#semester_id').val(res.data.id);
                    $('#1stSemStarting').val(res.data.first_starting);
                    $('#1stSemEnding').val(res.data.first_ending);
                    $('#2ndSemStarting').val(res.data.second_starting);
                    $('#2ndSemEnding').val(res.data.second_ending);

                }
            }
        });

    });

    $(document).on('submit', '#Semester', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("create_Semester", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/semester.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 422) {

                    toastr.warning(res.message, res.status);
                    console.log(res.console);

                } else if (res.status == 401) {

                    toastr.error(res.message, res.status);

                } else if (res.status == 200) {

                    load_data(1);
                    $('#Semester')[0].reset();
                    $('#SemesterModal').modal('hide');

                    toastr.success(res.message, res.status);
                    console.log(res.console);

                } else if (res.status == 500) {

                    toastr.error(res.message, res.status);
                    console.log(res.console);
                }
            }
        });

    });

    $(document).on('submit', '#EditSemester', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_Semester", true);

        $.ajax({
            type: "POST",
            url: "../../php/store/semester.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 422) {
                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    load_data(1);
                    $('#EditSemester')[0].reset();
                    $('#SemesterModal').modal('hide');

                    toastr.success(res.message, res.status);
                    console.log(res.console);

                } else if (res.status == 500) {
                    toastr.error(res.message, res.status);
                }
            }
        });
    });

    $(document).on('click', '.deleteSemester', function(e) {
        e.preventDefault();

        var formData = $("#delete_semester_id").val()

        $.ajax({
            type: "POST",
            url: "../../php/store/semester.php",
            data: {
                'delete_Semester': true,
                'delete_semester_id': formData
            },
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {


                    load_data(1);
                    $('#StudentDeleteModal').modal('hide');
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