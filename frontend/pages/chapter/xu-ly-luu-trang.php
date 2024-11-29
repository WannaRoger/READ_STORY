<?php include_once(__DIR__ . '/../../../backend/dbconnect.php');
// sự kiện bấm nút thích
if (isset($_POST['btn_thich'])) {
    $tai_khoan_id = $_POST['user_tai_khoan_id'];
    $truyen_id = $_POST['truyen_id'];
    $chapter_id = $_POST['chapter_id'];
    $chapter_noi_dung_id = $_POST['chapter_noi_dung_id'];

    // Kiểm tra truyện đã lưu chưa
    $sql_select_truyen_da_luu_trang = <<<EOT
       SELECT * 
       FROM (tuong_tac INNER JOIN chapter ON tuong_tac.chapter_id = chapter.chapter_id)
       INNER JOIN truyen ON truyen.truyen_id = chapter.truyen_id
       WHERE tuong_tac_loai = '4' 
       AND truyen.truyen_id = '$truyen_id' 
       AND tai_khoan_id = '$tai_khoan_id' 
       AND tuong_tac.chapter_noi_dung_id = '$chapter_noi_dung_id'
       EOT;
    $result_select_truyen_luu_trang = mysqli_query($conn, $sql_select_truyen_da_thich);
    $data_select_truyen_luu_trang = mysqli_fetch_array($result_select_truyen_da_thich, MYSQLI_ASSOC);

    if (!empty($data_select_truyen_da_thich)) {
        $tuong_tac_id = $data_select_truyen_luu_trang['tuong_tac_id'];

        echo $tuong_tac_id;

        $sql_update_truyen_luu_trang = <<<EOT
           DELETE FROM tuong_tac WHERE tuong_tac_id =  '$tuong_tac_id'
           EOT;
        $result_update_truyen_luu_trang = mysqli_query($conn, $sql_update_truyen_luu_trang);
    } else {
        $sql_insert_truyen_da_thich = <<<EOT
           INSERT INTO tuong_tac (tuong_tac_loai, chapter_id, tai_khoan_id, chapter_noi_dung_id) VALUES ('4','$chapter_id','$tai_khoan_id','$chapter_noi_dung_id')
           EOT;
        $result_insert_truyen_da_thich = mysqli_query($conn, $sql_insert_truyen_luu_trang);
    }
}
?>