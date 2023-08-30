<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        username:
        <input type="text" name="username">
        <input type="submit" name="submit">
    </form>
</body>
</html>

<?php

$password = "pizza123";

$hash = password_hash($password, PASSWORD_DEFAULT);

echo $hash;
echo "<br>";

// hash 加密
if (password_verify($password, $hash)) {
    echo "You are logged in!";
} else {
    echo "Incorrect password!";
    echo "<br>";
}

?>