<?php
// ===== SESSION =====
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ===== PHÂN QUYỀN =====
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
    header("Location: ../auth/login.php");
    exit;
}

// ===== LOAD DATABASE =====
require_once __DIR__ . '/../../app/models/Database.php';

// ===== HEADER =====
require_once __DIR__ . '/../../layouts/header.php';

// ===== USER INFO =====
$user   = $_SESSION['user'];
$email  = $user['email'];

// ===== DB =====
$db   = new Database();
$conn = $db->getConnection();

// ===== LẤY ĐIỂM =====
$stmt = $conn->prepare("SELECT points FROM customers WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$points = $row ? $row['points'] : 0;
?>

<style>
/* ===== FIX FOOTER + CENTER ===== */
.page-wrapper {
    min-height: calc(100vh - 140px);
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f2f4f8;
}

.container {
    width: 600px;
    background: #fff;
    padding: 24px;
    border-radius: 10px;
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

.logout {
    text-align: center;
    margin-top: 20px;
}

.logout a {
    text-decoration: none;
    color: #fff;
    background: #dc3545;
    padding: 8px 16px;
    border-radius: 6px;
    display: inline-block;
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

        <div class="logout">
            <a href="../auth/logout.php">🚪 Đăng xuất</a>
        </div>
    </div>
</div>

<?php
// ===== FOOTER =====
require_once __DIR__ . '/../../layouts/footer.php';
?>