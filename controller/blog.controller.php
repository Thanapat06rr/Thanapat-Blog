<?php
session_start();
require_once '../class/Core.php';
$core = new Core();

header('Content-Type: application/json');

$req_method = $_SERVER['REQUEST_METHOD'];
$action = $_POST['action'] ?? '';

if ($req_method === 'POST') {
    if ($action === 'create_blog') {
        if (!isset($_SESSION['user_login'])) {
            echo json_encode(["status" => "error", "message" => "กรุณาเข้าสู่ระบบก่อน"]);
            exit;
        }
        $user_id = $_SESSION['user_login'];
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';

        $result = $core->query("INSERT INTO blogs(user_id, title, description) VALUES(?, ?, ?)", [$user_id, $title, $description]);

        if ($result) {
            echo json_encode(["status" => "success", "message" => "เพิ่มบทความสำเร็จ"]);
        } else {
            echo json_encode(["status" => "error", "message" => "เกิดข้อผิดพลาดในการบันทึก"]);
        }
        exit;
    }
}

if($req_method === 'PUT'){
    if($action === 'update_blog'){
        $id = $_SESSION['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $result = $core->query("UPDATE blogs SET :title = ?, :description = ? WHER id= ?", [$title, $description, $id]);
        exit;
    }
}

if($req_method === 'DELETE'){
    if($action === 'delete_blog'){
        $id = $_POST['id'] ?? '';
        $result = $core->Delete('blogs', $id);
    }
}
?>