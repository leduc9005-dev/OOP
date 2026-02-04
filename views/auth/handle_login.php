<?php
session_start();

require_once "../../app/models/Database.php";

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";
$role = $_POST["role"] ?? "";

$db = new Database();
$conn = $db->getConnection();

$sql = "SELECT * FROM users WHERE email = ? AND role = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $role);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && $password === $user["password"]) {
    $_SESSION["user"] = $user;

    if ($role === "admin") {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../customer/dashboard.php");
    }
    exit;
}

header("Location: login.php?error=1");
exit;
