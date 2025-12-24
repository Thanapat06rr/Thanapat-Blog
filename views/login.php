<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="./package/jq.js"></script>
</head>

<body style="background: #EEAECA;
background: radial-gradient(circle, rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%);">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
            <div class="text-center">
                <h1 class="mb-4">เข้าสู่ระบบ</h1>
                <form id="login">
                    <div class="mb-3">
                        <input type="text" id="login_username" class="form-control" placeholder="ชื่อผู้ใช้">
                    </div>

                    <div class="mb-3"> <input type="password" id="login_password" class="form-control" placeholder="รหัสผ่าน">
                    </div>

                    <input type="hidden" value="login" name="action">
                    <button type="submit" class="btn btn-primary w-100 mt-2">เข้าสู่ระบบ</button>
                </form>

                <div class="mt-3">
                    <small>ยังไม่มีบัญชี? <a href="#myModal" data-bs-toggle="modal" data-bs-target="#modal-register">สมัครสมาชิก</a></small>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-register" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>สมัครสมาชิก</h1>
                    <form id="register">
                        <input type="text" id="reg_fname" placeholder="ชื่อ">
                        <input type="text" id="reg_lname" placeholder="นามสกุล">
                        <input type="text" id="reg_username" placeholder="ชื่อผู้ใช้">
                        <input type="hidden" value="register" name="action">
                        <input type="password" id="reg_password" placeholder="รหัสผ่าน"> <button type="submit">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $("#login").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./controller/auth.controller.php",
                    data: {
                        username: $("#login_username").val(),
                        password: $("#login_password").val(),
                        action: "login"
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "success") {
                            window.location.href = "./?page=blog";
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });
        });
        $(document).ready(function() {
            $("#register").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./controller/auth.controller.php",
                    data: {
                        fname: $("#reg_fname").val(),
                        lname: $("#reg_lname").val(),
                        username: $("#reg_username").val(),
                        password: $("#reg_password").val(),
                        action: "register"
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "success") {
                            alert("สมัครสมาชิกสำเร็จ");
                            $("#reg_fname").val("");
                            $("#reg_lname").val("");
                            $("#reg_username").val("");
                            $("#reg_password").val("");
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });
        });
        $(document).ready(function() {
            $("#register").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./controller/auth.controller.php",
                    data: {
                        fname: $("#reg_fname").val(),
                        lname: $("#reg_lname").val(),
                        username: $("#reg_username").val(),
                        password: $("#reg_password").val(),
                        action: "register"
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "success") {
                            alert("สมัครสมาชิกสำเร็จ");
                            $("#reg_fname").val("");
                            $("#reg_lname").val("");
                            $("#reg_username").val("");
                            $("#reg_password").val("");
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>