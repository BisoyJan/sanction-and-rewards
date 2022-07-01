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
            <form class="row g-3 requires-validation" id="Account" novalidate>
                <div class="row pt-3 justify-content-center">
                    <div class="col-lg-3">
                        <label for="userType" class="form-label">User Type</label>
                        <select class="form-select" id="userType" name="userType" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>

                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a User Type.
                        </div>
                    </div>
                    <div class="col-lg-3">
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
                    <div class="col-lg-3">
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
                    <div class="col-lg-3">
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

                <div class="row  pt-3">
                    <div class="col-lg-3">
                        <input type="hidden" name="account_id" id="account_id">

                        <label for="formFile" class="form-label">Default file input example</label>
                        <input class="form-control" type="file" id="formFile">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide First name.
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label for="middleName" class="form-label">Item Type</label>
                        <input type="text" class="form-control" id="middleName" name="middleName" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide Middle name.
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="userName" class="form-label">Program</label>
                        <div class="input-group has-validation">
                            <textarea class="form-control" aria-label="With textarea" id="program" name="program" placeholder="Ex. Bachelor of Science in Information Technology" aria-describedby="inputGroupPrepend" required></textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Type Program.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label for="userName" class="form-label">Program</label>
                        <div class="input-group has-validation">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">1</label>
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

                <div class="d-flex flex-row-reverse bd-highlight pt-3">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
            </form>
        </div>

    </div>
    <?php
    include('../includes/forms/footer.php');
    ?>