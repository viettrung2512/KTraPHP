<?php
$maSV = $_POST['MaSV'];
$hoTen = $_POST['HoTen'];
$gioiTinh = $_POST['GioiTinh'];
$ngaySinh = $_POST['NgaySinh'];
$maNganh = $_POST['MaNganh'];

// Handle file upload
$hinh = '';
if(isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] == 0) {
    $target_dir = "images/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $hinh = basename($_FILES["Hinh"]["name"]);
    $target_file = $target_dir . $hinh;
    
    // Move the uploaded file
    if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file)) {
        // File uploaded successfully
    } else {
        echo "Sorry, there was an error uploading your file.";
        exit;
    }
}

$sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
        VALUES ('$maSV', '$hoTen', '$gioiTinh', '$ngaySinh', '$hinh', '$maNganh')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>