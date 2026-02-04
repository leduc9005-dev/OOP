<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Access denied");
}

require_once __DIR__ . "/../../app/models/User.php";
$userModel = new User();
$customers = $userModel->getAllCustomers();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Quản lý khách hàng</title>

<style>
/* ===== RESET + LAYOUT ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    height: 100%;
    font-family: Arial, sans-serif;
    background: #f2f2f2;
}

.page-wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* ===== MAIN CONTENT ===== */
.main-content {
    flex: 1;
}

/* ===== BOX ===== */
.box {
    width: 900px;
    margin: 50px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
}

/* ===== TABLE ===== */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: center;
}

th {
    background: #f5f5f5;
}

/* ===== LINKS ===== */
a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
}
</style>
</head>

<body>
<div class="page-wrapper">

    <!-- HEADER -->
    <?php require_once __DIR__ . "/../../layouts/header.php"; ?>

    <!-- MAIN -->
    <div class="main-content">
        <div class="box">
            <h2>📋 Quản lý khách hàng</h2>

            <a href="add_customer.php">➕ Thêm khách hàng</a>
            <br><br>

            <table>
                <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Điểm</th>
                    <th>Hành động</th>
                </tr>

                <?php while ($c = $customers->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($c['name']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= $c['points'] ?></td>
                    <td>
                        <a href="edit_customer.php?id=<?= $c['id'] ?>">✏️ Sửa</a> |
                        <a href="add_points.php?id=<?= $c['id'] ?>">➕ Điểm</a> |
                        <a href="delete_customer.php?id=<?= $c['id'] ?>"
                           onclick="return confirm('Xóa khách hàng?')">🗑 Xóa</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>

            <br>
            <a href="dashboard.php">⬅ Quay lại Dashboard</a>
        </div>
    </div>

    <!-- FOOTER -->
    <?php require_once __DIR__ . "/../../layouts/footer.php"; ?>

</div>
</body>
</html>