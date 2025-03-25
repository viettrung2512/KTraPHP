<?php
displayHeader();


echo '<a href="index.php?action=create" class="btn">Thêm Sinh Viên</a>';

$sql = "SELECT sv.*, nh.TenNganh FROM SinhVien sv 
        LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh";
$result = $conn->query($sql);

echo '<table class="styled-table">
    <thead>
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Giới Tính</th>
            <th>Ngày Sinh</th>
            <th>Hình</th>
            <th>Ngành Học</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<tr>
            <td>' . $row["MaSV"] . '</td>
            <td>' . $row["HoTen"] . '</td>
            <td>' . $row["GioiTinh"] . '</td>
            <td>' . $row["NgaySinh"] . '</td>
            <td><img src="images/' . $row["Hinh"] . '" class="student-img" alt="Student Photo"></td>
            <td>' . $row["TenNganh"] . '</td>
            <td class="action-links">
                <a href="index.php?action=edit&id=' . $row["MaSV"] . '" class="edit">Sửa</a> 
                <a href="index.php?action=details&id=' . $row["MaSV"] . '" class="details">Chi Tiết</a> 
                <a href="index.php?action=delete&id=' . $row["MaSV"] . '" class="delete">Xóa</a>
            </td>
        </tr>';
    }
} else {
    echo '<tr><td colspan="7" class="no-data">Không có sinh viên nào</td></tr>';
}

echo '</tbody></table>';

displayFooter();
?>

<style>
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin-bottom: 15px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background 0.3s;
    }
    .btn:hover {
        background-color: #0056b3;
    }
    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }
    .styled-table th, .styled-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    .styled-table th {
        background-color: #343a40;
        color: white;
    }
    .styled-table tr:hover {
        background-color: #f1f1f1;
    }
    .student-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }
    .action-links a {
        margin-right: 10px;
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 5px;
    }
    .edit { background-color: #ffc107; color: black; }
    .details { background-color: #17a2b8; color: white; }
    .delete { background-color: #dc3545; color: white; }
    .edit:hover { background-color: #e0a800; }
    .details:hover { background-color: #138496; }
    .delete:hover { background-color: #c82333; }
    .no-data {
        text-align: center;
        font-style: italic;
        color: #777;
    }
</style>
