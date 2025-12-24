<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./package/jq.js"></script>
</head>

<form action="./controller/auth.controller.php" method="POST">
    <input type="text" name="fname" placeholder="First Name">
    <input type="text" name="lname" placeholder="Last Name">
    <input type="text" name="username" placeholder="Username">
    <input type="hidden" value="register" name="action">
    <input type="password" name="password" placeholder="Password"> <button type="submit">
        Send
    </button>
</form>

<h1>Login</h1>
<form action="./controller/auth.controller.php" method="POST">
    <input type="text" name="username" placeholder="First Name">
    <input type="text" name="password" placeholder="Last Name">
    <input type="hidden" value="login" name="action">
    <button>Send</button>
</form>

<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "./controller/auth.controller.php",
            data: "data",
            dataType: "json",
            success: function(response) {

            }
        });
    });
</script>
</body>

</html>