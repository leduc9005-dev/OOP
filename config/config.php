<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conn = new mysqli("localhost", "root", "", "crm_oop", 3306);

if ($conn->connect_error) {
    die("DB Error: " . $conn->connect_error);
}
// Đường dẫn tuyệt đối đến thư mục public chứa index.php
define('BASE_URL', 'http://localhost/coffee_house/public/');
// Đường dẫn đến thư mục auth (dùng cho Login/Register)
define('AUTH_URL', 'http://localhost/coffee_house/views/auth/');