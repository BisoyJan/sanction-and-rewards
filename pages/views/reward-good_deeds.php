<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>

<div class="container-fluid pt-3 ps-5 pe-5">
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>Good Deeds Awards Table</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <div class="d-grid gap-2 d-flex justify-content-end">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="formIDChangeAdd()" data-bs-target="#GoodDeedsModal">Add Award</button>
            </div>
        </div>
    </div>

    <div class="table-responsive pt-1">
        <table id="good_deedsTable" class="table table-hover" style="text-align: center;">
            <thead>
                <th>ID</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Section</th>
                <th>Course</th>
                <th>Event Title</th>
                <th>Date Issued</th>
                <th>Actions</th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="GoodDeedsModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="GoodDeedsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Leadership Award Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <form class="row g-3 requires-validation" id="GoodDeeds" novalidate>
                        <div class="row justify-content-center pt-3">
                            <div class="col-md-2">
                                <input type="hidden" name="student_id" id="student_id">
                                <input type="hidden" name="student_no" id="student_no">
                                <input type="hidden" name="goodDeeds_id" id="goodDeeds_id">
                                <label class="form-label">Student ID</label>
                                <input type="number" class="form-control" id="Student" name="Student" placeholder="Student No." required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Student ID.
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" readonly="readonly" id="StudentFullName" name="StudentFullName">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Section</label>
                                <input type="text" class="form-control" readonly="readonly" id="Section" name="Section">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label">Age</label>
                                <input type="text" class="form-control" readonly="readonly" id="Age" name="Age">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Gender</label>
                                <input type="text" class="form-control" readonly="readonly" id="Gender" name="Gender">
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col">
                                <label class="form-label">Course</label>
                                <textarea class="form-control" aria-label="With textarea" readonly="readonly" id="Course" name="Course" aria-describedby="inputGroupPrepend"></textarea>
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-md-5">
                                <label class="form-label">Item Returned</label>
                                <input class="form-control" id="itemReturned" name="itemReturned" placeholder="Please Provide Information" required></i>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Information.
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" size="48" name="dateIssued" id="dateIssued" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Date.
                                </div>
                            </div>
                        </div>

                        <div class="row pt-3">
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

<div class="modal fade" id="goodDeedsDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="deleteGoodDeeds">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure to delete this?</h6>
                    <input type="hidden" name="delete_goodDeeds_id" id="delete_goodDeeds_id">
                    <input type="hidden" name="delete_student_id" id="delete_student_id">
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
        $('#good_deedsTable').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
                'url': '../../php/fetchPaginate/reward-good_deedsTable.php',
                'type': 'post',
            },
            "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [7]
                },

            ]
        });
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

    //Form ID Change click of the button
    function formIDChangeAdd() {
        document.getElementById("Student").disabled = false;

        $("form").attr('id', 'GoodDeeds')
        $('#GoodDeeds')[0].reset();
        var label = document.getElementById('ModalLabel');
        label.innerHTML = "Good Deeds Award Details";
    };

    function formIDChangeEdit() {
        document.getElementById("Student").disabled = true;

        $("form").attr('id', 'editGoodDeeds')
        var label = document.getElementById('ModalLabel');
        label.innerHTML = "Edit Good Deeds Award Details";
    }

    function formIDChangeDelete() {
        $("form").attr('id', 'deleteGoodDeeds')
    }

    $(document).on('click', '.viewPDFButton', function() {
        var goodDeeds_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/reward-good_deeds.php?goodDeeds_id=" + goodDeeds_id,
            async: false,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    console.log(res.data);

                    window.open('../../assets/docs/processed/good-deeds/' + res.data.student_no + '_' + res.data.id + '.pdf', '_blank').focus();
                }
            }
        });
    });

    $(document).on('keyup keypress', '#Student', function(e) {
        var student_id = $('#Student').val();

        if (e.which == 13) {
            e.preventDefault();
            return false;
        } else {
            $.ajax({
                type: "GET",
                url: "../../php/store/student.php?student_no=" + student_id,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                    } else if (res.status == 200) {

                        firstName = res.data.first_name + ' ';
                        middleName = res.data.middle_name + ' ';
                        lastName = res.data.last_name

                        fullName = firstName + middleName + lastName;

                        $('#student_id').val(res.data.id);
                        $('#student_no').val(res.data.student_no);
                        $('#StudentFullName').val(fullName);
                        $('#Section').val(res.data.section);
                        $('#Age').val(res.data.age);
                        $('#Gender').val(res.data.gender);
                        $('#Course').val(res.data.program);
                    }
                }
            });
        }
    });

    //NOTE: CRUD Function
    // [x]: Add function
    // [x]: Edit function
    // [x]: Delete function
    // [x]: Auto generate PDF

    $(document).on('click', '.goodDeedsEditButton', function() {
        var goodDeeds_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/reward-good_deeds.php?goodDeeds_id=" + goodDeeds_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {
                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    console.log(res.data)

                    firstName = res.data.first_name + ' ';
                    middleName = res.data.middle_name + ' ';
                    lastName = res.data.last_name

                    fullName = firstName + middleName + lastName;

                    $('#goodDeeds_id').val(res.data.id);
                    $('#student_id').val(res.data.student_id);
                    $('#student_no').val(res.data.student_no);
                    $('#Student').val(res.data.student_no);
                    $('#StudentFullName').val(fullName);
                    $('#Age').val(res.data.age);
                    $('#Gender').val(res.data.gender);
                    $('#Course').val(res.data.program_name);
                    $('#Section').val(res.data.section);
                    $('#itemReturned').val(res.data.kindly_act);
                    $('#dateIssued').val(res.data.date_issued);
                }
            }
        });
    });

    $(document).on('click', '.goodDeedsDeleteButton', function() {
        var goodDeeds_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/reward-good_deeds.php?goodDeeds_id=" + goodDeeds_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    $('#delete_goodDeeds_id').val(res.data.id);
                    $('#delete_student_id').val(res.data.student_no);

                    console.log(res.data);
                }
            }
        });
    });

    $(document).on('submit', '#GoodDeeds', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("create_GoodDeeds", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/reward-good_deeds.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 422) {

                    toastr.warning(res.message, res.status);

                } else if (res.status == 401) {

                    toastr.error(res.message, res.status);

                } else if (res.status == 200) {

                    mytable = $('#good_deedsTable').DataTable();
                    mytable.draw();
                    $('#GoodDeeds')[0].reset();
                    $('#GoodDeedsModal').modal('hide');
                    toastr.success(res.message, res.status);

                } else if (res.status == 500) {

                    toastr.error(res.message, res.status);

                }
            }
        });

    });

    $(document).on('submit', '#editGoodDeeds', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_GoodDeeds", true);

        $.ajax({
            type: "POST",
            url: "../../php/store/reward-good_deeds.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 422) {

                    toastr.warning(res.message, res.status);

                } else if (res.status == 401) {

                    toastr.error(res.message, res.status);

                } else if (res.status == 200) {

                    mytable = $('#good_deedsTable').DataTable();
                    mytable.draw();
                    $('#editGoodDeeds')[0].reset();
                    $('#GoodDeedsModal').modal('hide');
                    toastr.success(res.message, res.status);

                } else if (res.status == 500) {

                    toastr.error(res.message, res.status);

                }
            }
        });
    });

    $(document).on('submit', '#deleteGoodDeeds', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("delete_GoodDeeds", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/reward-good_deeds.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    mytable = $('#good_deedsTable').DataTable();
                    mytable.draw();
                    $('#goodDeedsDeleteModal').modal('hide');
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