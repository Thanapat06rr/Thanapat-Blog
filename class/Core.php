<?php
require_once __DIR__ . '/../config/db.php';

class Core
{
    private $conn;
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getDB();
    }

    // ฟังชั่น ลบข้อมูล
    public function Delete($table, $id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM $table WHERE id = ?");
            $stmt->execute([$id]);
            return ["status" => "success", "message" => "ลบข้อมูลสำเร็จ"];
        } catch (PDOException $e) {
            return ["status" => "error", "message" => "เกิดข้อผิดพลาด", "error" => $e->getMessage()];
        }
    }

    // ฟังชั่น query - จัดการเกี่ยวกับฐานข้อมูล โดยรีบค่าจากparam sql
    public function query($sql, $where = [])
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($where);
            return ["status" => "success", "message" => "ดำเนินการสำเร็จ"];
        } catch (PDOException $e) {
            return ["status" => "error", "message" => "เกิดข้อผิดพลาด", "error" => $e->getMessage()];
        }
    }

    // ฟังชั่น ดึงข้อมูล
    public function fetch($sql, $where = [])
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($where);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return ["status" => "error", "message" => "เกิดข้อผิดพลาด", "error" => $e->getMessage()];
        }
    }

    // ฟังชั่น ตรวจสอบความถูกต้องของ ข้อมูล
    public function validate($data)
    {
        foreach ($data as $value) {
            $val = trim($value);
            if (empty($val)) {
                return [
                    "status" => "error",
                    "message" => "กรุณากรอกข้อมูลให้ครบ"
                ];
            }

            if (!preg_match('/^[a-zA-Z0-9ก-๙\s.,?!_\-()\]+$/u', $val)) {
                return [
                    "status" => "error",
                    "message" => "กรุณากรอกโดยไม่มีอักษรพิเศษ"
                ];
            }
        }

        return ["status" => "success"];
    }
}
