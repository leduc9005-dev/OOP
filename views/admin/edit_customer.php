<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Access denied");
}

require_once __DIR__ . "/../../app/models/User.php";

$userModel = new User();
$id = (int)$_GET['id'];
$customer = $userModel->getById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userModel->updateCustomer(
        $id,
        $_POST['name'],
        $_POST['email']
    );
    header("Location: customers.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Sửa khách hàng</title>

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
    background: #28a745;
    color: white;
    font-size: 15px;
    cursor: pointer;
}

button:hover {
    background: #1e7e34;
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
    <h3>✏️ Sửa thông tin khách hàng</h3>

    <form method="post">
        <input type="text" name="name"
               value="<?= htmlspecialchars($customer['name']) ?>"
               placeholder="Tên khách hàng" required>

        <input type="email" name="email"
               value="<?= htmlspecialchars($customer['email']) ?>"
               placeholder="Email" required>

        <button type="submit">Lưu thay đổi</button>
    </form>

    <a href="customers.php">⬅ Quay lại</a>
</div>
</body>
</html>
