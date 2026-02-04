<?php
require_once __DIR__ . "/Database.php";

class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /* ===== LOGIN ===== */
    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email=? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user && md5($password) === $user['password']) {
            return $user;
        }
        return false;
    }

    /* ===== ADMIN: CUSTOMER CRUD ===== */
    public function getAllCustomers() {
        return $this->conn->query("SELECT * FROM users WHERE role='customer'");
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createCustomer($name, $email, $password) {
        $hash = md5($password);
        $role = "customer";
        $stmt = $this->conn->prepare(
            "INSERT INTO users(name,email,password,role) VALUES (?,?,?,?)"
        );
        return $stmt->bind_param("ssss", $name, $email, $hash, $role) && $stmt->execute();
    }

    public function updateCustomer($id, $name, $email) {
        $stmt = $this->conn->prepare(
            "UPDATE users SET name=?, email=? WHERE id=?"
        );
        return $stmt->bind_param("ssi", $name, $email, $id) && $stmt->execute();
    }

    public function deleteCustomer($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id=?");
        return $stmt->bind_param("i", $id) && $stmt->execute();
    }

    /* ===== POINT ===== */
    public function addPoints($id, $points) {
        $stmt = $this->conn->prepare(
            "UPDATE users SET points = points + ? WHERE id=?"
        );
        return $stmt->bind_param("ii", $points, $id) && $stmt->execute();
    }

    /* ===== VOUCHER ===== */
    public function exchangeVoucherByInfo($email, $phone) {
    $stmt = $this->conn->prepare(
        "SELECT id, points FROM users WHERE email=? AND phone=? AND role='customer' LIMIT 1"
    );
    $stmt->bind_param("ss", $email, $phone);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if (!$user || $user['points'] < 1000) {
        return false;
    }

    $stmt = $this->conn->prepare(
        "UPDATE users SET points = points - 1000 WHERE id=?"
    );
    $stmt->bind_param("i", $user['id']);
    $stmt->execute();

    return true;
}
}
