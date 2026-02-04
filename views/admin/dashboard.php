<?php
session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin") {
    die("Access denied");
}

$user = $_SESSION["user"];

require_once __DIR__ . "/../../layouts/header.php";
?>

<style>
.page-wrapper{
    min-height: calc(100vh - 140px);
    display: flex;
    justify-content: center;
    align-items: center;
    background:#f4f6f8;
}

.box {
    background: #fff;
    width: 420px;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 0 18px rgba(0,0,0,0.15);
}

h2 {
    text-align: center;
    margin-bottom: 10px;
}

p {
    text-align: center;
    color: #555;
}

ul {
    list-style: none;
    padding: 0;
    margin-top: 25px;
}

li {
    margin-bottom: 12px;
}

.admin-btn {
    display: block;
    padding: 12px;
    background: #0d6efd;
    color: #fff;
    text-align: center;
    border-radius: 12px;
    font-weight: 600;
}

a.btn:hover {
    background: #0056b3;
}
</style>

<div class="page-wrapper">
    <div class="box">
        <h2>Xin chào ADMIN</h2>
        <p><?= htmlspecialchars($user["email"]) ?></p>

        <ul>
            <li><a class="admin-btn" href="customers.php">Quản lý khách hàng</a></li>
            <li><a class="admin-btn" href="exchange_voucher.php">Đổi thưởng</a></li>
            <li><a class="admin-btn" href="../auth/logout.php">Đăng xuất</a></li>
        </ul>
    </div>
</div>

<?php require_once __DIR__ . "/../../layouts/footer.php"; ?>