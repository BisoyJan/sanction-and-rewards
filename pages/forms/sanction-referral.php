<?php
include('../includes/forms/header.php');
?>

<style>
    .Absolute-Center {
        height: 90%;
        /* Set your own height: percents, ems, whatever! */
        width: 90%;
        /* Set your own width: percents, ems, whatever! */
        overflow: auto;
        /* Recommended in case content is larger than the container */
        margin: auto;
        /* Center the item vertically & horizontally */
        position: absolute;
        /* Break it out of the regular flow */
        top: 20%;
        left: 0;
        bottom: 0%;
        right: 0;
        /* Set the bounds in which to center it, relative to its parent/container */
    }

    /* //////////////////////////////////////// */
    /* Make sure our center blocks stay in their container! */
    .Center-Container {
        position: relative;
    }

    /* //////////////////////////////////////// */
    /* Fixed floating element within viewport */
    .Absolute-Center.is-Fixed {
        position: fixed;
        z-index: 999;
    }

    @media only screen and (max-width: 1000px) {
        .Absolute-Center {
            height: 100%;
            /* Set your own height: percents, ems, whatever! */
            width: 100%;
            /* Set your own width: percents, ems, whatever! */
            overflow: auto;
            /* Recommended in case content is larger than the container */
            margin: auto;
            /* Center the item vertically & horizontally */
            position: absolute;
            /* Break it out of the regular flow */
            top: 10%;
            left: 0;
            bottom: 0;
            right: 0;
            /* Set the bounds in which to center it, relative to its parent/container */

        }
    }

    @media only screen and (max-width: 720px) {
        .Absolute-Center {
            height: 100%;
            /* Set your own height: percents, ems, whatever! */
            width: 100%;
            /* Set your own width: percents, ems, whatever! */
            overflow: auto;
            /* Recommended in case content is larger than the container */
            margin: auto;
            /* Center the item vertically & horizontally */
            position: absolute;
            /* Break it out of the regular flow */
            top: 5%;
            left: 0;
            bottom: 5%;
            right: 0;
            /* Set the bounds in which to center it, relative to its parent/container */

        }
    }
</style>


