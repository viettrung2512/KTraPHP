<?php
displayHeader();

$id = $_GET['id'];
$sql = "SELECT sv.*, nh.TenNganh 
        FROM SinhVien sv 
        LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh 
        WHERE sv.MaSV='$id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    
    echo '<div class="student-details">
        <h2>Thông Tin Chi Tiết Sinh Viên</h2>
        
        <div class="student-info">
            <div class="info-row">
                <span class="label">Mã sinh viên:</span>
                <span class="value">' . $row['MaSV'] . '</span>
            </div>
            
            <div class="info-row">
                <span class="label">Họ tên:</span>
                <span class="value">' . $row['HoTen'] . '</span>
            </div>
            
            <div class="info-row">
                <span class="label">Giới tính:</span>
                <span class="value">' . $row['GioiTinh'] . '</span>
            </div>
            
            <div class="info-row">
                <span class="label">Ngày sinh:</span>
                <span class="value">' . $row['NgaySinh'] . '</span>
            </div>
            
            <div class="info-row">
                <span class="label">Ngành học:</span>
                <span class="value">' . $row['TenNganh'] . ' (' . $row['MaNganh'] . ')</span>
            </div>
            
            <div class="info-row">
                <span class="label">Hình ảnh:</span>
                <div class="student-image">';
                
    if (!empty($row['Hinh'])) {
        echo '<img src="images/' . $row['Hinh'] . '" alt="Student Photo">';
    } else {
        echo '<p>Không có hình ảnh</p>';
    }
                
    echo '</div>
            </div>
        </div>
        
        <div class="actions">
            <a href="index.php?action=edit&id=' . $row['MaSV'] . '" class="btn btn-primary">Sửa</a>
            <a href="index.php" class="btn btn-info">Quay lại danh sách</a>
        </div>
    </div>';
    
    // Thêm CSS cho trang chi tiết
    echo '<style>
        .student-details {
            padding: 20px;
        }
        .student-info {
            margin: 20px 0;
        }
        .info-row {
            margin-bottom: 15px;
            display: flex;
        }
        .label {
            font-weight: bold;
            width: 120px;
        }
        .value {
            flex: 1;
        }
        .student-image img {
            max-width: 300px;
            max-height: 300px;
            border: 1px solid #ddd;
            padding: 5px;
        }
        .actions {
            margin-top: 20px;
        }
    </style>';
    
} else {
    echo '<p>Không tìm thấy sinh viên</p>';
}

displayFooter();
?>