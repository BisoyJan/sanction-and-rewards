<?php
include('../includes/header.php');
include('../includes/navbar.php');
?>
<div class="container-fluid pt-5 ps-5 pe-5">
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>Students Table</h3>
            </div>
        </div>
        <div class="col">
            <div class="d-grid gap-2 d-flex justify-content-end">
                <button class="btn btn-primary" type="button">Add Button</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
        <form class="row g-3 requires-validation" id="Account" novalidate>
                        <div class="row justify-content-center pt-3">
                            <div class="col-md-4">
                                <input type="hidden" name="account_id" id="account_id">

                                <label for="firstName" class="form-label">First name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide First name.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="middleName" class="form-label">Middle name</label>
                                <input type="text" class="form-control" id="middleName" name="middleName" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Middle name.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="lastName" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
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
                                <label for="userType" class="form-label">User Type</label>
                                <select class="form-select" id="userType" name="userType" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>

                                </select>
                                <div class="invalid-feedback">
                                    Please select a User Type.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="userName" class="form-label">Username</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="text" class="form-control" id="userName" name="userName" aria-describedby="inputGroupPrepend" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please choose a Username.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="Password" class="form-label">Password</label>
                                <div class="input-group">

                                    <input class="form-control" id="Password" name="password" type="password" required />
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-eye" id="togglePassword" style="cursor: pointer"></i>
                                    </span>
                                    <div class="invalid-feedback">
                                        Please provide your Password.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse bd-highlight pt-3">
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </div>
                    </form>
        </div>
        <div class="col-8">

        </div>
    </div>

    <!-- <div class="table-responsive">
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
    </div> -->

</div>


<?php
include('../includes/footer.php')
?>