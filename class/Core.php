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

    // public function Insert(array $data, string $table)
    // {
    //     try {
    //         $stmt = $this->conn->prepare("");
    //     } catch (PDOException $e) {
    //     }
    // }

    // public function Update()
    // {
    //     try {
    //     } catch (PDOException $e) {
    //     }
    // }

    // public function Fetch($sql, $param = [], $fetch = null)
    // {
    //     try {
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute($param);
    //         if ($fetch === 'fetch') {
    //             return $stmt->fetch();
    //         } else {
    //             return $stmt->fetchAll();
    //         }
    //     } catch (PDOException $e) {
    //         return ["status" => "error", "message" => "เกิดข้อผิดพลาด", "error" => $e->getMessage()];
    //     }
    // }

    public function Delete($table, $id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM $table WHERE id = ?");
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            return ["status" => "error", "message" => "เกิดข้อผิดพลาด", "error" => $e->getMessage()];
        }
    }

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
}
