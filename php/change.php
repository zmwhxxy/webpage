<?php

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/image.php");


$errors = "";

$id = $_SESSION['mybook_userid'];
$login = new Login();
$user_data = $login->check_login($id);

// for change image
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_FILES['file']['name']))) {
        $errors .= "请选择图片";
        // include("components/errors.php");
    } else {
        // 如果图片存在就移动到服务器uploads目录下
        $upload_path = 'uploads/' . trim($_FILES['file']['name']);
        $tmp_name = $_FILES['file']['tmp_name'];

        if ($_FILES['file']['type'] == 'image/jpeg') {
            if (move_uploaded_file($tmp_name, $upload_path)) {
                // 获取url参数
                $change = trim($_GET['change']);
                $x = $change == 'cover_image' ? 1366 : 800;
                $y = $change == 'cover_image' ? 488 : 800;
                // 通过参数创建符合规则的图片
                (new Image())->crop_image($upload_path, $x, $y);
                if (file_exists($upload_path)) {
                    $query = "update users set $change = '$upload_path' where userid = $id limit 1;";
                    $DB = new Database();
                    $DB->save($query);
                    
                    echo "<script langeuage='javascript' type='text/javascript'>";
                    echo "window.location.href = 'profile.php'";
                    echo "</script>";
                }
            } else {
                $errors .= "上传图片失败";
                // include("components/errors.php");
            }
        } else {
            $errors .= "请选择jpg格式图片";
            // include("components/errors.php");
        }
    }
}

?>



<html>
<head>
    <title>Change Profile Image | Mybook</title>
    <link rel="stylesheet" href="css/layout.css">
</head>

<body>
    <br>
    <!-- top bar -->
    <?php
    include("components/header.php");
    ?>
    <div style="width: 800px; margin: auto; min-height: 400px;">
       <!-- file area -->
        <div style="display: flex;">
           <?php include "components/fileselect.php" ?>
        </div>
    </div>
</body>

</html>