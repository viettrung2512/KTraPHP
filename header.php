<?php
function displayHeader() {
    echo '<!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quản lý Sinh Viên</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f8f9fa;
            }
            .header {
                background-color: #343a40;
                color: white;
                padding: 15px 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 100%;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            }
            .logo {
                font-size: 24px;
                font-weight: bold;
                margin-left: 20px;
            }
            .nav {
                display: flex;
                list-style-type: none;
                margin: 0;
                padding: 0;
            }
            .nav li {
                margin: 0;
            }
            .nav li a {
                color: white;
                text-decoration: none;
                padding: 12px 18px;
                display: block;
                font-size: 16px;
                transition: background 0.3s, color 0.3s;
                border-radius: 5px;
            }
            .nav li a:hover {
                background-color: #495057;
                color: #f8f9fa;
            }
            .container {
                max-width: 1200px;
                margin: 20px auto;
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            }
            .page-title {
                font-size: 28px;
                color: #343a40;
                text-align: center;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="logo">QLSV</div>
            <ul class="nav">
                <li><a href="index.php">Trang Chủ</a></li>
                <li><a href="index.php">Sinh Viên</a></li>
                <li><a href="hoc_phan_list.php">Học Phần</a></li>
                <li><a href="dangkyhp.php">Đăng Ký</a></li>
                <li><a href="login.php">Đăng Nhập</a></li>
            </ul>
        </div>
        <div class="container">
           <h1 class="page-title">TRANG SINH VIÊN</h1>'; 
}
?>