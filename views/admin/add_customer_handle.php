<?php
session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin") {
    die("Access denied");
}

require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . "/../../app/models/Database.php";
require_once __DIR__ . "/../../app/models/User.php";

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

$userModel = new User();
$userModel->addCustomer($name, $email, $password);

header("Location: customers.php");
exit;