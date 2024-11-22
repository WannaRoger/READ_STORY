<?php include_once(__DIR__ . '/../../../backend/dbconnect.php'); ?>

<!-- danh sach chapter -->
<?php
    if(isset($_GET['truyen_id'])){
        $truyen_id = $_GET['truyen_id'];
    }

    // chap mới nhất
    $sql_chapter_moi = <<<EOT
    SELECT truyen.truyen_id,truyen_ma,truyen_ten,truyen_tac_gia,truyen_mo_ta,truyen_anh_dai_dien,truyen_tinh_trang,
    truyen_luot_xem,truyen_ngay_dang,truyen_trang_thai, chapter_so, chapter_id, chapter_ten
    FROM truyen LEFT JOIN chapter ON truyen.truyen_id = chapter.truyen_id
    WHERE truyen_trang_thai = "1" AND truyen.truyen_id = '$truyen_id'
    ORDER BY chapter_id DESC
    LIMIT 1
    EOT;
        $result_chapter_moi= mysqli_query($conn, $sql_chapter_moi);
        $data_chapter_moi = mysqli_fetch_array($result_chapter_moi, MYSQLI_ASSOC);
