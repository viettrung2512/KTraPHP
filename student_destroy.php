<?php
include 'config.php'; // Đảm bảo kết nối CSDL được include

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['MaSV'])) {
    $maSV = $conn->real_escape_string($_POST['MaSV']);
    $current_image = $_POST['current_image'];

    // Xóa hình ảnh nếu có
    if (!empty($current_image)) {
        $target_dir = "images/";
        $image_path = $target_dir . $current_image;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    // Kiểm tra xem sinh viên có tồn tại không
    $sql_check_sv = "SELECT * FROM SinhVien WHERE MaSV='$maSV'";
    $result_check_sv = $conn->query($sql_check_sv);

    if ($result_check_sv->num_rows > 0) {
        // Xóa các bản ghi liên quan trong bảng DangKy và ChiTietDangKy
        $sql = "SELECT MaDK FROM DangKy WHERE MaSV='$maSV'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $maDK = $conn->real_escape_string($row['MaDK']);

                // Xóa các chi tiết đăng ký
                $sql_delete_ctdk = "DELETE FROM ChiTietDangKy WHERE MaDK='$maDK'";
                if (!$conn->query($sql_delete_ctdk)) {
                    die("Lỗi khi xóa ChiTietDangKy: " . $conn->error);
                }
            }

            // Xóa đăng ký
            $sql_delete_dk = "DELETE FROM DangKy WHERE MaSV='$maSV'";
            if (!$conn->query($sql_delete_dk)) {
                die("Lỗi khi xóa DangKy: " . $conn->error);
            }
        }

        // Cuối cùng xóa sinh viên
        $sql_delete_sv = "DELETE FROM SinhVien WHERE MaSV='$maSV'";
        if ($conn->query($sql_delete_sv)) {
            header("Location: index.php");
            exit;
        } else {
            die("Lỗi khi xóa SinhVien: " . $conn->error);
        }
    } else {
        echo "Không tìm thấy sinh viên!";
    }
} else {
    echo "Yêu cầu không hợp lệ!";
}
?>
