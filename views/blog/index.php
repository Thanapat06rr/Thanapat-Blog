<?php 
require_once __DIR__ . '/../../class/Core.php';
$core = new Core();
    $result = $core->fetch("SELECT * FROM blogs");
    // var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>

<body>
    <?php foreach($result as $re): ?>
        <h1><?= $re['id'] ?></h1>
        <h1><?= $re['title'] ?></h1>
        <h1><?= $re['description'] ?></h1>
    <?php endforeach ?>
        
<div class="d-flex flex-column justify-content-center" style="min-height:100vh;">
    <h1 class="text-center display-4 mb-4">BlogAdd</h1>
    <form action="./controller/blog.controller.php" method="post"
          class="d-flex flex-column justify-content-center">



    
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-4">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="title" placeholder="ชื่อบทความ">
            <label>กรุณาเพิ่มสิ่งที่คุณคิด</label>
        </div>

        <div class="form-floating mb-3">
            <textarea class="form-control" name="description" placeholder="รายละเอียดบทความ"></textarea>
            <label>กรุณาเพิ่มสิ่งที่คุณคิด</label>
        </div>
    </div>
</div>


    <input type="hidden" name="action" value="create_blog">

<div class="text-center">
    
    <button type="submit" class="btn btn-success px-4">
        ยืนยัน
    </button>
</div>
</div>


    </form>
    <script>
    </script>
</body>
ิ

</html>

