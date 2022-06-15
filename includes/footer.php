</section>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/index.js"></script>
<script src="../assets/toastr/toastr.min.js"></script>

<?php


if (isset($_SESSION['notify'])) {
    echo "<script> toastr.success('Success Fully Login', 'Access Granted') </script>";
    $_SESSION['notify'] = null;
}

?>

</body>

</html>