<div class="Center-Container ">
    <div class="Absolute-Center is-Fixed ">
        <div class="container-fluid">
            <div class="container-sm shadow p-3 mb-5 bg-body rounded-3 border border-2">

                <a href=" ../views/sanction-referral.php">
                    <button class="btn btn-primary" type="submit" onclick="sessionStorage.clear('sanction-referralID');">Return</button>
                </a>

                <form class="row g-3 requires-validation d-flex justify-content-center" id="referral" novalidate>
                    <div class="pt-2 d-flex justify-content-center">
                        <h5>Student Information</h5>
                    </div>
                    <div class="row ">
                        <div class="col-lg-2">
                            <label for="returnee" class="form-label">Student ID</label>
                            <input type="number" class="form-control" id="Student" name="Student" placeholder="Student Number" required>
                            <input type="hidden" name="student_no" id="student_no">
                            <input type="hidden" name="student_id" id="student_id">
                            <input type="hidden" name="referral_id" id="referral_id">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide student ID
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" readonly="readonly" id="StudentFullName" name="StudentFullName">
                        </div>
                        <div class="col-sm-1">
                            <label class="form-label">Section</label>
                            <input type="text" class="form-control" readonly="readonly" id="Section" name="Section">
                        </div>
                        <div class="col-sm-1">
                            <label class="form-label">Age</label>
                            <input type="text" class="form-control" readonly="readonly" id="Age" name="Age">
                        </div>
                        <div class="col-sm-1">
                            <label class="form-label">Gender</label>
                            <input type="text" class="form-control" readonly="readonly" id="Gender" name="Gender">
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">Course</label>
                            <textarea class="form-control" aria-label="With textarea" readonly="readonly" id="Course" name="Course" aria-describedby="inputGroupPrepend" required></textarea>
                        </div>
                    </div>

                    <div class="pt-2 d-flex justify-content-center">
                        <h5>Violation Information</h5>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-2">
                            <label class="form-label">Violation Code</label>
                            <input type="text" class="form-control" id="violationCode" name="violationCode" required>
                            <input type="hidden" name="violation_id" id="violation_id">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                You cannot complain without Violation
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Offense Type</label>
                            <input type="text" class="form-control" readonly="readonly" id="offenseType" name="offenseType">
                        </div>
                        <div class="col-lg-5">
                            <label class="form-label">Violation Description</label>
                            <textarea class="form-control" aria-label="With textarea" readonly="readonly" id="violationDescription" name="violationDescription" aria-describedby="inputGroupPrepend" required></textarea>
                        </div>
                    </div>

                    <div class="pt-2 d-flex justify-content-center">
                        <h5>Referral Information</h5>
                    </div>

                    <div class="row pt-3 d-flex justify-content-center">
                        <div class="col-lg-3">
                            <label class="form-label">Complainer Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="complainerName" name="complainerName" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Complainer Name
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Referred To</label>
                            <input type="text" class="form-control" id="referredTo" name="referredTo" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide Item Type.
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Date Issued</label>
                            <input type="date" class="form-control" name="dateIssued" id="dateIssued" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide Date.
                            </div>
                        </div>
                    </div>

                    <div class=" bd-highlight pt-1">
                        <div class="row">
                            <div class="col d-flex align-items-center">
                                <span id="updated_by" class="align-middle"></span>
                            </div>
                            <div class="col d-flex flex-row-reverse">
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
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

    $(document).on('keyup keypress', '#Student', function(e) {
        var student_id = $('#Student').val();

        if (e.which == 13) {
            e.preventDefault();
            return false;
        } else {
            $.ajax({
                type: "GET",
                url: "../../php/store/sanction-referral.php?student_id=" + student_id,
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

    $(document).on('keyup keypress', '#violationCode', function(e) {
        var violationCode = $('#violationCode').val();

        if (e.which == 13) {
            e.preventDefault();
            return false;
        } else {
            $.ajax({
                type: "GET",
                url: "../../php/store/sanction-referral.php?violation_code=" + violationCode,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                    } else if (res.status == 200) {

                        $('#violation_id').val(res.data.id);
                        $('#offenseType').val(res.data.offense);
                        $('#violationDescription').val(res.data.violation);

                    }
                }
            });
        }
    });

    $(document).on('submit', '#referral', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("create_Referral", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/sanction-referral.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 422) {

                    toastr.warning(res.message, res.status);

                } else if (res.status == 401) {

                    toastr.error(res.message, res.status);
                    setTimeout(function() {
                        window.location.href = '../views/semester.php';
                    }, 1000);

                } else if (res.status == 200) {

                    toastr.success(res.message, res.status);
                    setTimeout(function() {
                        window.location.href = '../views/sanction-referral.php';
                    }, 1000);

                    console.log(res.console);

                } else if (res.status == 500) {

                    toastr.error(res.message, res.status);

                }
            }
        });

    });


    //NOTE this Ajax block of code will determine if the referral_id is has value meaning its going to update. if the value is null meaning add
    $(document).ready(function() {
        var referral_id = sessionStorage.getItem("sanction-referralID");
        console.log(referral_id);

        if (referral_id != null) {
            $.ajax({
                type: "GET",
                url: "../../php/store/sanction-referral.php?referral_id=" + referral_id,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                    } else if (res.status == 200) {

                        console.log(res.data)

                        firstName = res.data.first_name + ' ';
                        middleName = res.data.middle_name + ' ';
                        lastName = res.data.last_name

                        fullName = firstName + middleName + lastName;

                        $('#referral_id').val(res.data.id);

                        $('#student_id').val(res.data.student_id);
                        $('#Student').val(res.data.student_no);
                        $('#student_no').val(res.data.student_no);

                        $('#StudentFullName').val(fullName);
                        $('#Section').val(res.data.section);
                        $('#Age').val(res.data.age);
                        $('#Gender').val(res.data.gender);
                        $('#Course').val(res.data.program);

                        $('#violation_id').val(res.data.violation_id);
                        $('#violationCode').val(res.data.code);
                        $('#offenseType').val(res.data.offense);
                        $('#violationDescription').val(res.data.violation);

                        $('#complainerName').val(res.data.complainer_name);
                        $('#referredTo').val(res.data.referred);
                        $('#dateIssued').val(res.data.date);

                        //NOTE this two lines of code below will determine who manupulated the data
                        var label = document.getElementById('updated_by')
                        label.innerHTML = "Last interaction by: " + res.data.user_firstName + " " + res.data.user_lastName + " on " + moment(res.data.date_time).format('llll')

                        $("form").attr('id', 'Edit-referral')
                    }
                }
            });
        } else {
            $("form").attr('id', 'referral')
        }
    });

    $(document).on('submit', '#Edit-referral', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_Referral", true);

        $.ajax({
            type: "POST",
            url: "../../php/store/sanction-referral.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 422) {
                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    toastr.success(res.message, res.status);

                    //If button click submit, Found_id Session will be cleared
                    sessionStorage.clear('sanction-referralID');
                    setTimeout(function() {
                        window.location.href = '../views/sanction-referral.php';
                    }, 1000);

                } else if (res.status == 500) {
                    toastr.error(res.message, res.status);
                }
            }
        });
    });
</script>

<?php
include('../includes/forms/footer.php');
?>