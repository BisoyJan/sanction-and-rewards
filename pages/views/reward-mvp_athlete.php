<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>

<div class="container-fluid pt-3 ps-5 pe-5">
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>MVP Athlete Awards Table</h3>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <div class="d-grid gap-2 d-flex justify-content-end">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="formIDChangeAdd()" data-bs-target="#MVPAthleteModal">Add Award</button>
            </div>
        </div>
    </div>

    <div class="table-responsive pt-1">
        <table id="mvp_athleteTable" class="table table-hover" style="text-align: center;">
            <thead>
                <th>ID</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Section</th>
                <th>Course</th>
                <th>MVP</th>
                <th>Date Issued</th>
                <th>Actions</th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <!-- modal -->
    <div class="modal fade" id="MVPAthleteModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="MVPAthleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">MVP Athlete Award Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <form class="row g-3 requires-validation" id="MVPAthlete" novalidate>
                            <div class="row justify-content-center pt-3">
                                <div class="col-md-2">
                                    <input type="hidden" name="student_id" id="student_id">
                                    <input type="hidden" name="student_no" id="student_no">
                                    <input type="hidden" name="MVPAthlete_id" id="MVPAthlete_id">
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
                                    <label class="form-label">Sports Name</label>
                                    <input class="form-control" id="sports" name="sports" placeholder="Please Provide Information" autocapitalize="word" oninput="this.value = this.value.toUpperCase()" required></i>
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

                                <div class="col-md-5">
                                    <label class="form-label">Organizer Name</label>
                                    <input class="form-control" id="organizerName" name="organizerName" placeholder="Please Provide Information" required></i>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide Information.
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <label class="form-label">Couch Name</label>
                                    <input class="form-control" id="coachName" name="coachName" placeholder="Please Provide Information" required></i>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide Information.
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

    <div class="modal fade" id="MVPAthleteDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="deleteMVPAthlete">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Are you sure to delete this?</h6>
                        <input type="hidden" name="delete_MVPAthlete_id" id="delete_MVPAthlete_id">
                        <input type="hidden" name="delete_student_id" id="delete_student_id">
                    </div>
                    <div class="modal-footer">
                        <button data-bs-dismiss="modal" class="btn btn-primary" type="submit">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('#mvp_athleteTable').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
                'url': '../../php/fetchPaginate/reward-mvp_athleteTable.php',
                'type': 'post',
            },
            "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [7]
                },

            ]
        });
    });

    //Form ID Change click of the button
    function formIDChangeAdd() {
        document.getElementById("Student").disabled = false;

        $("form").attr('id', 'MVPAthlete')
        $('#MVPAthlete')[0].reset();
        var label = document.getElementById('ModalLabel');
        label.innerHTML = "MVP Athlete Award Details";
    };

    function formIDChangeEdit() {
        document.getElementById("Student").disabled = true;

        $("form").attr('id', 'EditMVP_athlete')
        var label = document.getElementById('ModalLabel');
        label.innerHTML = "Edit MVP Athlete Award Details";
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

    $(document).on('click', '.viewPDFButton', function() {
        var MVPAthlete_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/reward-mvp_athlete.php?MVPAthlete_id=" + MVPAthlete_id,
            async: false,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    console.log(res.data);

                    window.open('../../assets/docs/processed/mvp-athlete/' + res.data.student_no + '_' + res.data.id + '.pdf', '_blank').focus();
                }
            }
        });
    });

    //CRUD Function
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

    $(document).on('submit', '#MVPAthlete', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("create_MVPAthlete", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/reward-mvp_athlete.php",
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

                    mytable = $('#mvp_athleteTable').DataTable();
                    mytable.draw();
                    $('#MVPAthlete')[0].reset();
                    $('#MVPAthleteModal').modal('hide');
                    toastr.success(res.message, res.status);

                } else if (res.status == 500) {

                    toastr.error(res.message, res.status);

                }
            }
        });

    });

    $(document).on('click', '.MVPAthleteEditButton', function() {
        var MVPAthlete_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/reward-mvp_athlete.php?MVPAthlete_id=" + MVPAthlete_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {
                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    firstName = res.data.first_name + ' ';
                    middleName = res.data.middle_name + ' ';
                    lastName = res.data.last_name

                    fullName = firstName + middleName + lastName;

                    $('#MVPAthlete_id').val(res.data.id);
                    $('#student_id').val(res.data.student_id);
                    $('#student_no').val(res.data.student_no);
                    $('#Student').val(res.data.student_no);
                    $('#StudentFullName').val(fullName);
                    $('#Age').val(res.data.age);
                    $('#Gender').val(res.data.gender);
                    $('#Course').val(res.data.program_name);
                    $('#Section').val(res.data.section);
                    $('#organizerName').val(res.data.organizer_name);
                    $('#coachName').val(res.data.coach_name);
                    $('#sports').val(res.data.sports);
                    $('#dateIssued').val(res.data.date_issued);
                }
            }
        });
    });

    $(document).on('submit', '#EditMVP_athlete', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_MVPAthlete", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/reward-mvp_athlete.php",
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

                    mytable = $('#mvp_athleteTable').DataTable();
                    mytable.draw();
                    $('#EditMVP_athlete')[0].reset();
                    $('#MVPAthleteModal').modal('hide');
                    toastr.success(res.message, res.status);

                } else if (res.status == 500) {

                    toastr.error(res.message, res.status);

                }
            }
        });
    });

    $(document).on('click', '.MVPAthleteDeleteButton', function() {
        var MVPAthlete_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/reward-mvp_athlete.php?MVPAthlete_id=" + MVPAthlete_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                    $('#MVPAthleteDeleteModal').modal('hide');

                } else if (res.status == 200) {

                    $('#delete_MVPAthlete_id').val(res.data.id);
                    $('#delete_student_id').val(res.data.student_no);
                    console.log(res.data);
                }
            }
        });
    });

    $(document).on('submit', '#deleteMVPAthlete', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("delete_MVPAthlete", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/reward-mvp_athlete.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {

                    mytable = $('#mvp_athleteTable').DataTable();
                    mytable.draw();
                    $('#MVPAthleteDeleteModal').modal('hide');
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