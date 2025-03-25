<?php
displayHeader();

$nganhs = getNganhHoc($conn);

echo '<h2 class="page-title">Thêm Sinh Viên Mới</h2>
<form action="index.php?action=store" method="post" enctype="multipart/form-data" class="styled-form">
    <div class="form-group">
        <label for="MaSV">Mã Sinh Viên:</label>
        <input type="text" id="MaSV" name="MaSV" required class="form-control">
    </div>
    
    <div class="form-group">
        <label for="HoTen">Họ Tên:</label>
        <input type="text" id="HoTen" name="HoTen" required class="form-control">
    </div>
    
    <div class="form-group">
        <label>Giới Tính:</label>
        <div class="radio-group">
            <label><input type="radio" name="GioiTinh" value="Nam" checked> Nam</label>
            <label><input type="radio" name="GioiTinh" value="Nữ"> Nữ</label>
        </div>
    </div>
    
    <div class="form-group">
        <label for="NgaySinh">Ngày Sinh:</label>
        <input type="date" id="NgaySinh" name="NgaySinh" required class="form-control">
    </div>
    
    <div class="form-group">
        <label for="Hinh">Hình ảnh:</label>
        <input type="file" id="Hinh" name="Hinh" class="form-control-file">
    </div>
    
    <div class="form-group">
        <label for="MaNganh">Ngành học:</label>
        <select id="MaNganh" name="MaNganh" required class="form-control">
            <option value="">Chọn ngành học</option>';
            
foreach ($nganhs as $maNganh => $tenNganh) {
    echo '<option value="' . $maNganh . '">' . $tenNganh . '</option>';
}
            
echo '</select>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="index.php" class="btn btn-danger">Hủy</a>
    </div>
</form>';

displayFooter();
?>

<style>
    .styled-form {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }
    .form-control-file {
        font-size: 16px;
    }
    .radio-group label {
        margin-right: 15px;
    }
    .btn {
        display: inline-block;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        transition: background 0.3s;
    }
    .btn-primary {
        background-color: #007bff;
        color: white;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .btn-danger {
        background-color: #dc3545;
        color: white;
    }
    .btn-danger:hover {
        background-color: #c82333;
    }
    .form-actions {
        text-align: center;
        margin-top: 20px;
    }
</style>