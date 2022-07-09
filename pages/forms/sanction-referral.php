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
        bottom: 15%;
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
                    <button class="btn btn-primary" type="submit" onclick="sessionStorage.clear('Found_id');">Return</button>
                </a>

                <form class="row g-3 requires-validation d-flex justify-content-center" id=" lost-found" novalidate>
                    <div class="pt-2 d-flex justify-content-center">
                        <h5>Student Information</h5>
                    </div>
                    <div class="row ">
                        <div class="col-lg-2">
                            <label for="returnee" class="form-label">Student ID</label>
                            <input type="number" class="form-control" id="student" name="returnee" placeholder="Student Number">
                            <input type="hidden" name="student_id" id="student_id">
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" readonly="readonly" id="studentFullName" name="returneeFullName">
                        </div>
                        <div class="col-sm-1">
                            <label class="form-label">Section</label>
                            <input type="text" class="form-control" readonly="readonly" id="returneeSection" name="returneeSection">
                        </div>
                        <div class="col-sm-1">
                            <label class="form-label">Age</label>
                            <input type="text" class="form-control" readonly="readonly" id="returneeSection" name="returneeSection">
                        </div>
                        <div class="col-sm-1">
                            <label class="form-label">Gender</label>
                            <input type="text" class="form-control" readonly="readonly" id="returneeSection" name="returneeSection">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Course</label>
                            <textarea class="form-control" aria-label="With textarea" readonly="readonly" id="itemDescription" name="itemDescription" aria-describedby="inputGroupPrepend" required></textarea>
                        </div>
                    </div>

                    <div class="pt-2 d-flex justify-content-center">
                        <h5>Violation Information</h5>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-2">
                            <label class="form-label">Violation Code</label>
                            <input type="text" class="form-control" id="retrieval">
                            <input type="hidden" name="retrieval_id" id="retrieval_id">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Offense Type</label>
                            <input type="text" class="form-control" readonly="readonly" id="retrievalFullName" name="retrievalFullName">
                        </div>
                        <div class="col-lg-5">
                            <label class="form-label">Violation Description</label>
                            <textarea class="form-control" aria-label="With textarea" readonly="readonly" id="itemDescription" name="itemDescription" aria-describedby="inputGroupPrepend" required></textarea>
                        </div>
                    </div>

                    <div class="pt-2 d-flex justify-content-center">
                        <h5>Referral Information</h5>
                    </div>

                    <div class="row pt-3 d-flex justify-content-center">
                        <div class="col-lg-3">
                            <label for="itemImage" class="form-label">Complainer Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="itemImage" name="itemImage" accept=".jpg,.jpeg,.png" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please Select File.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label for="itemType" class="form-label">Referred To</label>
                            <input type="text" class="form-control" id="itemType" name="itemType" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide Item Type.
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="userName" class="form-label">Date Issued</label>
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


<?php
include('../includes/forms/footer.php');
?>