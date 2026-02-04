<?php
session_start();
require_once __DIR__ . "/../../config/config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if ($email === "" || $password === "") {
        $error = "Vui lòng nhập đầy đủ thông tin";
    } else {

        $stmt = $conn->prepare("
            SELECT id, name, email, password, role, points
            FROM users
            WHERE email = ?
            LIMIT 1
        ");

        if (!$stmt) {
            die("SQL error: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (md5($password) === $user["password"]) {

                $_SESSION["user"] = [
                    "id"     => $user["id"],
                    "name"   => $user["name"],
                    "email"  => $user["email"],
                    "role"   => $user["role"],
                    "points" => $user["points"]
                ];

                if ($user["role"] === "admin") {
                    header("Location: ../admin/dashboard.php");
                } else {
                    header("Location: ../customer/dashboard.php");
                }
                exit;

            } else {
                $error = "Sai email hoặc mật khẩu";
            }
        } else {
            $error = "Sai email hoặc mật khẩu";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đăng nhập</title>

<style>
* {
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body {
    margin: 0;
    background: #f4f6f8;
}

/* ===== LOGIN PAGE ===== */
.login-page{
    max-width: 420px;
    margin: 80px auto 60px; /* TOP - CENTER - BOTTOM */
}

/* ===== LOGIN BOX ===== */
.login-box {
    background: #fff;
    padding: 36px 32px;
    border-radius: 14px;
    box-shadow: 0 12px 30px rgba(0,0,0,.15);
}

.login-box h2 {
    text-align: center;
    margin-bottom: 24px;
}

/* ===== INPUT ===== */
.login-box input {
    width: 100%;
    height: 44px;
    padding: 0 14px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
}

.login-box input:focus{
    outline:none;
    border-color:#f2c94c;
}

/* ===== BUTTON ===== */
.login-box button {
    width: 100%;
    height: 44px;
    background: #f2c94c;
    border: none;
    border-radius: 22px;
    font-weight: bold;
    cursor: pointer;
}

.login-box button:hover {
    background: #e2b93c;
}

/* ===== ERROR ===== */
.error {
    color: red;
    text-align: center;
    margin-bottom: 14px;
    font-size:14px;
}
</style>
</head>

<body>

<?php require_once __DIR__ . "/../../layouts/header.php"; ?>

<div class="login-page">
    <div class="login-box">

        <h2>Đăng nhập</h2>
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Mật khẩu">
            <button type="submit">Đăng nhập</button>
        </form>

    </div>
</div>

<?php require_once __DIR__ . "/../../layouts/footer.php"; ?>

</body>
</html>