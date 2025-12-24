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

    <!-- <h1>สมัครสมาชิก</h1>
<form id="register">
    
    
    
    <input type="password" id="reg_password" placeholder="รหัสผ่าน">
    <input type="hidden" value="register" name="action">
     <button type="submit">Send</button>
</form> -->

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
            <div class="text-center">
                <h1 class="mb-4">สมัครสมาชิก</h1>
                <form id="login">
                    <div class="mb-3">
                        <input type="text" id="reg_fname"  class="form-control"placeholder="ชื่อ">
                    </div>
                    <div class="mb-3">
                        <input type="text" id="reg_lname" class="form-control" placeholder="นามสกุล">
                    </div>
                    <div class="mb-3">
                        <input type="text" id="reg_username" class="form-control" placeholder="ชื่อผู้ใช้">
                    </div>
                    <div class="mb-3">
                        <input type="password" id="login_password" class="form-control" placeholder="รหัสผ่าน">
                    </div>


                    <button type="submit" class="btn btn-primary w-100 mt-2">เข้าสู่ระบบ</button>
                </form>

                <div class="mt-3">
                    <small>มีบัญชีอยู่แล้ว <a href="http://localhost/Thanapat-Blog/">เข้าสู่ระบบ</a></small>
                </div>
            </div>
        </div>
    </div>


    <script>
        
    </script>
</body>

</html>