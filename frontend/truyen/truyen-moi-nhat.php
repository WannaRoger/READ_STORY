<?php include_once(__DIR__ . '/../../../backend/dbconnect.php'); ?>
<?php include_once(__DIR__ . '/../../../backend/custom_fomart.php'); ?>
<!-- truyện mới -->
<?php
    $sql_truyen_moi = <<<EOT
        SELECT truyen_id,truyen_ma,truyen_ten,truyen_tac_gia,truyen_mo_ta,truyen_anh_dai_dien,truyen_tinh_trang,
        truyen_luot_xem,truyen_ngay_dang,truyen_trang_thai
        FROM truyen 
        WHERE truyen_trang_thai = "1"
        ORDER BY truyen_id DESC
        LIMIT 8
    EOT;