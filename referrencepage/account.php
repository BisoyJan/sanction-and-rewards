<?php
include('../includes/header.php');
include('../includes/navbar.php');
?>

<div class="container-fluid pt-5 ps-5 pe-5">
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <h3>Accounts Table</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="search" onkeyup="myFunction()" placeholder="Search" aria-describedby="basic-addon2">
            </div>
        </div>
        <div class="col">
            <div class="d-grid gap-2 d-flex justify-content-end">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" id="accountAddButton" onclick="formIDChangeAdd()" data-bs-target="#AccountModal">Add Button</button>
            </div>
        </div>
    </div>

    <div>
        <table id="accountTable" class="table table-hover" style="text-align: center;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Type</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 10;
                $offset = ($pageno - 1) * $no_of_records_per_page;

                $total_pages_sql = "SELECT COUNT(*) FROM users";
                $result = mysqli_query($con, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                $sql = "SELECT * FROM users LIMIT $offset, $no_of_records_per_page";
                $res_data = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($res_data)) { ?>

                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['type'] ?></td>
                        <td><?= $row['first_name'] ?></td>
                        <td><?= $row['middle_name'] ?></td>
                        <td><?= $row['last_name'] ?></td>
                        <td><button class="accountEditButton btn btn-success" value="<?= $row['id'] ?>" onclick="formIDChangeEdit()" type="button" data-bs-toggle="modal" data-bs-target="#AccountModal">Edit Button</button>
                            <button class="accountDeleteButton btn btn-danger" value="<?= $row['id'] ?>" type="button" data-bs-toggle="modal" data-bs-target="#AccountDeleteModal">Delete Button</button>
                        </td>
                    </tr>

                <?php } ?>

            </tbody>
        </table>
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
            <li class=" <?php if ($pageno <= 1) {
                            echo 'disabled';
                        } ?> page-item">
                <a class="page-link" href="<?php if ($pageno <= 1) {
                                                echo '#';
                                            } else {
                                                echo "?pageno=" . ($pageno - 1);
                                            } ?>">Prev</a>
            </li>
            
            <li class="<?php if ($pageno >= $total_pages) {
                            echo 'disabled';
                        } ?> page-item">
                <a class="page-link" href="<?php if ($pageno >= $total_pages) {
                                                echo '#';
                                            } else {
                                                echo "?pageno=" . ($pageno + 1);
                                            } ?>">Next</a>
            </li>
            <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
        </ul>
    </div>
</div>

<!-- Modal -->

<div class="modal fade" id="AccountModal" tabindex="-1" aria-labelledby="AccountLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Add Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
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
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
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
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="AccountDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="deleteAccount">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure to delete this account?</h6>
                    <input type="hidden" name="delete_account_id" id="delete_account_id">

                </div>
                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" class="confirmDeleteAccount btn btn-primary " type="submit">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("accountTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    //PasswordShow
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#Password");

    togglePassword.addEventListener("click", function(e) {

        const type = password.getAttribute("type") === "password" ? "text" : "password";

        password.setAttribute("type", type);
        this.classList.toggle("fa-eye-slash");
    });

    //Form ID Change click of the button
    function formIDChangeAdd() {
        $("form").attr('id', 'Account')
        var label = document.getElementById('ModalLabel');
        label.innerHTML = "Add Account";
    };

    function formIDChangeEdit() {
        $("form").attr('id', 'EditAccount')
        var label = document.getElementById('ModalLabel');
        label.innerHTML = "Edit Account";
    }


    //Function to use same button but button has Different ID to show the modal
    $('#accountModal').on('shown.bs.modal', function(e) {
        const buttonId = e.relatedTarget.id;
        $(this).find('.modal-body').text(`Button id = ${buttonId}`);
    });

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


    // CRUD function 
    $(document).on('click', '.accountEditButton', function() {
        var account_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../php/store/account.php?account_id=" + account_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {


                    $('#account_id').val(res.data.id);
                    $('#userName').val(res.data.username);
                    $('#userType').val(res.data.type);
                    $('#firstName').val(res.data.first_name);
                    $('#middleName').val(res.data.middle_name);
                    $('#lastName').val(res.data.last_name);
                }
            }
        });

    });

    $(document).on('click', '.accountDeleteButton', function() {
        var account_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "../php/store/account.php?account_id=" + account_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    toastr.warning(res.message, res.status);
                } else if (res.status == 200) {

                    $('#delete_account_id').val(res.data.id);
                }
            }
        });

    });

    $(document).on('submit', '#Account', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("create_Account", true)

        $.ajax({
            type: "POST",
            url: "../php/store/account.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 422) {

                    toastr.warning(res.message, res.status);
                    console.log(res.console);

                } else if (res.status == 200) {

                    $('#accountTable').load(location.href + " #accountTable");
                    $('#AccountModal').modal('hide');
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

    $(document).on('submit', '#EditAccount', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_account", true);

        $.ajax({
            type: "POST",
            url: "../php/store/account.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 422) {

                    toastr.warning(res.message, res.status);

                } else if (res.status == 200) {


                    $('#accountTable').load(location.href + " #accountTable");
                    toastr.success(res.message, res.status);
                    console.log(res.console);

                } else if (res.status == 500) {

                    toastr.error(res.message, res.status);

                }
            }
        });
    });

    $(document).on('submit', '#deleteAccount', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("delete_account", true);

        $.ajax({
            type: "POST",
            url: "../php/store/account.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response)
                if (res.status == 200) {


                    $('#accountTable').DataTable();
                    $('#AccountDeleteModal').modal('hide');
                    toastr.success(res.message, res.status);
                    console.log(res.console);

                } else if (res.status == 500) {
                    toastr.error(res.message, res.status);
                }
            }
        });
    });
</script>

<?php
include('../includes/footer.php')
?>