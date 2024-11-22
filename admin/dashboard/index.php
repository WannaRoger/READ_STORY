<?php
include_once(__DIR__ . '/../../backend/dbconnect.php');
include_once(__DIR__ . '/../../backend/custom_fomart.php');


// select dữ liệu
$sql_tai_khoan = <<<EOT
SELECT COUNT(tai_khoan_id) AS count_tai_khoan
FROM tai_khoan
EOT;
$result_tai_khoan = mysqli_query($conn, $sql_tai_khoan);
$data_tai_khoan =  mysqli_fetch_array($result_tai_khoan, MYSQLI_ASSOC);
//  select du lieu truyen

?>


<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="box-title-1"><i class="fa-solid fa-chart-simple"></i> THỐNG KÊ</div>
        <ul class="box-info">
            <li>
                <i class='bx bxs-book-bookmark'></i>
                <span class="text">
                    <h3>Truyện tranh</h3>
                    <p><?= $data_truyen['count_truyen'] ?></p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <h3>Người dùng</h3>
                    <p><?= $data_tai_khoan['count_tai_khoan'] ?></p>
                </span>
            </li>
            <li>
                <i class='bx bxs-book-heart'></i>
                <span class="text">
                    <h3>Chapter</h3>
                    <p><?= $data_chapter['count_chapter'] ?></p>
                </span>
            </li>
        </ul>
        <div class="box-title-2"><i class="fa-solid fa-ranking-star"></i> TOP LƯỢT XEM</div>
        <!-- Top -->
        <ul class="box-info">
            <!-- Top view  -->

            </li>
        </ul>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->