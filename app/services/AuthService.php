<?php
require_once __DIR__ . '/../models/Database.php';

class AuthService
{
    public static function login($email, $password, $role)
    {
        $conn = Database::getConnection();

        $stmt = $conn->prepare(
            "SELECT * FROM users WHERE email = ? AND role = ? LIMIT 1"
        );
        $stmt->bind_param("ss", $email, $role);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user) {
            return false;
        }

        if ($password !== $user['password']) {
            return false;
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        return true;
    }
}
