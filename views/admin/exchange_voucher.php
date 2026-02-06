<?php
session_start();

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../app/models/User.php';

/* ===== CHECK LOGIN & ROLE ===== */
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $money = $_POST['money'] ?? 0;

    $userModel = new User();
    $result = $userModel->exchangeVoucherFlexible($email, $phone, $money);

    if ($result) {
        $message = "<p style='color:green; text-align:center; margin-bottom:15px;'>
                        Đổi voucher thành công (-" . number_format($money) . "đ)
                    </p>";
    } else {
        $message = "<p style='color:red; text-align:center; margin-bottom:15px;'>
                        Không đủ điểm để đổi, vui lòng kiểm tra lại
                    </p>";
    }
}

include __DIR__ . '/../../layouts/header.php';
?>

<div style="
    display:flex;
    justify-content:center;
    align-items:flex-start;
    min-height:calc(100vh - 200px);
    padding-top:60px;
">
    <div style="
        width:420px;
        background:#fff;
        border:1px solid #ddd;
        border-radius:12px;
        padding:28px 30px;
        box-shadow:0 6px 16px rgba(0,0,0,0.12);
    ">
        <h2 style="text-align:center; margin-bottom:22px;">
            Đổi Voucher
        </h2>

        <?= $message ?>

        <form method="POST">
            <!-- EMAIL -->
            <div style="margin-bottom:16px;">
                <label style="display:block;font-weight:600;margin-bottom:6px;">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    required
                    placeholder="Nhập email khách hàng"
                    style="
                        width:100%;
                        height:44px;
                        padding:0 12px;
                        border:1px solid #ccc;
                        border-radius:8px;
                        font-size:14px;
                        box-sizing:border-box;
                    "
                >
            </div>

            <!-- PHONE -->
            <div style="margin-bottom:16px;">
                <label style="display:block;font-weight:600;margin-bottom:6px;">
                    Số điện thoại
                </label>
                <input
                    type="text"
                    name="phone"
                    required
                    placeholder="Nhập số điện thoại"
                    style="
                        width:100%;
                        height:44px;
                        padding:0 12px;
                        border:1px solid #ccc;
                        border-radius:8px;
                        font-size:14px;
                        box-sizing:border-box;
                    "
                >
            </div>

            <!-- MONEY -->
            <div style="margin-bottom:20px;">
                <label style="display:block;font-weight:600;margin-bottom:6px;">
                    Số tiền muốn đổi (VND)
                </label>
                <input
                    type="number"
                    name="money"
                    required
                    placeholder="Ví dụ: 10000, 20000, 50000"
                    style="
                        width:100%;
                        height:44px;
                        padding:0 12px;
                        border:1px solid #ccc;
                        border-radius:8px;
                        font-size:14px;
                        box-sizing:border-box;
                    "
                >
                <div style="font-size:12px;color:#777;margin-top:5px;">
                    10.000đ = 1000 điểm
                </div>
            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                style="
                    width:100%;
                    height:44px;
                    background:#6f4e37;
                    color:#fff;
                    border:none;
                    border-radius:8px;
                    font-size:15px;
                    font-weight:600;
                    cursor:pointer;
                "
            >
                Đổi thưởng
            </button>
        </form>

        <div style="margin-top:18px;">
            <a href="dashboard.php">← Quay lại</a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>
