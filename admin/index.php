

<link rel="stylesheet" href="../assets/css/admin-dashboard.css" type="text/css" />
</head>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truyện Cover</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/admin-dashboard.css" type="text/css" />
</head>

<body>
    <!-- mở kết nối -->
    <?php include_once(__DIR__ . '/../backend/dbconnect.php'); ?>

    <!-- navigation -->
    <?php include_once(__DIR__ . '/../frontend/partials/admin-sidebar.php'); ?>

    <!-- content -->
    <?php include_once(__DIR__ . '/controller.php'); ?>

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../frontend/layouts/admin-scripts.php'); ?>

</body>
<?php
if (isset($_GET['status']) && ($_GET['status'] == 'success')) {
    echo '<script> toast.success("Thao tác thành công",500);</script>';
}
if (isset($_GET['status']) && ($_GET['status'] == 'error')) {
    echo '<script> toast.error("Thao tác thành công",500);</script>';
}

?>

</html>