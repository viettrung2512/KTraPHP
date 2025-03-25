<?php
session_start();
include 'header.php';
include 'db_connect.php';

displayHeader();

$maSoSV = $_SESSION['maSoSV'] ?? '';

if (empty($maSoSV)) {
    echo "<p>Vui lòng đăng nhập trước khi đăng ký học phần.</p>";
    exit();
}

// Lấy thông tin sinh viên
$sql_sv = "SELECT HoTen, NgaySinh, MaNganh FROM SinhVien WHERE MaSV = '$maSoSV'";
$result_sv = $conn->query($sql_sv);
$sv_info = $result_sv->fetch_assoc();

// Lấy danh sách học phần từ bảng HocPhan
$sql = "SELECT MaHP, TenHP, SoTinChi FROM HocPhan";
$result = $conn->query($sql);

// Xử lý thêm học phần vào session
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mahp'])) {
    $mahp = $_POST['mahp'];
    $tinchi = $_POST['tinchi'];
    
    if (!isset($_SESSION['registered_courses'])) {
        $_SESSION['registered_courses'] = [];
    }
    
    if (!array_key_exists($mahp, $_SESSION['registered_courses'])) {
        $_SESSION['registered_courses'][$mahp] = $tinchi;
    }
}

// Xử lý xóa học phần khỏi session
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_mahp'])) {
    unset($_SESSION['registered_courses'][$_POST['remove_mahp']]);
}

// Xử lý xóa tất cả học phần
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_all'])) {
    $_SESSION['registered_courses'] = [];
}

// Xử lý lưu học phần vào database sau xác nhận
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_save'])) {
    if (!empty($_SESSION['registered_courses'])) {
        $ngayDK = date("Y-m-d");
        $sql_insert_dk = "INSERT INTO DangKy (NgayDK, MaSV) VALUES ('$ngayDK', '$maSoSV')";
        if ($conn->query($sql_insert_dk) === TRUE) {
            $maDK = $conn->insert_id;
            foreach ($_SESSION['registered_courses'] as $mahp => $tinchi) {
                $sql_insert_ctdk = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES ('$maDK', '$mahp')";
                $conn->query($sql_insert_ctdk);
            }
            $_SESSION['registered_courses'] = [];
            echo "<p>Đã lưu đăng ký học phần thành công.</p>";
        } else {
            echo "<p>Lỗi khi lưu đăng ký học phần: " . $conn->error . "</p>";
        }
    }
}

$totalCredits = array_sum($_SESSION['registered_courses'] ?? []);
?>

<div class="container">
    <h1 class="page-title">Danh Sách Học Phần</h1>
    <table border="1" width="100%">
        <tr>
            <th>Mã Học Phần</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th>Hành Động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['MaHP']) ?></td>
                <td><?= htmlspecialchars($row['TenHP']) ?></td>
                <td><?= htmlspecialchars($row['SoTinChi']) ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="mahp" value="<?= htmlspecialchars($row['MaHP']) ?>">
                        <input type="hidden" name="tinchi" value="<?= htmlspecialchars($row['SoTinChi']) ?>">
                        <button type="submit">Thêm</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

<div class="container">
    <h1 class="page-title">Học Phần Đã Chọn</h1>
    <table border="1" width="100%">
        <tr>
            <th>Mã Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th>Hành Động</th>
        </tr>
        <?php foreach ($_SESSION['registered_courses'] as $course => $credits): ?>
            <tr>
                <td><?= htmlspecialchars($course) ?></td>
                <td><?= htmlspecialchars($credits) ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="remove_mahp" value="<?= htmlspecialchars($course) ?>">
                        <button type="submit">Xóa</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="2"><strong>Tổng số tín chỉ:</strong></td>
            <td><strong><?= $totalCredits ?></strong></td>
        </tr>
    </table>
    <form method="post">
        <button type="submit" name="clear_all">Xóa tất cả</button>
        <button type="submit" name="confirm_save">Lưu đăng ký</button>
    </form>
</div>

<!-- Xác nhận thông tin trước khi lưu -->
<?php if (isset($_POST['save_courses'])): ?>
    <div class="container">
        <h1 class="page-title">Thông tin Đăng ký</h1>
        <table border="1" width="100%">
            <tr><td><strong>Mã số sinh viên:</strong></td><td><?= htmlspecialchars($maSoSV) ?></td></tr>
            <tr><td><strong>Họ tên sinh viên:</strong></td><td><?= htmlspecialchars($sv_info['HoTen']) ?></td></tr>
            <tr><td><strong>Ngày sinh:</strong></td><td><?= htmlspecialchars($sv_info['NgaySinh']) ?></td></tr>
            <tr><td><strong>Ngành học:</strong></td><td><?= htmlspecialchars($sv_info['MaNganh']) ?></td></tr>
            <tr><td><strong>Ngày đăng ký:</strong></td><td><?= date("Y-m-d") ?></td></tr>
        </table>
        <form method="post">
            <button type="submit" name="confirm_save">Xác nhận</button>
            <button type="submit">Hủy</button>
        </form>
    </div>
<?php endif; ?>
</body>
</html>