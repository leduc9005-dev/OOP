<?php
require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . "/../../app/models/Database.php";
require_once __DIR__ . "/../../layouts/header.php";

$db = (new Database())->getConnection();
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $sdt = trim($_POST["sdt"]);
    $password = md5($_POST["password"]);

    $stmt = $db->prepare(
        "INSERT INTO users (name, email, phone, password, role, points)
         VALUES (?, ?, ?, ?, 'customer', 0)"
    );
    $stmt->bind_param("ssss", $name, $email, $sdt, $password);

    if ($stmt->execute()) {
        $message = "Đăng ký thành công! <a href='login.php'>Đăng nhập ngay</a>";
    } else {
        $message = "Email hoặc SĐT đã tồn tại!";
    }
}
?>

<style>
.page-wrapper {
    min-height: calc(100vh - 120px);
    display: flex;
    justify-content: center;
    align-items: center;
}

.form-box {
    width: 380px;
    background: #fff;
    padding: 36px 32px;
    border-radius: 14px;
    box-shadow: 0 12px 30px rgba(0, 0, 0, .15);
    margin: 0 auto;
}

.form-box h2 {
    text-align: center;
    margin-bottom: 28px;
    font-weight: 600;
}

.form-box form {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.form-box input {
    width: 100%;
    height: 46px;
    padding: 0 14px;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
}

.form-box input:focus {
    outline: none;
    border-color: #f2c94c;
}

.form-box button {
    width: 100%;
    height: 46px;
    background: #f2c94c;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
}

.form-box button:hover {
    background: #e6b93d;
}

.form-box p {
    margin-top: 18px;
    text-align: center;
    font-size: 14px;
}

.msg-success {
    color: green;
    font-weight: bold;
}

.msg-error {
    color: red;
}
</style>

<div class="page-wrapper">
    <div class="form-box">
        <h2>Đăng ký</h2>

        <form method="post">
            <input name="name" placeholder="Họ tên" required>
            <input name="email" type="email" placeholder="Email" required>
            <input name="sdt" placeholder="Số điện thoại" required>
            <input name="password" type="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng ký</button>
        </form>

        <?php if ($message): ?>
            <p class="<?= strpos($message, 'thành công') !== false ? 'msg-success' : 'msg-error' ?>">
                <?= $message ?>
            </p>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const logos = document.querySelectorAll('header, .logo, h1, div');
    logos.forEach(el => {
        if (el.innerText.trim() === "THE COFFEE HOUSE" && el.children.length === 0) {
            el.innerHTML = `<a href="../../index.php" style="text-decoration: none; color: inherit;">${el.innerText}</a>`;
        }
    });
});
</script>

<?php require_once __DIR__ . "/../../layouts/footer.php"; ?>
