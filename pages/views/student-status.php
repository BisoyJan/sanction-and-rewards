<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>

<div class="container-fluid pt-3 ps-5 pe-5">
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>Students Status Table</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search_box" id="search_box" placeholder="Search" aria-describedby="basic-addon2">
            </div>
        </div>
    </div>

    <div id="dynamicTable">
        <!-- The contents of  the tables at the ../php/fetchPaginate/studentTable.php -->

    </div>
</div>


<div class="modal fade" id="StudentModal" tabindex="-1" aria-labelledby="StudentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Student Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <form class="row g-3 requires-validation" id="Student" novalidate>
                        <div class="row justify-content-center pt-3">
                            <div class="col-md-4">
                                <input type="hidden" name="student_id" id="student_id">

                                <label for="studentNo" class="form-label">Referred</label>
                                <input type="number" class="form-control" id="studentNo" name="studentNo" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Student ID.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="firstName" class="form-label">First name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide First Name.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="middleName" class="form-label">Middle name</label>
                                <input type="text" class="form-control" id="middleName" name="middleName" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Middle Name.
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content- pt-3">
                            <div class="col-md-4">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Last Name.
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" min="1" max="100" class="form-control" id="age" name="age" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Age / Age limit 100
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please select a Gender.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Age.
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content pt-3">
                            <div class="col-md-2">
                                <label for="section" class="form-label">Section</label>
                                <input type="text" class="form-control" id="section" name="section" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Age.
                                </div>
                            </div>

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

<script>
    //To inject the table in fetchPaginate folder
    $(document).ready(function() {
        load_data(1);
    });

    function load_data(page = 1, query = '') {
        $.ajax({
            url: "../../php/fetchPaginate/student-statusTable.php",
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
</script>

<?php
include('../includes/main/footer.php')
?>