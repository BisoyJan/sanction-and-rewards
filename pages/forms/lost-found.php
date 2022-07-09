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
        top: 15%;
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
            bottom: 0;
            right: 0;
            /* Set the bounds in which to center it, relative to its parent/container */

        }
    }
</style>

<div class="Center-Container">
    <div class="Absolute-Center is-Fixed">
        <div class="container-fluid">
            <div class="container-sm shadow p-3 mb-5 bg-body rounded-3 border border-2">

                <a href="../views/lost-found.php">
                    <button class="btn btn-primary" type="submit" onclick="sessionStorage.clear('Found_id');">Return</button>
                </a>

                <form class="row g-3 requires-validation  d-flex justify-content-center"" id=" lost-found" novalidate>
                    <div class="pt-2 d-flex justify-content-center">
                        <h5>Returnee Information</h5>
                    </div>
                    <div class="row ">
                        <div class="col-lg-3">
                            <label for="returnee" class="form-label">Returnee Student No.</label>
                            <input type="number" class="form-control" id="returnee" name="returnee" placeholder="Student Number">
                            <input type="hidden" name="returnee_id" id="returnee_id">
                            <input type="hidden" name="lost-foundID" id="lost-foundID">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" readonly="readonly" id="returneeFullName" name="returneeFullName">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Section</label>
                            <input type="text" class="form-control" readonly="readonly" id="returneeSection" name="returneeSection">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Course</label>
                            <input type="text" class="form-control" readonly="readonly" id="returneeCourse" name="returneeCourse">
                        </div>
                    </div>

                    <div class="pt-2 d-flex justify-content-center">
                        <h5>Retrieval Information</h5>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-3">
                            <label for="returnee" class="form-label">Retrieval Student No.</label>
                            <input type="number" class="form-control" id="retrieval" placeholder="Student Number">
                            <input type="hidden" name="retrieval_id" id="retrieval_id">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" readonly="readonly" id="retrievalFullName" name="retrievalFullName">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Section</label>
                            <input type="text" class="form-control" readonly="readonly" id="retrievalSection" name="retrievalSection">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Course</label>
                            <input type="text" class="form-control" readonly="readonly" id="retrievalCourse" name="retrievalCourse">
                        </div>
                    </div>

                    <div class="pt-2 d-flex justify-content-center">
                        <h5>Item Information</h5>
                    </div>

                    <div class="row pt-3">
                        <div class="col-lg-4">
                            <label for="itemImage" class="form-label">Select Item Image</label>
                            <div class="input-group">
                                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#viewImage">View</button>
                                <input type="file" class="form-control" id="itemImage" name="itemImage" accept=".jpg,.jpeg,.png" onChange="img_pathUrl(this);" required>
                                <input type="hidden" name="oldImage" id="oldImage">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please Select File.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label for="itemType" class="form-label">Item Type</label>
                            <input type="text" class="form-control" id="itemType" name="itemType" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide Item Type.
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="itemDescription" class="form-label">Description</label>
                            <div class="input-group has-validation">
                                <textarea class="form-control" aria-label="With textarea" id="itemDescription" name="itemDescription" placeholder="Described the Item color, brand" aria-describedby="inputGroupPrepend" required></textarea>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please Type Description.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label for="status" class="form-label">Status</label>
                            <div class="input-group has-validation">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="surrenderedRadio" value="Surrendered" required>
                                    <label class="form-check-label" for="Surrendered">Surrendered</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="retrievedRadio" value="Retrieved" required>
                                    <label class="form-check-label" for="Retrieved">Retrieved</label>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Select Status.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2 d-flex justify-content-center">
                        <h5>Dates</h5>
                    </div>

                    <div class="row pt-3 d-flex justify-content-center">
                        <div class="col-md-2">
                            <label for="surrenderedDate" class="form-label">Surrendered Date</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="surrenderedDate" id="surrenderedDate" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please Select Date.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="userName" class="form-label">Found Date</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="foundDate" id="foundDate" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please Select Date.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="userName" class="form-label">Retrieval Date</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="retrievalDate" id="retrievalDate">
                            </div>
                        </div>
                    </div>

                    <div class=" bd-highlight pt-3">
                        <div class="row">
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

