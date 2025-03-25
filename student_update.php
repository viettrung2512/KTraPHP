<?php
$maSV = $_POST['MaSV'];
$hoTen = $_POST['HoTen'];
$gioiTinh = $_POST['GioiTinh'];
$ngaySinh = $_POST['NgaySinh'];
$maNganh = $_POST['MaNganh'];
$current_image = $_POST['current_image'];

// Xử lý tải lên hình ảnh mới
$hinh = $current_image; // Mặc định giữ nguyên hình ảnh cũ nếu không có hình mới
if(isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] == 0) {
    $target_dir = "images/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $hinh = basename($_FILES["Hinh"]["name"]);
    $target_file = $target_dir . $hinh;
    
    // Di chuyển file đã tải lên
    if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file)) {
        // Nếu có hình ảnh cũ, xóa nó
        if(!empty($current_image) && file_exists($target_dir . $current_image)) {
            unlink($target_dir . $current_image);
        }
    } else {
        echo "Xin lỗi, đã xảy ra lỗi khi tải lên tệp của bạn.";
        exit;
    }
}

$sql = "UPDATE SinhVien SET HoTen='$hoTen', GioiTinh='$gioiTinh', 
        NgaySinh='$ngaySinh', Hinh='$hinh', MaNganh='$maNganh' 
        WHERE MaSV='$maSV'";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit;
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}
?>