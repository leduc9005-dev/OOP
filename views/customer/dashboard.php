<?php
// ===== SESSION =====
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ===== CHECK LOGIN =====
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
    header("Location: ../auth/login.php");
    exit;
}

// ===== LOAD FILE =====
require_once __DIR__ . '/../../app/models/Database.php';
require_once __DIR__ . '/../../layouts/header.php';

// ===== USER INFO =====
$user   = $_SESSION['user'];
$email  = $user['email'];

// ===== DB CONNECT =====
$db   = new Database();
$conn = $db->getConnection();

// ===== LẤY ĐIỂM TỪ DB =====
$stmt = $conn->prepare("SELECT points FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$points = $row ? $row['points'] : 0;
?>

<style>
.page-wrapper {
    min-height: calc(100vh - 140px);
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f2f4f8;
}

.container {
    width: 620px;
    background: #fff;
    padding: 26px;
    border-radius: 12px;
    box-shadow: 0 0 18px rgba(0,0,0,0.12);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    padding: 12px;
    border: 1px solid #ccc;
    text-align: center;
}

table th {
    background: #007bff;
    color: #fff;
}

.action-group {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 22px;
}

.btn {
    text-decoration: none;
    padding: 9px 18px;
    border-radius: 8px;
    color: #fff;
    font-weight: 600;
    display: inline-block;
}

.btn-pass {
    background: #28a745;
}

.btn-pass:hover {
    background: #218838;
}

.btn-logout {
    background: #dc3545;
}

.btn-logout:hover {
    background: #c82333;
}
</style>

<div class="page-wrapper">
    <div class="container">
        <h2>👤 Thông tin khách hàng</h2>

        <table>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Điểm hiện tại</th>
            </tr>
            <tr>
                <td><?= htmlspecialchars($user["name"] ?? "Khách hàng") ?></td>
                <td><?= htmlspecialchars($email) ?></td>
                <td><?= $points ?></td>
            </tr>
        </table>

        <div class="action-group">
            <a href="change_password.php" class="btn btn-pass">
                🔒 Đổi mật khẩu
            </a>

            <a href="../auth/logout.php" class="btn btn-logout">
                🚪 Đăng xuất
            </a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>
