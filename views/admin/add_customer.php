<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Access denied");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Thêm khách hàng</title>

<style>
body {
    background: #f2f2f2;
    font-family: Arial, sans-serif;
}

.box {
    width: 400px;
    margin: 100px auto;
    padding: 25px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

h3 {
    text-align: center;
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    width: 100%;
    padding: 12px;
    border-radius: 6px;
    border: none;
    background: #007bff;
    color: white;
    font-size: 15px;
    cursor: pointer;
}

button:hover {
    background: #0056b3;
}

a {
    display: block;
    text-align: center;
    margin-top: 15px;
    text-decoration: none;
}
</style>
</head>

<body>

<div class="box">
    <h3>➕ Thêm khách hàng</h3>

    <form action="add_customer_handle.php" method="post">
        <input type="text" name="name" placeholder="Tên khách hàng" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>

        <button type="submit">Lưu khách hàng</button>
    </form>

    <a href="customers.php">⬅ Quay lại</a>
</div>

</body>
</html>
