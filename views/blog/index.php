<?php
require_once './class/Core.php';
$core = new Core();

$user_id = $_SESSION['user_login'];
$result = $core->fetch("SELECT * FROM blogs WHERE user_id = ?", [$user_id]);
// var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./package/jq.js"></script>
</head>

<body>
    <?php foreach ($result as $re): ?>
        <h1><?= $re['id'] ?></h1>
        <h1><?= $re['title'] ?></h1>
        <h1><?= $re['description'] ?></h1>
    <?php endforeach ?>

    </div>
    <h1>BlogAdd</h1>
    <form id="blogAdd">
        <input type="text" id="title" placeholder="title">
        <input type="text" id="description" placeholder="description">
        <button>send</button>
    </form>
    <script>
        $(document).ready(function() {
            $("#blogAdd").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./controller/blog.controller.php",
                    data: {
                        title: $("#title").val(),
                        description: $("#description").val(),
                        action: "create_blog"
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "success") {
                            alert("เพิ่มบทความสำเร็จ");
                            $("#title").val("");
                            $("#description").val("");
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