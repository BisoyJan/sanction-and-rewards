<!doctype html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Ajax File Upload with jQuery and PHP</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1><a href="#" target="_blank"><img src="logo.png" width="80px" />Ajax File Uploading with Database MySql</a></h1>
                <hr>
                <form id="form" action="ajaxupload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">NAME</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
                    </div>
                    <div class="form-group">
                        <label for="email">EMAIL</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required />
                    </div>
                    <input id="uploadImage" type="file" accept="image/*" name="image" />
                    <div id="preview"><img src="filed.png" /></div><br>
                    <input class="btn btn-success" type="submit" value="Upload">
                </form>
                <div id="err"></div>
                <hr>
                <p><a href="https://www.cloudways.com" target="_blank">www.Cloudways.com</a></p>
            </div>
        </div>
    </div>
</body>

</html>


<script>
    $(document).ready(function(e) {
        $("#form").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "ajaxupload.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    //$("#preview").fadeOut();
                    $("#err").fadeOut();
                },
                success: function(data) {
                    if (data == 'invalid') {
                        // invalid file format.
                        $("#err").html("Invalid File !").fadeIn();
                    } else {
                        // view uploaded file.
                        $("#preview").html(data).fadeIn();
                        $("#form")[0].reset();
                    }
                },
                error: function(e) {
                    $("#err").html(e).fadeIn();
                }
            });
        }));
    });
</script>

<?php
$img = $_FILES["image"]["name"]; //stores the original filename from the client
$tmp = $_FILES["image"]["tmp_name"]; //stores the name of the designated temporary file
$errorimg = $_FILES["image"]["error"]; //stores any error code resulting from the transfer


$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
$path = 'uploads/'; // upload directory
if (!empty($_POST['name']) || !empty($_POST['email']) || $_FILES['image']) {
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    // can upload same image using rand function
    $final_image = rand(1000, 1000000) . $img;
    // check's valid format

    if ($errorimg > 0) {
        die('<div class="alert alert-danger" role="alert"> An error occurred while uploading the file </div>');
    }

    if ($myFile['size'] > 500000) {
        die('<div class="alert alert-danger" role="alert"> File is too big </div>');
    }

    if (in_array($ext, $valid_extensions)) {
        $path = $path . strtolower($final_image);
        if (move_uploaded_file($tmp, $path)) {
            echo "<img src='$path' />";
            $name = $_POST['name'];
            $email = $_POST['email'];
            //include database configuration file
            include_once 'db.php';
            //insert form data in the database
            $insert = $db->query("INSERT uploading (name,email,file_name) VALUES ('" . $name . "','" . $email . "','" . $path . "')");
            //echo $insert?'ok':'err';
        }
    } else {
        echo 'invalid';
    }
}

?>