<div class="modal fade" id="warningModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Notice!</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>You need to select again an image if you edit the data for security purposes.</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
    //When Selecting Image in input file the selected image will be loaded to view image modal
    function img_pathUrl(input) {
        $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
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

    $(document).on('keyup keypress', '#returnee', function(e) {
        var student_id = $('#returnee').val();

        if (e.which == 13) {
            e.preventDefault();
            return false;
        } else {
            $.ajax({
                type: "GET",
                url: "../../php/store/lost-found.php?student_id=" + student_id,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                    } else if (res.status == 200) {

                        firstName = res.data.first_name + ' ';
                        middleName = res.data.middle_name + ' ';
                        lastName = res.data.last_name

                        fullName = firstName + middleName + lastName;

                        $('#returnee_id').val(res.data.student_no);
                        $('#returneeFullName').val(fullName);
                        $('#returneeSection').val(res.data.section);
                        $('#returneeCourse').val(res.data.abbreviation);
                    }
                }
            });
        }
    });

    $(document).on('keyup keypress', '#retrieval', function(e) {
        var student_id = $('#retrieval').val();

        if (e.which == 13) {
            e.preventDefault();
            return false;
        } else {
            $.ajax({
                type: "GET",
                url: "../../php/store/lost-found.php?student_id=" + student_id,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                    } else if (res.status == 200) {

                        firstName = res.data.first_name + ' ';
                        middleName = res.data.middle_name + ' ';
                        lastName = res.data.last_name

                        fullName = firstName + middleName + lastName;

                        $('#retrieval_id').val(res.data.student_no);
                        $('#retrievalFullName').val(fullName);
                        $('#retrievalSection').val(res.data.section);
                        $('#retrievalCourse').val(res.data.abbreviation);
                    }
                }
            });
        }
    });


    $(document).ready(function() {
        var found_id = sessionStorage.getItem("Found_id");
        console.log(found_id);

        if (found_id != null) {
            $.ajax({
                type: "GET",
                url: "../../php/store/lost-found.php?lost-found-id=" + found_id,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                    } else if (res.status == 200) {

                        console.log(res.data)

                        //oldImage = res.data.picture


                        $('#oldImage').val(res.data.picture);

                        $('#lost-foundID').val(res.data.id);
                        $('#returnee').val(res.data.student_id);
                        $('#returnee_id').val(res.data.student_id);

                        $('#retrieval').val(res.data.retrieval_id);
                        $('#retrieval_id').val(res.data.retrieval_id);

                        $('#itemType').val(res.data.type);
                        $('#itemDescription').val(res.data.description);

                        for (const [index, input] of document.forms[0].inlineRadioOptions.entries())
                            if (input.value === res.data.remarks) {
                                input.checked = true
                            }

                        $('#surrenderedDate').val(res.data.date_surrendered);
                        $('#foundDate').val(res.data.date_found);
                        $('#retrievalDate').val(res.data.date_retrieved);

                        $("form").attr('id', 'Edit-lost-found')

                        $("#warningModal").modal("show")
                    }
                }
            });

        } else {
            $("form").attr('id', 'lost-found')
        }

    });

    $(document).on('submit', '#lost-found', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("create_Lost-Found", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/lost-found.php",
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

                    toastr.success(res.message, res.status);
                    console.log(res.console);

                } else if (res.status == 500) {

                    toastr.error(res.message, res.status);
                    console.log(res.console);

                }
            }
        });

    });


    $(document).on('submit', '#Edit-lost-found', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_Lost-Found", true);

        $.ajax({
            type: "POST",
            url: "../../php/store/lost-found.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 422) {
                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    toastr.success(res.message, res.status);
                    console.log(res.console);

                    //If button click submit, Found_id Session will be cleared
                    sessionStorage.clear('Found_id');

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