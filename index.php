<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Leyte Normal University</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/toastr/toastr.min.css">
</head>

<body>
    <div class="center">
        <h1>Welcome</h1>
        <form id="login">
            <div class="txt_field">
                <input type="text" name="username" class="form-control">
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" class="form-control">
                <span></span>
                <label>Password</label>
            </div>
            <input type="submit" value="Login">
            <div class="signup_link">
                LNU VPSDAS
            </div>
        </form>
    </div>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/toastr/toastr.min.js"></script>

    <script>
        $(document).on('submit', '#login', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("login_user", true)

            $.ajax({
                type: "POST",
                url: "php/authentication/login.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response)
                    if (res.status == 422) {
                        toastr.warning(res.message, res.status);
                        console.log(res.console);
                    } else if (res.status == 200) {
                        console.log(res.console);
                        window.location = "pages/views/index.php";


                    } else if (res.status == 401) {
                        toastr.warning(res.message, res.status);
                        console.log(res.console)

                    }

                }
            });
        });
    </script>


</body>

</html>