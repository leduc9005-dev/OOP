<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . '/../../app/models/Database.php';
require_once __DIR__ . '/../../layouts/header.php';

$user  = $_SESSION['user'];
$email = $user['email'];

$db   = new Database();
$conn = $db->getConnection();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $oldPass     = md5($_POST["old_password"]);
    $newPass     = md5($_POST["new_password"]);
    $confirmPass = md5($_POST["confirm_password"]);

    if ($newPass !== $confirmPass) {
        $message = "Mật khẩu mới không khớp!";
    } else {
        $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row || $row['password'] !== $oldPass) {
            $message = "Mật khẩu cũ không đúng!";
        } else {
            $update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update->bind_param("ss", $newPass, $email);

            if ($update->execute()) {
                $message = "Đổi mật khẩu thành công!";
            } else {
                $message = "Có lỗi xảy ra!";
            }
        }
    }
}
?>

<style>
.page-wrapper {
    min-height: calc(100vh - 140px);
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f2f4f8;
}

.form-box {
    width: 420px;
    background: #fff;
    padding: 28px;
    border-radius: 10px;
    box-shadow: 0 0 18px rgba(0,0,0,0.12);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

input {
    height: 42px;
    padding: 0 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

button {
    height: 42px;
    background: #28a745;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background: #218838;
}

.msg {
    text-align: center;
    margin-top: 12px;
    font-weight: bold;
    color: red;
}

.success {
    color: green;
}

header .btn {
    border-radius: 25px !important;
    border: 1px solid #fff;
}

header.scrolled .btn {
    border: 1px solid var(--tch-orange);
}

</style>

<div class="page-wrapper">
    <div class="form-box">
        <h2>🔒 Đổi mật khẩu</h2>

        <form method="post">
            <input type="password" name="old_password" placeholder="Mật khẩu cũ" required>
            <input type="password" name="new_password" placeholder="Mật khẩu mới" required>
            <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu mới" required>
            <button type="submit">Cập nhật mật khẩu</button>
        </form>

        <?php if ($message): ?>
            <div class="msg <?= strpos($message,'thành công') !== false ? 'success' : '' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>
