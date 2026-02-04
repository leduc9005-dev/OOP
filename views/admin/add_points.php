<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Access denied");
}

require_once __DIR__ . "/../../app/models/User.php";

if (!isset($_GET['id'])) {
    die("Thiếu ID khách hàng");
}

$userModel = new User();
$id = (int)$_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $points = (int)$_POST['points'];
    $userModel->addPoints($id, $points);
    header("Location: customers.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Cộng điểm</title>

<style>
body {
    background: #f2f2f2;
    font-family: Arial, sans-serif;
}

.box {
    width: 380px;
    margin: 100px auto;
    padding: 25px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    text-align: center;
}

h3 {
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
    display: inline-block;
    margin-top: 15px;
    text-decoration: none;
}
</style>
</head>

<body>
<div class="box">
    <h3>➕ Cộng điểm khách hàng</h3>

    <form method="post">
        <input type="number" name="points" placeholder="Nhập số điểm (vd: 50)" required>
        <button type="submit">Cộng điểm</button>
    </form>

    <a href="customers.php">⬅ Quay lại</a>
</div>
</body>
</html>
