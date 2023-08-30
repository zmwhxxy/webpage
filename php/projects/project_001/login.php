<?php

session_start();

$email = "";
$password = "";

include("classes/connect.php");
include("classes/login.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = new Login();
    $result = $login->evaluate($_POST);
    if ($result == "") {
        header("Location: profile.php");
        die;
    } else {
        echo "<script>alert('{$result}')</script>";
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
}


?>



<html>

<head>
    <title>Mybook | Login</title>
</head>

<body>
    <div class="bar1">
        <div class="text1">Mybook</div>
        <a href="signup.php">
            <div class="button1">Signup</div>
        </a>
    </div>

    <div class="bar2">
        Log in to Mybook <br><br>

        <form action="" method="post">
            <input name="email" value="<?php echo $email ?>" type="email" class="text2" placeholder="Email"> <br><br>
            <input name="password" value="<?php echo $password ?>" type="password" class="text2" placeholder="Password"> <br><br>
            <input type="submit" class="button2" value="Log in">
        </form>
    </div>
</body>

<style type="text/css">
    body {
        font-family: "tahoma;";
        background-color: #e9ebee;
    }

    .bar1 {
        height: 100px;
        text-align: left;
        color: white;
        background-color: #3c5a99;
        padding: 4px;
    }

    .bar2 {
        background-color: white;
        width: 800px;
        height: 200px;
        margin: auto;
        margin-top: 50px;
        padding: 30px;
        text-align: center;
    }


    .text1 {
        font-size: 40px;
    }

    .text2 {
        height: 40px;
        width: 300px;
        border-radius: 4px;
        border: solid 1px #aaa;
        padding: 4px;
        font-size: 14px;
    }

    .button1 {
        background-color: #42b72a;
        width: 60px;
        text-align: center;
        padding: 4px;
        border-radius: 4px;
        float: right;
    }


    .button2 {
        width: 300px;
        height: 40px;
        border-radius: 4px;
        font-weight: bold;
        border: none;
        background-color: #3c5a99;
        color: white;
    }
</style>

</html>