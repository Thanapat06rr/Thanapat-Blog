<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./package/jq.js"></script>
    <script src="./package/core.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>

<style>
    .card {
        border-radius: 15px;
    }
</style>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-sm" style="width: 100%; height: 350px; max-width: 500px;">
            <div class="text-center">
                <h1 class="mb-4 h3">เข้าสู่ระบบ</h1>
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

    <div class="modal fade" id="modal-register">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pb-4 p-5 border-bottom-0">
                    <h5 class="fs-5">ลงทะเบียนสมัครสมาชิก</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>

                <div class="modal-body p-5 pt-0">
                    <form id="register" method="post">
                        <div class="row g-2 mb-3">

                            <div class="col-md-12 form-floating">
                                <input type="text" class="form-control" id="fname" placeholder="ชื่อผู้ใช้งาน">
                                <label for="">ชื่อ</label>
                            </div>

                            <div class="col-md-12 form-floating">
                                <input type="text" class="form-control" id="lname" placeholder="รหัสผ่าน">
                                <label for="">นามสกุล</label>
                            </div>
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" id="username" placeholder="ชื่อผู้ใช้งาน">
                                <label for="">ชื่อผู้ใช้งาน</label>
                            </div>

                            <div class="col-md-6 form-floating">
                                <input type="password" class="form-control" id="password" placeholder="รหัสผ่าน">
                                <label for="">รหัสผ่าน</label>
                            </div>

                        </div>

                        <button type="submit" name="signup" class="btn btn-primary w-100">
                            ลงทะเบียนสมัครสมาชิก
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="modal fade" id="" tabindex="-1" aria-hidden="true">
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
    </div> -->


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
                            showMyToast(response.message, 'success');
                            setTimeout(() => {
                                window.location.href = "./?page=blog";
                            }, 500)
                        } else {
                            showMyToast(response.message, 'error');
                            // alert(response.message);
                        }
                    }
                });
            });
            $("#register").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./controller/auth.controller.php",
                    data: {
                        fname: $("#fname").val(),
                        lname: $("#lname").val(),
                        username: $("#username").val(),
                        password: $("#password").val(),
                        action: "register"
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "success") {
                            showMyToast(response.message, 'success');
                            $('#modal-register').modal('hide');
                            $("#fname").val("");
                            $("#lname").val("");
                            $("#username").val("");
                            $("#password").val("");
                        } else {
                            showMyToast(response.message, 'error');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>