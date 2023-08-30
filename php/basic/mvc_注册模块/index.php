<?php

require_once "handlers/signupHandler.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <h2>Welcome to Fakebook</h2>
        用户名称: <br>
        <input type="text" name="username"> <br>
        设置密码: <br>
        <input type="password" name="password"> <br>
        确认密码: <br>
        <input type="password" name="retype"> <br>
        邮箱地址: <br>
        <input type="email" name="email"> <br>
        <input type="submit" name="submit" value="注册">
    </form>
</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $retype = $_POST['retype'];
    $email = $_POST['email'];

    $hdSignup = new SignupHandler();
    if (!$hdSignup->checkName($username)) {
        return;
    }
    if (!$hdSignup->checkPassword($password, $retype)) {
        return;
    }

    if (!$hdSignup->checkEmail($email)) {
        return;
    }
    $bExist = $hdSignup->isUserExist($username, $email);
    if (!$bExist) {
        if ($hdSignup->addUser($username, $password, $email)) {
            echo "注册成功!";
        }
    } else {
        echo "用户已注册!";
    }
}

?>