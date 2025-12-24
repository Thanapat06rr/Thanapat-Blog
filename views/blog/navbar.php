<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-journal-richtext me-2"></i>MEC Blog
            </a>

            <div class="d-flex align-items-center">
                <button onclick="logout()" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i>ออกจากระบบ
                </button>
            </div>
        </div>
    </nav>

    <script>
        function logout() {
            if (!confirm("คุณต้องการออกจากระบบหรือไม่?")) return;
            $.ajax({
                type: "POST",
                url: './controller/auth.controller.php',
                data: {
                    action: "logout"
                },
                dataType: "json",
                success: function(response) {
                    window.location.href = '/Thanapat-Blog/';
                },
                error: function(xhr, status, error) {
                    console.log("Logout Warning:", error);
                    window.location.href = '/Thanapat-Blog/';
                }
            });
        }
    </script>
</body>

</html>