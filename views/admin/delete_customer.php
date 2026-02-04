<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Access denied");
}

require_once __DIR__ . "/../../app/models/User.php";

if (!isset($_GET['id'])) {
    die("Thiếu ID");
}

$userModel = new User();
$userModel->deleteCustomer((int)$_GET['id']);

header("Location: customers.php");
exit;
