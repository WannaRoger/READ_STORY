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

        // chap đầu
    $sql_chapter_dau_tien = <<<EOT
    SELECT chapter_so, chapter_id, chapter_ten, chapter_ngay_cap_nhat
    FROM chapter
    WHERE truyen_id = '$truyen_id'
    ORDER BY chapter_id ASC
    EOT;
        $result_chapter_dau_tien = mysqli_query($conn, $sql_chapter_dau_tien);
        $data_chapter_dau_tien = [];
        while ($row = mysqli_fetch_array($result_chapter_dau_tien, MYSQLI_ASSOC)) {
            $data_chapter_dau_tien[] = array(
                'chapter_so' => $row['chapter_so'],
                'chapter_id' => $row['chapter_id'],
                'chapter_ten' => $row['chapter_ten'],
                'chapter_ngay_cap_nhat' => date('d/m/Y',strtotime($row['chapter_ngay_cap_nhat'])),
            );
        }
    // danh sach chapter
    $sql_danh_sach_chap = <<<EOT
    SELECT chapter_so, chapter_id, chapter_ten, chapter_ngay_cap_nhat, truyen_id
    FROM chapter
    WHERE truyen_id = '$truyen_id' AND chapter_trang_thai = 1
    ORDER BY chapter_id DESC
    EOT;
        $result_danh_sach_chap = mysqli_query($conn, $sql_danh_sach_chap);
        $data_danh_sach_chap = [];
        while ($row = mysqli_fetch_array($result_danh_sach_chap, MYSQLI_ASSOC)) {
            $data_danh_sach_chap[] = array(
                'truyen_id' => $row['truyen_id'],
                'chapter_so' => $row['chapter_so'],
                'chapter_id' => $row['chapter_id'],
                'chapter_ten' => $row['chapter_ten'],
                'chapter_ngay_cap_nhat' => date('d/m/Y',strtotime($row['chapter_ngay_cap_nhat'])),
            );
        }
   
?>