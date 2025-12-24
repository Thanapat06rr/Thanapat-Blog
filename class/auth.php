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

    public function login($username, $password)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            // password_verify($password, $user['password']);5
            if($user && password_verify($password, $user['password'])){
                $_SESSION['user_login'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return ["status" => "success", "message" => "เข้าสู่ระบบสำเร็จ"];
            }else{
                return ["status" => "error", "message" => "ชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง"];
            }
            
        } catch (PDOException $e) {
            return ["status" => "error", "message" => "เกิดข้อผิดพลาด", "error" => $e->getMessage()];
        }
    }
    
    public function register($fname, $lname, $username, $password){
        try{
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("INSERT INTO users(fname, lname, username, password)VALUES(?, ?, ?, ?)");
            $stmt->execute([$fname, $lname, $username, $hashPassword]);
            return ["status" => "success", "message" => "สมัครสมาชิกสำเร็จ"];
        }catch(PDOException $e){
            return ["status" => "error", "message" => "เกิดข้อผิดพลาด", "error" => $e->getMessage()];
        }
    }
}
