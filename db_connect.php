<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to UTF-8
mysqli_set_charset($conn, "utf8");

// Function to get NganhHoc list
function getNganhHoc($conn) {
    $sql = "SELECT * FROM NganhHoc";
    $result = $conn->query($sql);
    $nganhs = [];
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $nganhs[$row['MaNganh']] = $row['TenNganh'];
        }
    }
    
    return $nganhs;
}
?>