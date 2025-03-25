<?php
displayHeader();

$id = $_GET['id'];
$sql = "SELECT * FROM SinhVien WHERE MaSV='$id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nganhs = getNganhHoc($conn);
    
    echo '<h2>Sửa Thông Tin Sinh Viên</h2>
    <form action="index.php?action=update" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MaSV" value="' . $row['MaSV'] . '">
        
        <div class="form-group">
            <label for="HoTen">Họ Tên:</label>
            <input type="text" id="HoTen" name="HoTen" value="' . $row['HoTen'] . '" required>
        </div>
        
        <div class="form-group">
            <label>Giới Tính:</label>
            <label><input type="radio" name="GioiTinh" value="Nam" ' . ($row['GioiTinh'] == 'Nam' ? 'checked' : '') . '> Nam</label>
            <label><input type="radio" name="GioiTinh" value="Nữ" ' . ($row['GioiTinh'] == 'Nữ' ? 'checked' : '') . '> Nữ</label>
        </div>
        
        <div class="form-group">
            <label for="NgaySinh">Ngày Sinh:</label>
            <input type="date" id="NgaySinh" name="NgaySinh" value="' . $row['NgaySinh'] . '" required>
        </div>
        
        <div class="form-group">
            <label for="Hinh">Hình ảnh hiện tại:</label>';
            
    if (!empty($row['Hinh'])) {
        echo '<img src="images/' . $row['Hinh'] . '" class="student-img" alt="Student Photo"><br>';
    } else {
        echo '<p>Chưa có hình ảnh</p>';
    }
            
    echo '<input type="file" id="Hinh" name="Hinh">
            <input type="hidden" name="current_image" value="' . $row['Hinh'] . '">
        </div>
        
        <div class="form-group">
            <label for="MaNganh">Ngành học:</label>
            <select id="MaNganh" name="MaNganh" required>
                <option value="">Chọn ngành học</option>';
                
    foreach ($nganhs as $maNganh => $tenNganh) {
        $selected = ($row['MaNganh'] == $maNganh) ? 'selected' : '';
        echo '<option value="' . $maNganh . '" ' . $selected . '>' . $tenNganh . '</option>';
    }
                
    echo '</select>
        </div>
        
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="index.php" class="btn btn-danger">Hủy</a>
    </form>';
    echo '<style>
        .student-details {
            padding: 20px;
            max-width: 600px;
            margin: auto;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group input[type="radio"] {
            width: auto;
            margin-right: 5px;
        }
        .student-img {
            max-width: 200px;
            max-height: 200px;
            border: 1px solid #ddd;
            padding: 5px;
            display: block;
            margin: 10px 0;
        }
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-primary {
            background: #007bff;
            color: white;
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
    </style>';

} else {
    echo '<p>Không tìm thấy sinh viên</p>';
}

displayFooter();
?>