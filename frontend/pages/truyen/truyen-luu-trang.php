<?php
include_once(__DIR__ . '/../../../backend/dbconnect.php');
include_once(__DIR__ . '/../../../backend/custom_fomart.php');

// Kiểm tra và debug session
if (!isset($_SESSION['user_tai_khoan_id'])) {
    die("Lỗi: Chưa đăng nhập hoặc mất phiên đăng nhập");
}

$tai_khoan_id = $_SESSION['user_tai_khoan_id'];

// Câu truy vấn chi tiết
$sql_truyen_luu_trang = <<<EOT
SELECT 
    truyen.truyen_id,
    truyen.truyen_ma,
    truyen.truyen_ten,
    truyen.truyen_tac_gia,
    truyen.truyen_mo_ta,
    truyen.truyen_anh_dai_dien,
    truyen.truyen_tinh_trang,
    truyen.truyen_luot_xem,
    truyen.truyen_ngay_dang,
    truyen.truyen_trang_thai,
    chapter.chapter_id,
    chapter.chapter_ten,
    chapter.chapter_so,
    tuong_tac.tuong_tac_id,
    tuong_tac.chapter_noi_dung_id
FROM 
    truyen 
INNER JOIN 
    chapter ON truyen.truyen_id = chapter.truyen_id
INNER JOIN 
    tuong_tac ON chapter.chapter_id = tuong_tac.chapter_id
WHERE 
    tuong_tac.tai_khoan_id = '$tai_khoan_id' 
    AND tuong_tac.tuong_tac_loai = '4'
ORDER BY 
    tuong_tac.tuong_tac_id DESC
EOT;

// Thực thi truy vấn và debug
$result_truyen_luu_trang = mysqli_query($conn, $sql_truyen_luu_trang);

// Kiểm tra lỗi truy vấn
if (!$result_truyen_luu_trang) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}

// Kiểm tra số lượng kết quả
$num_rows = mysqli_num_rows($result_truyen_luu_trang);
// echo "Số lượng kết quả: " . $num_rows . "<br>";

// Xử lý dữ liệu
$data_truyen_luu_trang = [];
while ($row = mysqli_fetch_array($result_truyen_luu_trang, MYSQLI_ASSOC)) {
    // Debug: In ra từng dòng dữ liệu
    // echo "Debug Row: ";
    // print_r($row);
    // echo "<br>";

    $data_truyen_luu_trang[] = array(
        'truyen_id' => $row['truyen_id'],
        'truyen_ma' => $row['truyen_ma'],
        'truyen_ten' => $row['truyen_ten'],
        'truyen_tac_gia' => $row['truyen_tac_gia'],
        'truyen_mo_ta' => $row['truyen_mo_ta'],
        'truyen_anh_dai_dien' => $row['truyen_anh_dai_dien'],
        'truyen_tinh_trang' => $row['truyen_tinh_trang'],
        'truyen_luot_xem' => $row['truyen_luot_xem'],
        'truyen_ngay_dang' => date('H:m:s d/m/Y', strtotime($row['truyen_ngay_dang'])),
        'truyen_trang_thai' => $row['truyen_trang_thai'],
        'chapter_id' => $row['chapter_id'],
        'chapter_ten' => $row['chapter_ten'],
        'chapter_so' => $row['chapter_so'],
        'chapter_noi_dung_id' => $row['chapter_noi_dung_id'],
    );
}

// Hiển thị kết quả
?>

<div class="container-cs">
    <br />
    <div class="container-lm">
        <section>
            <?php if (empty($data_truyen_luu_trang)): ?>
                <p>Bạn chưa theo dõi truyện nào cả!</p>
            <?php else: ?>
                <a href="#">
                    <div class="section-title color-5">TRANG TRUYỆN ĐÃ LƯU</div>
                </a>
                <?php foreach ($data_truyen_luu_trang as $item): ?>
                    <div class="item-medium">
                        <a
                            href="index.php?truyen-manga=noi-dung-chapter&truyen_id=<?= $item['truyen_id'] ?>&chapter_id=<?= $item['chapter_id'] ?>&chapter_so=<?= $item['chapter_so'] ?>&chapter_noi_dung_id=<?= $item['chapter_noi_dung_id'] ?>">
                            <div class="item-thumbnail">
                                <img src="./assets/uploads/<?= $item['truyen_anh_dai_dien'] ?>">
                                <span class="background-5"><?= $item['chapter_so'] ?> <i
                                        class="fa-solid fa-bookmark"></i></span>
                            </div>
                        </a>
                        <a
                            href="index.php?truyen-manga=noi-dung-chapter&truyen_id=<?= $item['truyen_id'] ?>&chapter_id=<?= $item['chapter_id'] ?>&chapter_so=<?= $item['chapter_so'] ?>&chapter_noi_dung_id=<?= $item['chapter_noi_dung_id'] ?>">
                            <h3 class="item-title-truyen">
                                <?= $item['truyen_ten'] ?>,Chapter: <?= $item['chapter_so'] ?>,Trang số: <?= $item['chapter_noi_dung_id'] ?>
                            </h3>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </div>
</div>

