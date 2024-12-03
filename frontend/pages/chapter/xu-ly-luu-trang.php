<?php
include_once(__DIR__ . '/../../../backend/dbconnect.php');

// Thiết lập header để trả về JSON
header('Content-Type: application/json');

// Khởi tạo mảng phản hồi
$response = [
    'status' => 'error',
    'message' => 'Yêu cầu không hợp lệ'
];

// Kiểm tra xem có phải là request POST không
// Kiểm tra xem có phải là request POST không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // sự kiện bấm nút thích
    if (isset($_POST['btn_thich'])) {
        // Làm sạch và kiểm tra dữ liệu đầu vào
        $tai_khoan_id = mysqli_real_escape_string($conn, $_POST['user_tai_khoan_id'] ?? '');
        $truyen_id = mysqli_real_escape_string($conn, $_POST['truyen_id'] ?? '');
        $chapter_id = mysqli_real_escape_string($conn, $_POST['chapter_id'] ?? '');
        $chapter_noi_dung_id = mysqli_real_escape_string($conn, $_POST['chapter_noi_dung_id'] ?? '');

        // Kiểm tra tính hợp lệ của dữ liệu
        if (empty($tai_khoan_id) || empty($truyen_id) || empty($chapter_id) || empty($chapter_noi_dung_id)) {
            $response['message'] = 'Thông tin không đầy đủ';
            echo json_encode($response);
            exit;
        }

        // Kiểm tra truyện đã lưu chưa
        $sql_select_truyen_da_luu_trang = "
            SELECT * 
            FROM tuong_tac 
            WHERE tuong_tac_loai = '4' 
            AND tai_khoan_id = '$tai_khoan_id' 
            AND chapter_id = '$chapter_id'
        ";

        $result_select_truyen_luu_trang = mysqli_query($conn, $sql_select_truyen_da_luu_trang);

        if (!$result_select_truyen_luu_trang) {
            $response['message'] = 'Lỗi truy vấn: ' . mysqli_error($conn);
            echo json_encode($response);
            exit;
        }

        // Xử lý kết quả
        if (mysqli_num_rows($result_select_truyen_luu_trang) > 0) {
            // Nếu tồn tại các trang đã lưu, xóa tất cả các bản ghi cũ
            $sql_delete_old_pages = "
                DELETE FROM tuong_tac 
                WHERE tuong_tac_loai = '4' 
                AND tai_khoan_id = '$tai_khoan_id' 
                AND chapter_id = '$chapter_id'
            ";

            $result_delete_old_pages = mysqli_query($conn, $sql_delete_old_pages);

            if (!$result_delete_old_pages) {
                $response['message'] = 'Lỗi khi xóa các bản ghi cũ: ' . mysqli_error($conn);
                echo json_encode($response);
                exit;
            }
        }

        // Thêm mới trang truyện được lưu
        $sql_insert_truyen_luu_trang = "
            INSERT INTO tuong_tac (
                tuong_tac_loai, 
                chapter_id, 
                tai_khoan_id, 
                chapter_noi_dung_id
            ) VALUES (
                '4', 
                '$chapter_id', 
                '$tai_khoan_id', 
                '$chapter_noi_dung_id'
            )
        ";

        $result_insert_truyen_luu_trang = mysqli_query($conn, $sql_insert_truyen_luu_trang);

        if ($result_insert_truyen_luu_trang) {
            $response['status'] = 'success';
            $response['message'] = 'Đã lưu trang thành công';
            $response['action'] = 'added';
        } else {
            $response['message'] = 'Lỗi khi lưu: ' . mysqli_error($conn);
        }
    }
}

// Trả về phản hồi dưới dạng JSON
echo json_encode($response);
exit;
