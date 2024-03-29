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
        top: 10%;
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
            <div class="container-fluid shadow p-3 mb-5 bg-body rounded-3 border border-2">

                <a href=" ../views/sanction-action.php">
                    <button class="btn btn-primary" type="submit" onclick="sessionStorage.clear('sanction-referralID');">Return</button>
                </a>

                <form class="row g-3 requires-validation d-flex justify-content-center" id="action" novalidate>

                    <div class="row pt-2 justify-content-center">

                        <div class="pt-4 d-flex justify-content-center">
                            <h5>Student Information</h5>
                        </div>

                        <div class="col-md-1">
                            <label for="returnee" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="Student" name="Student" readonly="readonly">
                            <input type="hidden" name="student_no" id="student_no">
                            <input type="hidden" name="student_id" id="student_id">
                            <input type="hidden" name="referral_id" id="referral_id">
                            <input type="hidden" name="action_id" id="action_id">
                            <input type="hidden" name="email_student" id="email_student">

                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" readonly="readonly" id="StudentFullName" name="StudentFullName">
                        </div>
                        <div class="col-md-1">
                            <label class="form-label">Section</label>
                            <input type="hidden" name="course_Abbreviation" id="course_Abbreviation">
                            <input type="text" class="form-control" readonly="readonly" id="Section" name="Section">
                        </div>
                        <div class="col-md-1">
                            <label class="form-label">Age</label>
                            <input type="text" class="form-control" readonly="readonly" id="Age" name="Age">
                        </div>
                        <div class="col-md-1">
                            <label class="form-label">Gender</label>
                            <input type="text" class="form-control" readonly="readonly" id="Gender" name="Gender">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Course</label>
                            <textarea class="form-control" aria-label="With textarea" readonly="readonly" id="Course" name="Course"></textarea>
                        </div>

                    </div>


                    <div class="row justify-content-center">
                        <div class="pt-5 d-flex justify-content-center">
                            <h5>Violation Information</h5>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Violation Code</label>
                            <input type="text" class="form-control" id="violationCode" name="violationCode" readonly="readonly">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Offense Type</label>
                            <input type="text" class="form-control" readonly="readonly" id="offenseType" name="offenseType">
                        </div>
                        <div class="col-lg-5">
                            <label class="form-label">Violation Description</label>
                            <textarea class="form-control" aria-label="With textarea" readonly="readonly" id="violationDescription" name="violationDescription" aria-describedby="inputGroupPrepend"></textarea>
                        </div>
                    </div>

                    <div class="row justify-content-center">

                        <div class="pt-5 d-flex justify-content-center">
                            <h5>Complainer and Referred Person Information</h5>
                        </div>

                        <div class="col-lg-3">
                            <label class="form-label">Complainer Name</label>
                            <input type="text" class="form-control" readonly="readonly" id="complainerName" name="complainerName" required>

                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Referred To</label>
                            <input type="text" class="form-control" readonly="readonly" id="referredTo" name="referredTo" required>
                        </div>

                    </div>

                    <div class="row justify-content-center">

                        <div class="pt-5 d-flex justify-content-center">
                            <h5>Time and Date</h5>
                        </div>

                        <div class="col-sm-2">
                            <label class="form-label">Committed Date</label>
                            <input type="date" class="form-control" name="committedDate" id="committedDate" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide Date.
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <label class="form-label">Committed Time</label>
                            <input type="Time" class="form-control" id="committedTime" name="committedTime" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide Time.
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <label class="form-label">Counselling Date</label>
                            <div class="input-group">
                                <input type="Date" class="form-control" id="counsellingDate" name="counsellingDate" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Date
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label class="form-label">Counselling Time</label>
                            <input type="time" class="form-control" id="counsellingTime" name="counsellingTime" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide Time.
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label class="form-label">Issued Date</label>
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

    //CRUD Function
    $(document).ready(function() {

        var action_id = sessionStorage.getItem('sanction-actionID');
        var referral_id = sessionStorage.getItem('sanction-referralID');
        var Function = sessionStorage.getItem('sanction-referralFunction');

        if (referral_id != null && Function == "Add") {

            $.ajax({
                type: "GET",
                url: "../../php/store/sanction-referral.php?referral_id=" + referral_id,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                    } else if (res.status == 200) {

                        firstName = res.data.first_name + ' ';
                        middleName = res.data.middle_name + ' ';
                        lastName = res.data.last_name

                        fullName = firstName + middleName + lastName;

                        $('#referral_id').val(res.data.id);

                        $('#student_id').val(res.data.student_id);
                        $('#Student').val(res.data.student_no);
                        $('#student_no').val(res.data.student_no);
                        $('#email_student').val(res.data.email);

                        $('#StudentFullName').val(fullName);
                        $('#Section').val(res.data.section);
                        $('#course_Abbreviation').val(res.data.abbreviation);
                        $('#Age').val(res.data.age);
                        $('#Gender').val(res.data.gender);
                        $('#Course').val(res.data.program);


                        $('#violationCode').val(res.data.code);
                        $('#offenseType').val(res.data.offense);
                        $('#violationDescription').val(res.data.violation);

                        $('#complainerName').val(res.data.complainer_name);
                        $('#referredTo').val(res.data.referred);

                        sessionStorage.clear('sanction-referralID');
                        sessionStorage.clear('sanction-referralFunction');

                    }
                }
            });

        } else {

            console.log(action_id);
            $.ajax({
                type: "GET",
                url: "../../php/store/sanction-action.php?action_id=" + action_id,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                    } else if (res.status == 200) {

                        console.log(res.data)

                        firstName = res.data.first_name + ' ';
                        middleName = res.data.middle_name + ' ';
                        lastName = res.data.last_name

                        fullName = firstName + middleName + lastName;

                        $('#referral_id').val(res.data.sanction_referral_id);
                        $('#action_id').val(res.data.id);

                        $('#student_id').val(res.data.student_id);
                        $('#Student').val(res.data.student_no);
                        $('#student_no').val(res.data.student_no);
                        $('#email_student').val(res.data.email);

                        $('#StudentFullName').val(fullName);
                        $('#Section').val(res.data.section);
                        $('#course_Abbreviation').val(res.data.abbreviation);
                        $('#Age').val(res.data.age);
                        $('#Gender').val(res.data.gender);
                        $('#Course').val(res.data.program);

                        $('#violationCode').val(res.data.code);
                        $('#offenseType').val(res.data.offense);
                        $('#violationDescription').val(res.data.violation);

                        $('#complainerName').val(res.data.complainer_name);
                        $('#referredTo').val(res.data.referred);

                        $('#committedDate').val(res.data.committed_date);
                        $('#committedTime').val(res.data.committed_time);
                        $('#counsellingDate').val(res.data.counselling_date);
                        $('#counsellingTime').val(res.data.counselling_time);
                        $('#dateIssued').val(res.data.issual_date);

                        $("form").attr('id', 'Edit-action')

                        var label = document.getElementById('updated_by')
                        label.innerHTML = "Last interaction by: " + res.data.user_firstName + " " + res.data.user_lastName + " on " + moment(res.data.date_time).format('llll')

                    } else if (res.status == 404) {
                        toastr.error(res.message, res.status);
                    }
                }
            });
        }

    });

    $(document).on('submit', '#action', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("create_Action", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/sanction-action.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 422) {

                    toastr.warning(res.message, res.status);

                } else if (res.status == 401) {

                    toastr.error(res.message, res.status);
                    console.log(res.console);

                } else if (res.status == 200) {

                    toastr.success(res.message, res.status);
                    sessionStorage.clear('sanction-actionID');
                    sessionStorage.clear('sanction-referralFunction');
                    setTimeout(function() {
                        window.location.href = '../views/sanction-action.php';
                    }, 1000);

                } else if (res.status == 500) {

                    toastr.error(res.message, res.status);

                }
            }
        });

    });

    $(document).on('submit', '#Edit-action', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_Action", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/sanction-action.php",
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

                    toastr.success(res.message, res.status);
                    sessionStorage.clear('sanction-actionID');
                    sessionStorage.clear('sanction-referralID');
                    sessionStorage.clear('sanction-counselFunction');
                    //If button click submit, Session ID's will be cleared
                    setTimeout(function() {
                        window.location.href = '../views/sanction-action.php';
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