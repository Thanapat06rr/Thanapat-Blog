<?php
header('Content-Type: application/json');
require_once '../class/auth.php';
require_once '../class/Core.php';

$auth = new Auth();
$core = new Core();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'login') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $check = $core->validate([$username, $password]);

        if ($check['status'] !== 'success') {
            echo json_encode($check);
            exit;
        }
        $result = $auth->login($username, $password);
        echo json_encode($result);
        exit;
    } else if ($action === 'register') {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $check = $core->validate([$fname, $lname,$username, $password]);

        if ($check['status'] !== 'success') {
            echo json_encode($check);
            exit;
        }
        $result = $auth->register($fname, $lname, $username, $password);
        echo json_encode($result);
        exit;
    } else if ($action === 'logout') {
        unset($_SESSION['user_login']);
        session_destroy();
    }
}
