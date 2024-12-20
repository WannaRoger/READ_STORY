<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truyện Cover</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <!-- CSS dùng chung cho toàn bộ trang web -->
    <?php include_once(__DIR__ . '/frontend/layouts/styles.php'); ?>

</head>

<body>
    <!-- header -->
    <?php include_once(__DIR__ . '/frontend/partials/header.php'); ?>
    <!-- end header -->

    <!-- body -->
    <div class="main-container">
        <?php include_once(__DIR__ . '/backend/controller.php'); ?>
    </div>
    <!-- end body -->

    <!-- footer -->
    <?php include_once(__DIR__ . '/frontend/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/frontend/layouts/scripts.php'); ?>

    <!-- facebook plugin -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0"
        nonce="jB1NhBGh"></script>
    <!-- Nhúng gsap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollToPlugin.min.js"></script>


</html>