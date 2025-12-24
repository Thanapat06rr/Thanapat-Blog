<?php
session_start();
if (!isset($_SESSION['user_login'])) {
    header("Location: /Thanapat-Blog/");
    exit;
}
require_once 'modal.php';  
require_once 'navbar.php';  
require_once __DIR__ . '/../../class/Core.php';
$core = new Core();

$user_id = $_SESSION['user_login'];
$blogs = $core->fetch("SELECT * FROM blogs WHERE user_id = ?", [$user_id]);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <script src="./package/jq.js"></script>
    <script src="./package/core.js"></script>

    <style>
        body { 
            background-color: #f8f9fa; 
            font-family: 'Sarabun', sans-serif; 
        }
        .navbar-brand {
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .blog-card { 
            transition: all 0.2s ease-in-out; 
            border: none; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); 
            background: #fff;
        }

        .text-truncate-2 { 
            display: -webkit-box; 
            -webkit-line-clamp: 2; 
            -webkit-box-orient: vertical; 
            overflow: hidden; 
        }
    </style>
</head>

<body>
    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h2 class="fw-bold m-0 text-secondary h3">
                <i class="bi bi-grid-fill me-2"></i>บทความของคุณ
            </h2>
            <button class="btn btn-primary shadow-sm" onclick="openModal('create')">
                <i class="bi bi-plus-lg me-2"></i>เขียนบทความใหม่
            </button>
        </div>

        <?php if (count($blogs) > 0): ?>
            <div class="row g-3 g-md-4">
                <?php foreach ($blogs as $blog): ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card blog-card h-100 p-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class=" pe-2" style="width: 230px;">
                                        <h5 class="card-title fw-bold text-primary"><?= htmlspecialchars($blog['title']) ?></h5>
                                        <p class="card-text text-muted text-truncate-2"><?= htmlspecialchars($blog['description']) ?></p>
                                    </div>
                                    <div>
                                        <a href="./?page=detail&id=<?= $blog['id'] ?>" class="btn btn-outline-info btn-sm flex-shrink-0" title="ดูรายละเอียด">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center pt-0">
                                <small class="text-muted" style="font-size: 0.85rem;">
                                    <i class="bi bi-clock me-1"></i><?= $blog['created_at'] ?>
                                </small>
                                
                                <div class="card-actions">
                                    <button class="btn btn-outline-warning btn-sm me-1" onclick='openModal("edit", <?= json_encode($blog) ?>)' title="แก้ไข">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" onclick="deleteBlog(<?= $blog['id'] ?>)" title="ลบ">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5 text-muted">
                <div class="mb-3">
                    <i class="bi bi-journal-x" style="font-size: 4rem; opacity: 0.5;"></i>
                </div>
                <h4>ยังไม่มีบทความ</h4>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const API_URL = "./controller/blog.controller.php";
        const blogModal = new bootstrap.Modal(document.getElementById('blogModal'));

        function openModal(mode, data = null) {
            if (mode === 'create') {
                $('#modalTitle').text('เพิ่มบทความ');
                $('#form_action').val('create_blog');
                $('#blog_id').val('');
                $('#blogForm')[0].reset();
            } else if (mode === 'edit') {
                $('#modalTitle').text('แก้ไขบทความ');
                $('#form_action').val('update_blog');
                $('#blog_id').val(data.id);
                $('#title').val(data.title);
                $('#description').val(data.description);
            }
            blogModal.show();
        }

        $('#blogForm').submit(function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: API_URL,
                data: formData,
                dataType: "json",
                success: function(res) {
                    if (res.status === 'success') {
                        window.location.reload();
                    } else {
                        showMyToast(res.message, 'error');
                    }
                },
                error: function(res) {
                    console.log(res);
                    showMyToast("เกิดข้อผิดพลาด", 'error');
                }
            });
        });

        function deleteBlog(id) {
            if (!confirm("คุณต้องการลบบทความนี้ใช่หรือไม่?")) return;
            $.ajax({
                type: "POST",
                url: API_URL,
                data: { action: 'delete_blog', id: id },
                dataType: "json",
                success: function(res) {
                    if (res.status === 'success') {
                        window.location.reload();
                    } else {
                        showMyToast(res.message, 'error');
                    }
                }
            });
        }
    </script>
</body>
</html>