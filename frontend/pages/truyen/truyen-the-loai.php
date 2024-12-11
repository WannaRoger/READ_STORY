<div class="container-cs container-the-loai">
    <br/>
    <div class="container-lm">
        <section>
            <?php
            // Kết nối cơ sở dữ liệu
            include_once(__DIR__ . '/../../../backend/dbconnect.php');
            include_once(__DIR__ . '/../../../backend/custom_fomart.php');

            // Kiểm tra 'the-loai' trong URL
            if (isset($_GET['the-loai']) && !empty($_GET['the-loai'])) {
                $the_loai = $_GET['the-loai'];
            } else {
                die('<h1>Thể loại không hợp lệ hoặc không được cung cấp!</h1>');
            }

            // Truy vấn SQL an toàn với Prepared Statement
            $sql_top_view = "
                SELECT truyen.*, the_loai.the_loai_ten, the_loai.the_loai_mo_ta
                FROM (truyen LEFT JOIN truyen_the_loai ON truyen.truyen_id = truyen_the_loai.truyen_id)
                LEFT JOIN the_loai ON the_loai.the_loai_id = truyen_the_loai.the_loai_id
                WHERE the_loai.the_loai_id = ?
            ";
            $stmt = $conn->prepare($sql_top_view);
            $stmt->bind_param('s', $the_loai);
            $stmt->execute();
            $result = $stmt->get_result();

            // Thu thập dữ liệu
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = [
                    'truyen_id' => $row['truyen_id'],
                    'truyen_ma' => $row['truyen_ma'],
                    'truyen_ten' => $row['truyen_ten'],
                    'truyen_tac_gia' => $row['truyen_tac_gia'],
                    'truyen_mo_ta' => $row['truyen_mo_ta'],
                    'truyen_anh_dai_dien' => $row['truyen_anh_dai_dien'],
                    'truyen_tinh_trang' => $row['truyen_tinh_trang'],
                    'truyen_luot_xem' => $row['truyen_luot_xem'],
                    'truyen_ngay_dang' => date('Y-m-d H:i:s', strtotime($row['truyen_ngay_dang'])),
                    'truyen_trang_thai' => $row['truyen_trang_thai'],
                    'the_loai_ten' => $row['the_loai_ten'],
                    'the_loai_mo_ta' => $row['the_loai_mo_ta'],
                ];
            }

            // Kiểm tra nếu không có dữ liệu
            if (empty($data)) {
                echo '<h1>Thể loại này chưa có truyện!</h1>';
                die();
            }
            ?>

            <!-- Hiển thị nội dung -->
            <div class="section-title color-8"><?= $data[0]['the_loai_ten'] ?> </div>
            <div class="section-description color-7"><b>Mô tả: </b><?= $data[0]['the_loai_mo_ta'] ?> </div>
            
            <?php foreach ($data as $item): ?>
                <div class="item-medium">
                    <a href="index.php?truyen-manga=danh-sach-chapter&truyen_id=<?= ($item['truyen_id']) ?>">
                        <div class="item-thumbnail">
                            <img src="./assets/uploads/<?= $item['truyen_anh_dai_dien'] ?>" alt="Thumbnail">
                            <span class="background-5"><?= thousand_format($item['truyen_luot_xem']) ?><i class="fas fa-eye"></i></span>
                        </div>
                    </a>
                    <a href="index.php?truyen-manga=danh-sach-chapter&truyen_id=<?= $item['truyen_id'] ?>">
                        <h3 class="item-title"><?= $item['truyen_ten'] ?></h3>
                    </a>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
</div>
