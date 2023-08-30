
<?php
//two ways to user mysql:
// 1.mysqli extension
// 2.PDO (PHP Data Object)

    include "database.php";

    $username = "Squidward";
    $password = "clarinet2";
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // $sql = "INSERT INTO users (user, password) 
    //     VALUES ('$username', '$hash')";
    // try {
    //     mysqli_query($conn, $sql);
    //     mysqli_close($conn);
    // } catch (mysqli_sql_exception $e) {
    //     // throw $e;
    //     echo "The user is already existed.";
    // }

    $sql1 = "SELECT * FROM users WHERE user = '$username' LIMIT 1";
    $res = mysqli_query($conn, $sql1);
    if ($res) {
        foreach (mysqli_fetch_assoc($res) as $key => $value ) {
            echo "{$key} = {$value} <br>";
        }
    }

    mysqli_close($conn);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hello <br>
</body>
</html>