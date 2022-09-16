<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/toastr/toastr.min.css">
    <title>LNU VPSDAS</title>
</head>

<body>
    <section class="hero">
        <div class="left-bar">
            <div class="hero-1">
                <img src="assets/images/logo.png" alt="" class="logo">
                <h2>Leyte Normal University</h2>
                <h1>Student Development and Auxilliary Services</h1>
            </div>
            <div class="hero-2">
                &nbsp;
            </div>
        </div>

        <div class="login">
            <form id="login">

                <h1>Login</h1>

                <span>
                    <hr>
                </span>

                <div class="email">
                    <input type="text" name="username" placeholder="Username" autocomplete="off">
                    <label for="text">Username</label>
                </div>
                <div class="password">
                    <input type="password" name="password" placeholder="Password" autocomplete="off">
                    <label for="password" class="label-password">Password</label>
                </div>
                <button type="submit" value="Login">Submit</button>

            </form>
            <p>Welcome to Reward and Sanctioning System</p>
        </div>

    </section>

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