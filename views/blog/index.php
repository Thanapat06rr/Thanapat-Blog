<?php 
require_once './class/Core.php';
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
</head>

<body>
    <?php foreach($result as $re): ?>
        <h1><?= $re['id'] ?></h1>
        <h1><?= $re['title'] ?></h1>
        <h1><?= $re['description'] ?></h1>
    <?php endforeach ?>
        
    </div>
    <h1>BlogAdd</h1>
    <form action="./controller/blog.controller.php" method="post">
        <input type="text" name="title">
        <input type="text" name="description">
        <input type="hidden" name="action" value="create_blog">
        <button>send</button>
    </form>
    <script>
    </script>
</body>

</html>

