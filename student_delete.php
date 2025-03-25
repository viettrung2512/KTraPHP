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
    
    echo '<div class="delete-confirmation">
        <h2>Xác nhận xóa sinh viên</h2>
        
        <div class="alert alert-danger">
            <p>Bạn có chắc chắn muốn xóa sinh viên sau?</p>
        </div>
        
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
                <span class="label">Ngành học:</span>
                <span class="value">' . $row['TenNganh'] . '</span>
            </div>
        </div>
        
        <div class="actions">
            <form action="index.php?action=destroy" method="post">
                <input type="hidden" name="MaSV" value="' . $row['MaSV'] . '">
                <input type="hidden" name="current_image" value="' . $row['Hinh'] . '">
                <button type="submit" class="btn btn-danger">Xóa</button>
                <a href="index.php" class="btn btn-info">Hủy</a>
            </form>
        </div>
    </div>';
    
    // Thêm CSS cho trang xóa
    echo '<style>
        .delete-confirmation {
            padding: 20px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .student-info {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .info-row {
            margin-bottom: 10px;
            display: flex;
        }
        .label {
            font-weight: bold;
            width: 120px;
        }
        .value {
            flex: 1;
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