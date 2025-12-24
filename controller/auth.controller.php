<?php
require_once '../class/auth.php';
$auth = new Auth();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_POST['action'] ?? '';

    if($action === 'login'){
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $result = $auth->login($username, $password);
        // if($result === "success"){
        // }
        header("Location: ../blog");
        // var_dump($result);
        // var_dump($username);
        // var_dump($password);
    }else if($action === 'register'){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = $auth->register($fname, $lname, $username, $password);
        exit;
    }
}   
?>