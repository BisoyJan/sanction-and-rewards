<?php
include('../includes/forms/header.php');
?>

<style>
    .Absolute-Center {
        height: 100%;
        /* Set your own height: percents, ems, whatever! */
        width: 90%;
        /* Set your own width: percents, ems, whatever! */
        overflow: auto;
        /* Recommended in case content is larger than the container */
        margin: auto;
        /* Center the item vertically & horizontally */
        position: absolute;
        /* Break it out of the regular flow */
        top: 5%;
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

                <a href=" ../views/sanction-counselling.php">
                    <button class="btn btn-primary" type="submit" onclick="sessionStorage.clear('sanction-counselID');">Return</button>
                </a>

                <form class="row g-3 requires-validation d-flex justify-content-center" id="counselling" novalidate>

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
                            <input type="hidden" name="counselling_id" id="counselling_id">

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
                            <textarea class="form-control" aria-label="With textarea" readonly="readonly" id="Course" name="Course" aria-describedby="inputGroupPrepend" required></textarea>
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
                            <h5>Details</h5>
                        </div>

                        <div class="col-lg-5">
                            <label class="form-label">Incident Report</label>
                            <textarea type="text" class="form-control" id="incidentReport" name="incidentReport" aria-label="With textarea" aria-describedby="inputGroupPrepend" required></textarea>
                        </div>

                        <div class="col-lg-5">
                            <label class="form-label">Resolution</label>
                            <textarea type="text" class="form-control" id="resolution" name="resolution" aria-label="With textarea" aria-describedby="inputGroupPrepend" required></textarea>
                        </div>

                    </div>

                    <div class="row justify-content-center">

                        <div class="pt-5 d-flex justify-content-center">
                            <h5>Report Given By</h5>
                        </div>

                        <div class="col-lg-3">
                            <label class="form-label">Chairman</label>
                            <input type="text" class="form-control" id="Chairman" name="Chairman" aria-label="With textarea" aria-describedby="inputGroupPrepend" required></inp>
                        </div>

                        <div class="col-lg-3">
                            <label class="form-label">Members</label>
                            <textarea type="text" class="form-control" id="Members" name="Members" aria-label="With textarea" aria-describedby="inputGroupPrepend" required></textarea>
                        </div>
                    </div>

                    <div class="row justify-content-center">

                        <div class="pt-5 d-flex justify-content-center">
                            <h5>Recommendations</h5>
                        </div>

                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recommendations" id="closedResolved" value="Closed/Resolved">
                                <label class="form-check-label" for="closedResolved">
                                    Closed/Resolved
                                </label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recommendations" id="formalInvestigation" value="For Formal Investigation">
                                <label class="form-check-label" for="formalInvestigation">
                                    For Formal Investigation
                                </label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input EnableDate" type="radio" name="recommendations" id="continuingHearing" value="For Continuing Hearing">
                                <label class="form-check-label" for="continuingHearing">
                                    For Continuing Hearing - Hearing Date
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <input type="date" class="form-control" name="hearingDate" id="hearingDate" disabled="disabled" required>
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

    $(document).ready(function() {
        $('input[name="recommendations"]').on('click', function() {
            if ($(this).val() === 'For Continuing Hearing') {
                $('#hearingDate').removeAttr('disabled').focus();
            } else {
                $('#hearingDate').attr('disabled', 'disabled');
            }
        });
    });

    //CRUD Function
    $(document).ready(function() {

        var action_id = sessionStorage.getItem('sanction-actionID');
        var counsel_id = sessionStorage.getItem('sanction-counselID');
        var Function = sessionStorage.getItem('sanction-counselFunction');

        if (action_id != null && Function == "Add") {

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

                        $('#action_id').val(res.data.id);

                        $('#student_id').val(res.data.student_id);
                        $('#Student').val(res.data.student_no);
                        $('#student_no').val(res.data.student_no);

                        $('#StudentFullName').val(fullName);
                        $('#Section').val(res.data.section);
                        $('#course_Abbreviation').val(res.data.abbreviation);
                        $('#Age').val(res.data.age);
                        $('#Gender').val(res.data.gender);
                        $('#Course').val(res.data.program);

                        $('#violation_id').val(res.data.violation_id);
                        $('#violationCode').val(res.data.code);
                        $('#offenseType').val(res.data.offense);
                        $('#violationDescription').val(res.data.violation);
                        $('#referral_id').val(res.data.sanction_referral_id);

                    }
                }
            });

        } else {
            $.ajax({
                type: "GET",
                url: "../../php/store/sanction-counselling.php?counsel_id=" + counsel_id,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                    } else if (res.status == 200) {

                        console.log(res.data)

                        firstName = res.data.first_name + ' ';
                        middleName = res.data.middle_name + ' ';
                        lastName = res.data.last_name

                        fullName = firstName + middleName + lastName;

                        $('#counselling_id').val(res.data.id);
                        $('#action_id').val(res.data.sanction_disciplinary_action_id);
                        $('#referral_id').val(res.data.referral_id);

                        $('#student_id').val(res.data.student_id);
                        $('#Student').val(res.data.student_no);
                        $('#student_no').val(res.data.student_no);

                        $('#StudentFullName').val(fullName);
                        $('#Section').val(res.data.section);
                        $('#course_Abbreviation').val(res.data.abbreviation);
                        $('#Age').val(res.data.age);
                        $('#Gender').val(res.data.gender);
                        $('#Course').val(res.data.program);

                        $('#violation_id').val(res.data.violation_id);
                        $('#violationCode').val(res.data.code);
                        $('#offenseType').val(res.data.offense);
                        $('#violationDescription').val(res.data.violation);

                        $('#incidentReport').val(res.data.report);
                        $('#resolution').val(res.data.resolution);

                        $('#Chairman').val(res.data.chairman);
                        $('#Members').val(res.data.members);

                        for (const [index, input] of document.forms[0].recommendations.entries())
                            if (input.value === res.data.recommend) {
                                input.checked = true
                            }

                        $('#hearingDate').val(res.data.hearing_date);
                        $('#hearingDate').removeAttr('disabled');

                        $("form").attr('id', 'edit-counsel')

                        var label = document.getElementById('updated_by')
                        label.innerHTML = "Last interaction by: " + res.data.user_firstName + " " + res.data.user_lastName + " on " + moment(res.data.date_time).format('llll')

                    }
                }
            });
        }
    });

    $(document).on('submit', '#counselling', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("create_Counsel", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/sanction-counselling.php",
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

                    console.log(res.console);

                    sessionStorage.clear('sanction-actionID');
                    sessionStorage.clear('sanction-counselFunction');

                    setTimeout(function() {
                        window.location.href = '../views/sanction-counselling.php';
                    }, 1000);

                } else if (res.status == 500) {

                    toastr.error(res.message, res.status);

                }
            }
        });

    });

    $(document).on('submit', '#edit-counsel', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_Counsel", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/sanction-counselling.php",
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
                    sessionStorage.clear('sanction-counselID');
                    sessionStorage.clear('sanction-counselFunction');

                    //If button click submit, Found_id Session will be cleared
                    setTimeout(function() {
                        window.location.href = '../views/sanction-counselling.php';
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