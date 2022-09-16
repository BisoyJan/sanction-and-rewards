<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>

<div class="container-fluid pt-3 ps-5 pe-5">
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>Leadership Awards Table</h3>
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
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="formIDChangeAdd()" data-bs-target="#LeadershipModal">Add Button</button>
            </div>
        </div>
    </div>

    <div id="dynamicTable">
        <!-- The contents of  the tables at the ../php/fetchPaginate/sanction-actionTable.php -->


    </div>
</div>

<!-- modal -->
<div class="modal fade" id="LeadershipModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="LeadershipLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Leadership Award Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <form class="row g-3 requires-validation" id="Leadership" novalidate>
                        <div class="row justify-content-center pt-3">
                            <div class="col-md-2">
                                <input type="hidden" name="student_id" id="student_id">
                                <input type="hidden" name="student_no" id="student_no">
                                <input type="hidden" name="leadership_id" id="leadership_id">
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
                            <div class="col">
                                <label class="form-label">Event Title</label>
                                <textarea class="form-control" aria-label="With textarea" id="EventTitle" name="EventTitle" aria-describedby="inputGroupPrepend" placeholder="Please Provide Event Title" required></textarea>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Event Title.
                                </div>
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-3">
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

<div class="modal fade" id="LeadershipDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="deleteLeadership">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure to delete this?</h6>
                    <input type="hidden" name="delete_leadership_id" id="delete_leadership_id">
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
        load_data(1);
    });

    function load_data(page = 1, query = '') {
        $.ajax({
            url: "../../php/fetchPaginate/reward-leadershipTable.php",
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

    $(document).on('click', '.viewPDFButton', function() {
        var leadership_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/reward-leadership.php?leadership_id=" + leadership_id,
            async: false,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    console.log(res.data);

                    window.open('../../assets/docs/processed/leadership/' + res.data.student_no + '_' + res.data.id + '.pdf', '_blank').focus();
                }
            }
        });
    });

    //Form ID Change click of the button
    function formIDChangeAdd() {
        document.getElementById("Student").disabled = false;

        $("form").attr('id', 'Leadership')
        $('#Leadership')[0].reset();
        var label = document.getElementById('ModalLabel');
        label.innerHTML = "Leadership Award Details";
    };

    function formIDChangeEdit() {
        document.getElementById("Student").disabled = true;

        $("form").attr('id', 'EditLeadership')
        var label = document.getElementById('ModalLabel');
        label.innerHTML = "Edit Leadership Award Details";
    }

    function formIDChangeDelete() {
        $("form").attr('id', 'deleteLeadership')
    }

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
    // [x]: Add function done
    // [x]: Edit function done
    // [x]: Delete function done
    // [x]: Auto generate PDF done

    $(document).on('click', '.leadershipEditButton', function() {
        var leadership_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/reward-leadership.php?leadership_id=" + leadership_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {
                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    firstName = res.data.first_name + ' ';
                    middleName = res.data.middle_name + ' ';
                    lastName = res.data.last_name

                    fullName = firstName + middleName + lastName;

                    $('#leadership_id').val(res.data.id);
                    $('#student_id').val(res.data.student_id);
                    $('#student_no').val(res.data.student_no);
                    $('#Student').val(res.data.student_no);
                    $('#StudentFullName').val(fullName);
                    $('#Age').val(res.data.age);
                    $('#Gender').val(res.data.gender);
                    $('#Course').val(res.data.program_name);
                    $('#Section').val(res.data.section);
                    $('#EventTitle').val(res.data.event_title);
                    $('#dateIssued').val(res.data.date_issued);
                }
            }
        });
    });

    $(document).on('submit', '#Leadership', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("create_Leadership", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/reward-leadership.php",
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

                    load_data(1);
                    $('#Leadership')[0].reset();
                    $('#LeadershipModal').modal('hide');
                    toastr.success(res.message, res.status);

                } else if (res.status == 500) {

                    toastr.error(res.message, res.status);

                }
            }
        });

    });

    $(document).on('submit', '#EditLeadership', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_Leadership", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/reward-leadership.php",
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

                    load_data(1);
                    $('#EditLeadership')[0].reset();
                    $('#LeadershipModal').modal('hide');
                    toastr.success(res.message, res.status);

                } else if (res.status == 500) {

                    toastr.error(res.message, res.status);

                }
            }
        });
    });

    $(document).on('click', '.leadershipDeleteButton', function() {
        var action_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/reward-leadership.php?leadership_id=" + action_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    $('#delete_leadership_id').val(res.data.id);
                    $('#delete_student_id').val(res.data.student_no);

                    console.log(res.data);
                }
            }
        });
    });

    $(document).on('submit', '#deleteLeadership', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("delete_Leadership", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/reward-leadership.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    load_data(1);
                    $('#LeadershipDeleteModal').modal('hide');
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