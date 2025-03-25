<?php
include 'header.php'; // Gọi header
include 'db_connect.php'; // Gọi file kết nối CSDL

displayHeader();

// Lấy danh sách học phần từ database (bao gồm cả số lượng dự kiến)
$sql = "SELECT MaHP, TenHP, SoTinChi, SoLuongDuKien FROM hocphan";
$result = $conn->query($sql);
?>

<div class="container">
    <h1 class="page-title">DANH SÁCH HỌC PHẦN</h1>
    <table border="1" width="100%" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>Mã Học Phần</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Số Lượng Dự Kiến</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row['MaHP'] . "</td>
                        <td>" . $row['TenHP'] . "</td>
                        <td>" . $row['SoTinChi'] . "</td>
                        <td>" . $row['SoLuongDuKien'] . "</td>
                        <td><button style='background-color: green; color: white; border: none; padding: 5px 10px;'>Đăng Kí</button></td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Không có học phần nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
