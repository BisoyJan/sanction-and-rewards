<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>

<div class="container-fluid pt-3 ps-5 pe-5">
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>Outstanding Athlete Awards Table</h3>
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
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="formIDChangeAdd()" data-bs-target="#GoodDeedsModal">Add Button</button>
            </div>
        </div>
    </div>

    <div id="dynamicTable">
        <!-- The contents of  the tables at the ../php/fetchPaginate/ -->


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


</div>

<script>


</script>

<?php
include('../includes/main/footer.php')
?>