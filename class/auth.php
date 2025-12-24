<?php
require_once '../config/db.php';

class Auth
{
    private $conn;
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getDB();
    }

    // ฟังชั่นเข้าสู่ระบบ
    public function login($username, $password)
    {
        try {
            if (!isset($username, $password)) {
                return ["status" => "error", "message" => "กรุณากรอกข้อมูลให้ครบ"];
            }
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            // password_verify($password, $user['password']);5
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_login'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return ["status" => "success", "message" => "เข้าสู่ระบบสำเร็จ"];
            } else {
                return ["status" => "error", "message" => "ชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง"];
            }
        } catch (PDOException $e) {
            return ["status" => "error", "message" => "เกิดข้อผิดพลาด", "error" => $e->getMessage()];
        }
    }

    // ฟังชั่นสมัครสมาชิก
    public function register($fname, $lname, $username, $password)
    {
        try {
            if (empty($fname) || empty($lname) || empty($username) || empty($password)) {
                return ["status" => "error", "message" => "กรุณากรอกข้อมูลให้ครบ"];
            }

            $check = $this->conn->prepare("SELECT id FROM users WHERE username = ?");
            $check->execute([$username]);

            if ($check->rowCount() > 0) {
                return ["status" => "error", "message" => "ชื่อผู้ใช้นี้มีคนใช้แล้ว"];
            }
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("INSERT INTO users(fname, lname, username, password)VALUES(?, ?, ?, ?)");
            $stmt->execute([$fname, $lname, $username, $hashPassword]);
            return ["status" => "success", "message" => "สมัครสมาชิกสำเร็จ"];
        } catch (PDOException $e) {
            return ["status" => "error", "message" => "เกิดข้อผิดพลาด", "error" => $e->getMessage()];
        }
    }
}
