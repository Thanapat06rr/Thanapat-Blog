<?php
session_start();
require_once '../class/Core.php';
$core = new Core();

header('Content-Type: application/json');

$req_method = $_SERVER['REQUEST_METHOD'];
$action = $_POST['action'] ?? '';

if ($req_method === 'POST') {
    
    // Handle เพิ่ม blog
    if ($action === 'create_blog') {
        if (!isset($_SESSION['user_login'])) {
            echo json_encode(["status" => "error", "message" => "กรุณาเข้าสู่ระบบก่อน"]);
            exit;
        }

        $user_id = $_SESSION['user_login'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        $check = $core->validate([$title, $description]);

        if ($check['status'] !== 'success') {
            echo json_encode($check);
            exit;
        }
        $result = $core->query("INSERT INTO blogs(user_id, title, description) VALUES(?, ?, ?)", [$user_id, $title, $description]);

        if ($result) {
            echo json_encode(["status" => "success", "message" => "เพิ่มบทความสำเร็จ"]);
        } else {
            echo json_encode(["status" => "error", "message" => "เกิดข้อผิดพลาดในการบันทึก"]);
        }
        exit;
    }

    // Handle อัพเดท blog
    if ($action === 'update_blog') {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        $check = $core->validate([$title, $description]);

        if ($check['status'] !== 'success') {
            echo json_encode($check);
            exit;
        }

        $result = $core->query("UPDATE blogs SET title = ?, description = ? WHERE id= ?", [$title, $description, $id]);
        echo json_encode($result);
        exit;
    }

    // Handle ลบ blog
    if ($action === 'delete_blog') {
        $id = $_POST['id'] ?? '';
        $result = $core->Delete('blogs', $id);
        echo json_encode($result);
        exit;
    }
}