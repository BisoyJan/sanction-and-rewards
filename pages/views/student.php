<?php
include('../includes/main/header.php');
include('../includes/main/navbar.php');
?>

<div class="container-fluid pt-3 px-4">
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>Students Table</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="d-grid gap-2 mb-3 d-flex justify-content-end">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" id="studentAddButton" onclick="formIDChangeAdd()" data-bs-target="#StudentModal">Add Student</button>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="studentTable" class="table table-hover" style="text-align: center;">
            <thead>
                <th>ID</th>
                <th>Student Number</th>
                <th style="width:15%;">Full Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Section</th>
                <th style="width:20%;">Program</th>
                <th>College</th>
                <th>Actions</th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="StudentModal" tabindex="-1" aria-labelledby="StudentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <form class="row g-3 requires-validation" id="Student" novalidate>
                        <div class="row justify-content-center pt-3">
                            <div class="col-md-4">
                                <input type="hidden" name="student_id" id="student_id">

                                <label for="studentNo" class="form-label">Student ID</label>
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
                                    Please provide Email.
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
                                    Please provide Section.
                                </div>
                            </div>
                            <div class="col">
                                <label for="program" class="form-label">Program</label>
                                <select class="form-select" id="program" name="program" required>
                                    <option selected disabled value="">Select Program</option>

                                    <?php
                                    $query = "SELECT * FROM `programs`";
                                    $result = $con->query($query);
                                    if ($result->num_rows > 0) {
                                        while ($optionData = $result->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $optionData['id']; ?>"><?php echo $optionData['program_name']; ?></option>
                                    <?php }
                                    } ?>

                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please select a College.
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

<div class="modal fade" id="StudentDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="deleteStudent">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure to delete this Account?</h6>
                    <input type="hidden" name="delete_student_id" id="delete_student_id">

                </div>
                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary deleteStudent" type="submit">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#studentTable').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
                'url': '../../php/fetchPaginate/studentTable.php',
                'type': 'post',
            },
            "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [8]
                },

            ]
        });
    });

    //Form ID Change click of the button
    function formIDChangeAdd() {
        $("form").attr('id', 'Student')
        $('#Student')[0].reset();
        var label = document.getElementById('ModalLabel');
        label.innerHTML = "Add Student";
    };

    function formIDChangeEdit() {
        $("form").attr('id', 'EditStudent')
        var label = document.getElementById('ModalLabel');
        label.innerHTML = "Edit Student";
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

    //CRUD Function
    $(document).on('click', '.studentEditButton', function() {
        var student_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/student.php?student_id=" + student_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);

                } else if (res.status == 200) {

                    console.log(res.data)

                    $('#student_id').val(res.data.id);
                    $('#studentNo').val(res.data.student_no);
                    $('#firstName').val(res.data.first_name);
                    $('#middleName').val(res.data.middle_name);
                    $('#lastName').val(res.data.last_name);
                    $('#age').val(res.data.age);
                    $('#gender').val(res.data.gender);
                    $('#email').val(res.data.email);
                    $('#section').val(res.data.section);
                    $('#program').val(res.data.program_id);
                }
            }
        });

    });

    $(document).on('click', '.studentDeleteButton', function() {
        var student_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../../php/store/student.php?student_id=" + student_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    console.log(res.data)
                    $('#delete_student_id').val(res.data.id);
                }
            }
        });

    });

    $(document).on('submit', '#Student', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("create_Student", true)

        $.ajax({
            type: "POST",
            url: "../../php/store/student.php",
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

                    mytable = $('#studentTable').DataTable();
                    mytable.draw();
                    $('#Student')[0].reset();
                    $('#StudentModal').modal('hide');

                    toastr.success(res.message, res.status);
                    console.log(res.console);

                } else if (res.status == 500) {

                    toastr.error(res.message, res.status);
                    console.log(res.console);
                }
            }
        });

    });

    $(document).on('submit', '#EditStudent', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_Student", true);

        $.ajax({
            type: "POST",
            url: "../../php/store/student.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 422) {
                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    mytable = $('#studentTable').DataTable();
                    mytable.draw();
                    $('#EditStudent')[0].reset();
                    $('#StudentModal').modal('hide');

                    toastr.success(res.message, res.status);
                    console.log(res.console);

                } else if (res.status == 500) {
                    toastr.error(res.message, res.status);
                }
            }
        });
    });

    $(document).on('click', '.deleteStudent', function(e) {
        e.preventDefault();

        var formData = $("#delete_student_id").val()

        $.ajax({
            type: "POST",
            url: "../../php/store/student.php",
            data: {
                'delete_Student': true,
                'delete_student_id': formData
            },
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {


                    mytable = $('#studentTable').DataTable();
                    mytable.draw();
                    $('#StudentDeleteModal').modal('hide');
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