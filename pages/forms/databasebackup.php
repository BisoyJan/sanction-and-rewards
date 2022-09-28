<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
if (empty($_SESSION['id'])) :
    header('Location: ../../index.php');
endif;

$connect = new PDO("mysql:host=localhost;dbname=vpsdasdata", "root", "");
$get_all_table_query = "SHOW TABLES";
$statement = $connect->prepare($get_all_table_query);
$statement->execute();
$result = $statement->fetchAll();

if (isset($_POST['table'])) {
    $output = '';
    foreach ($_POST["table"] as $table) {
        $show_table_query = "SHOW CREATE TABLE " . $table . "";
        $statement = $connect->prepare($show_table_query);
        $statement->execute();
        $show_table_result = $statement->fetchAll();

        foreach ($show_table_result as $show_table_row) {
            $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
        }
        $select_query = "SELECT * FROM " . $table . "";
        $statement = $connect->prepare($select_query);
        $statement->execute();
        $total_row = $statement->rowCount();

        for ($count = 0; $count < $total_row; $count++) {
            $single_result = $statement->fetch(PDO::FETCH_ASSOC);
            $table_column_array = array_keys($single_result);
            $table_value_array = array_values($single_result);
            $output .= "\nINSERT INTO $table (";
            $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
            $output .= "'" . implode("','", $table_value_array) . "');\n";
        }
    }
    $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
    $file_handle = fopen($file_name, 'w+');
    fwrite($file_handle, $output);
    fclose($file_handle);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_name));
    ob_clean();
    flush();
    readfile($file_name);
    unlink($file_name);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanction and Rewards</title>

    <!-- MATERIAL ICON -->
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/toastr/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/moment.min.js"></script>
    <script src="../../assets/toastr/toastr.min.js"></script>
</head>

<body style="width:100%;height:100%;overflow:scroll;overflow-y:scroll;overflow-x:hidden;">

    <style>
        .Absolute-Center {
            height: 90%;
            /* Set your own height: percents, ems, whatever! */
            width: 90%;
            /* Set your own width: percents, ems, whatever! */
            overflow: auto;
            /* Recommended in case content is larger than the container */
            margin: auto;
            /* Center the item vertically & horizontally */
            position: absolute;
            /* Break it out of the regular flow */
            top: 20%;
            left: 0;
            bottom: 0%;
            right: 0;
            /* Set the bounds in which to center it, relative to its parent/container */
        }

        /* //////////////////////////////////////// */
        /* Make sure our center blocks stay in their container! */
        .Center-Container {
            position: relative;
        }

        /* //////////////////////////////////////// */
        /* Fixed floating element within viewport */
        .Absolute-Center.is-Fixed {
            position: fixed;
            z-index: 999;
        }

        @media only screen and (max-width: 1000px) {
            .Absolute-Center {
                height: 100%;
                /* Set your own height: percents, ems, whatever! */
                width: 100%;
                /* Set your own width: percents, ems, whatever! */
                overflow: auto;
                /* Recommended in case content is larger than the container */
                margin: auto;
                /* Center the item vertically & horizontally */
                position: absolute;
                /* Break it out of the regular flow */
                top: 10%;
                left: 0;
                bottom: 0;
                right: 0;
                /* Set the bounds in which to center it, relative to its parent/container */

            }
        }

        @media only screen and (max-width: 720px) {
            .Absolute-Center {
                height: 100%;
                /* Set your own height: percents, ems, whatever! */
                width: 100%;
                /* Set your own width: percents, ems, whatever! */
                overflow: auto;
                /* Recommended in case content is larger than the container */
                margin: auto;
                /* Center the item vertically & horizontally */
                position: absolute;
                /* Break it out of the regular flow */
                top: 5%;
                left: 0;
                bottom: 5%;
                right: 0;
                /* Set the bounds in which to center it, relative to its parent/container */

            }
        }
    </style>

    <div class="Center-Container ">
        <div class="Absolute-Center is-Fixed ">
            <div class="container-fluid">
                <div class="container-sm shadow p-3 mb-5 bg-body rounded-3 border border-2">

                    <a href=" ../views/account.php">
                        <button class="btn btn-primary">Return</button>
                    </a>
                    <form method="post" id="export_form">
                        <h1 class="pt-3">Select Tables for Export</h1>
                        <?php
                        foreach ($result as $table) {
                        ?>
                            <div class="checkbox d-inline p-2 pb-5 h4 ">
                                <label><input type="checkbox" class="checkbox_table" name="table[]" value="<?php echo $table["Tables_in_vpsdasdata"]; ?>" /> <?php echo $table["Tables_in_vpsdasdata"]; ?></label>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="form-group pt-3 d-flex justify-content-end">
                            <!-- <button class="btn btn-primary me-3" name="select-all" id="select-all" type="button">Select All</button> -->
                            <input type="submit" name="submit" id="submit" class="btn btn-info" value="Export" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#submit').click(function() {
                var count = 0;
                $('.checkbox_table').each(function() {
                    if ($(this).is(':checked')) {
                        count = count + 1;
                    }
                });
                if (count > 0) {
                    $('#export_form').submit();
                } else {
                    alert("Please Select Atleast one table for Export");
                    return false;
                }
            });
        });


        // $('#select-all').click(function(event) {
        //     if (this.checked) {
        //         // Iterate each checkbox
        //         $(':table[]').each(function() {
        //             this.checked = true;
        //         });
        //     } else {
        //         $(':table').each(function() {
        //             this.checked = false;
        //         });
        //     }
        // });
    </script>
</body>

</html>