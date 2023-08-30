<?php

include("classes/connect.php");
include("classes/signup.php");

$first_name = "";
$last_name = "";
$email = "";
$password = "";
$password2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $signup = new Signup();
    $errors = $signup->evaluate($_POST);
    if ($errors == "") {
        header("Location:login.php");
        die;
    } else {
       include("errors.php");
    }

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
}


?>



<html>

<head>
    <title>Mybook | Signup</title>
</head>

<body>
    <div class="bar1">
        <div class="text1">Mybook</div>
        <a href="login.php">
            <div class="button1">Login</div>
        </a>
    </div>

    <div class="bar2">
        Sign up to Mybook <br><br>

        <form action="" method="post">
            <input value="<?php echo $first_name ?>" name="first_name" class="text2" placeholder="First name"> <br><br>
            <input value="<?php echo $last_name ?>" name="last_name" class="text2" placeholder="Last name"> <br><br>

            <span style="font-weight: normal;">Gender:</span> <br>
            <select name="gender" class="text2">
                <option>Male</option>
                <option>Female</option>
            </select> <br><br>

            <input value="<?php echo $email ?>" name="email" type="email" class="text2" placeholder="Email"> <br><br>
            <input value="<?php echo $password ?>" name="password" type="password" class="text2" placeholder="Password"> <br><br>
            <input value="<?php echo $password2 ?>" name="password2" type="password" class="text2" placeholder="Retype password"> <br><br>
            <input type="submit" class="button2" value="Sign up">
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
        height: 500px;
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