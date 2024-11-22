<?php
if (isset($_GET['direction'])) {
    switch ($_GET['direction']) {
        case "dashboard":
            require __DIR__ . "/dashboard/index.php";
            break;

        case "tai-khoan":
            require __DIR__ . "/tai-khoan/index.php";
            break;
        case "them-tai-khoan":
            require __DIR__ . "/tai-khoan/them.php";
            break;
        case "sua-tai-khoan":
            require __DIR__ . "/tai-khoan/sua.php";
            break;
        case "xoa-tai-khoan":
            require __DIR__ . "/tai-khoan/xoa.php";
            break;

        default:
            break;
    }
} else {
    echo "<script>location.href='index.php?direction=dashboard'</script>";
}
