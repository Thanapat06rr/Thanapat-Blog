<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</body>

</html>