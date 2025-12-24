<?php
session_start();
if (!isset($_SESSION['user_login'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

require_once __DIR__ . '/../../class/Core.php';
$core = new Core();

$blog_id = $_GET['id'];
$user_id = $_SESSION['user_login'];
$blog = $core->fetch("SELECT * FROM blogs WHERE id = ? AND user_id = ?", [$blog_id, $user_id]);

if (empty($blog)) {
    echo "<script>alert('ไม่พบข้อมูลบทความ'); window.location.href='index.php';</script>";
    exit;
}
$row = $blog[0]; 
require_once 'navbar.php';  
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($row['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Sarabun', sans-serif; }
        .content-area { white-space: pre-line; line-height: 1.8; font-size: 1.1rem; color: #333; }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="mb-4">
            <a href="./?page=blog" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>กลับหน้าหลัก
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-5">
                
                <h1 class="fw-bold text-primary mb-3"><?= $row['title'] ?></h1>
                
                <div class="d-flex align-items-center text-muted mb-4 border-bottom pb-3">
                    <i class="bi bi-clock me-2"></i>
                    <span>โพสต์เมื่อ: <?= $row['created_at'] ?? 'ไม่ระบุเวลา' ?></span>
                </div>

                <div class="content-area">
                    รายละเอียด : <?= $row['description'] ?>
                </div>

            </div>
        </div>
    </div>

</body>
</html>