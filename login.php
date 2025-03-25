
<?php
include 'header.php'; // Gọi header
include 'db_connect.php'; // Gọi file kết nối CSDL
session_start();

displayHeader();

$error = "";

// Xử lý đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['maSoSV'])) {
        $maSoSV = trim($_POST['maSoSV']);
        
        $sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $maSoSV);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $_SESSION['maSoSV'] = $maSoSV;
            header("Location: index.php"); // Chuyển hướng sau khi đăng nhập thành công
            exit();
        } else {
            $error = "Mã số sinh viên không hợp lệ!";
        }
    } else {
        $error = "Vui lòng nhập mã số sinh viên!";
    }
}
?>

<div class="container">
    <h1 class="page-title">Đăng Nhập</h1>
    <form method="POST" action="">
        <label for="maSoSV">Mã số sinh viên:</label>
        <input type="text" id="maSoSV" name="maSoSV" required>
        <button type="submit">Đăng Nhập</button>
    </form>
    <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>
</div>

</body>
</html>
