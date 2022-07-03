<?php
include('../includes/forms/header.php');
?>

<div class="container-fluid pt-3 ps-5 pe-5">

    <div class="shadow-lg p-3 mb-5 bg-body rounded" style="position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 140vh;">

        <div class="container">
            <form class="row g-3 requires-validation" id="lost-found" novalidate>
                <div class="pt-2 d-flex justify-content-center">
                    <h5>Returnee Information</h5>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-3">
                        <label for="returnee" class="form-label">Returnee Student No.</label>
                        <input type="number" class="form-control" id="returnee" name="returnee" placeholder="Student Number">
                        <input type="hidden" name="returnee_id" id="returnee_id">
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

                <div class="row  pt-3">
                    <div class="col-lg-3">
                        <label for="formFile" class="form-label">Select File</label>
                        <input class="form-control" type="file" id="formFile" name="formFile">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide First name.
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label for="itemType" class="form-label">Item Type</label>
                        <input type="text" class="form-control" id="itemType" name="itemType" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide Middle name.
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="itemDescription" class="form-label">Description</label>
                        <div class="input-group has-validation">
                            <textarea class="form-control" aria-label="With textarea" id="itemDescription" name="itemDescription" placeholder="Ex. Bachelor of Science in Information Technology" aria-describedby="inputGroupPrepend" required></textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Type Program.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label for="status" class="form-label">Status</label>
                        <div class="input-group has-validation">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="surrenderedRadio" value="Surrendered">
                                <label class="form-check-label" for="Surrendered">Surrendered</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="RetrievedRadio" value="Retrieved">
                                <label class="form-check-label" for="Retrieved">Retrieved</label>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Type Program.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-2 d-flex justify-content-center">
                    <h5>Dates</h5>
                </div>

                <div class="row pt-3 d-flex justify-content-center">
                    <div class="col-lg-3">
                        <label for="surrenderedDate" class="form-label">Surrendered Date</label>
                        <div class="input-group">
                            <input type="date" class="form-control" name="surrenderedDate" id="surrenderedDate">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label for="userName" class="form-label">Found Date</label>
                        <div class="input-group">
                            <input type="date" class="form-control" name="foundDate" id="foundDate">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label for="userName" class="form-label">Retrieval Date</label>
                        <div class="input-group">
                            <input type="date" class="form-control" name="retrievalDate" id="retrievalDate">
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-row-reverse bd-highlight pt-3">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
            </form>
        </div>

    </div>

    <script>
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

                            $('#returnee_id').val(res.data.id);
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

                            $('#retrieval_id').val(res.data.id);
                            $('#retrievalFullName').val(fullName);
                            $('#retrievalSection').val(res.data.section);
                            $('#retrievalCourse').val(res.data.abbreviation);
                        }
                    }
                });
            }
        });
    </script>

    <?php
    include('../includes/forms/footer.php');
    ?>