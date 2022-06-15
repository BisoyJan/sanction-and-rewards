<?php
include('../includes/header.php');
include('../includes/navbar.php');
?>

<div class="container-fluid pt-5 ps-5 pe-5">
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="col">
            <div class="d-grid gap-2 d-flex justify-content-end">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addAccount">Add Button</button>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table" style="text-align: center;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>john@example.com</td>
                    <td>john@example.com</td>
                    <td>john@example.com</td>
                    <td>john@example.com</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->

<div class="modal fade" id="addAccount" tabindex="-1" aria-labelledby="addAccountLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="mb-3">

                    <form class="row g-3 requires-validation" id="account" novalidate>

                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <label for="validationFirstName" class="form-label">First name</label>
                                <input type="text" class="form-control" id="validationFirstName" name="firstName" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide First name.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationMiddleName" class="form-label">Middle name</label>
                                <input type="text" class="form-control" id="validationMiddleName" name="middleName" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Middle name.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationLastName" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="validationLastName" name="lastName" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Last name.
                                </div>
                            </div>
                        </div>

                        <div class="row pt-3 justify-content-center">
                            <div class="col-md-4">
                                <label for="validationCustomUsername" class="form-label">Username</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="text" class="form-control" id="validationCustomUsername" name="userName" aria-describedby="inputGroupPrepend" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please choose a Username.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationPassword" class="form-label">Password</label>
                                <div class="input-group">

                                    <input class="form-control" id="validationPassword" name="password" type="password" required />
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-eye" id="togglePassword" style="cursor: pointer"></i>
                                    </span>
                                    <div class="invalid-feedback">
                                        Please provide your Password.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationUserType" class="form-label">User Type</label>
                                <select class="form-select" id="validationUserType" name="userType" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>

                                </select>
                                <div class="invalid-feedback">
                                    Please select a User Type.
                                </div>
                            </div>
                        </div>


                        <div class="d-flex flex-row-reverse bd-highlight pt-3">
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </div>


                    </form>

                </div>

            </div>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#validationPassword");

        togglePassword.addEventListener("click", function(e) {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";

            password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("fa-eye-slash");
        }); // Show Password

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
        })(); // Bootstrap 5 Form Validation


        $(document).on('submit', '#account', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("create_Account", true)

            $.ajax({
                type: "POST",
                url: "../php/account.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response)
                    if (res.status == 422) {

                        toastr.warning(res.message, res.status);
                        console.log(res.console);

                    } else if (res.status == 200) {

                        toastr.success(res.message, res.status);
                        console.log(res.console);

                    } else if (res.status == 500) {

                        toastr.error(res.message, res.status);
                        console.log(res.console);

                    } else if (res.status == 401) {

                        toastr.error(res.message, res.status);
                    }
                }
            });

        });
    </script>

    <?php
    include('../includes/footer.php')
    ?>