<?php


session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/image.php");


$id = $_SESSION['mybook_userid'];

$login = new Login();
$user_data = $login->check_login($id);

$errors = "";

// for change image
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_FILES['file']['name']))) {
        $errors .= "请选择图片";
        include("errors.php");
    } else {
        print_r($_FILES);
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
                if(file_exists($upload_path)) {
                    print_r($change);
                    $userid = trim($user_data['userid']);
                    $query = "update users set $change = '$upload_path' where userid = $userid limit 1;";
                    $DB = new Database();
                    $DB->save($query);
                    header("Location:profile.php");
                    die;
                }
            } else {
                $errors .= "上传图片失败";
                include("errors.php");
            }
        } else {
            $errors .= "请选择jpg格式图片";
            include("errors.php");
        }
    }
}

?>



<html>

<head>
    <title>Change Profile Image | Mybook</title>
</head>

<body>
    <br>
    <!-- top bar -->
    <?php
    include("header.php");
    ?>

    <!-- cover area -->
    <div style="width: 800px; margin: auto; min-height: 400px;">

        <!-- blew cover area -->
        <div style="display: flex;">

            <!-- posts area -->
            <div style="min-height: 400px; flex: 5; padding: 20px; padding-right: 0px;">

                <form method="post" enctype="multipart/form-data">
                    <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
                        <input type="file" name="file"> <br />
                        <input class="post_button" type="submit" value="Change">
                        <br>
                    </div>
                </form>

            </div>
        </div>

    </div>


</body>


<style>
    body {
        font-family: "tahoma";
        background-color: #a0d8e4;
    }

    .blue_bar {
        height: 50px;
        background-color: #405d9b;
        color: #d9dfeb;
    }

    .search_box {
        width: 400px;
        height: 20px;
        border-radius: 5px;
        border: none;
        padding: 4px;
        font-size: 14px;
        background-image: url(images/search.svg);
        background-repeat: no-repeat;
        background-position: right;
    }





    .post_button {
        float: right;
        background-color: #405d9b;
        border: none;
        color: white;
        padding: 4px;
        font-size: 14px;
        border-radius: 2px;
        width: 100px;
    }

    .post_bar {
        margin-top: 20px;
        background-color: white;
        padding: 10px;
    }

    .post {
        padding: 4px;
        font-size: 13px;
        display: flex;
        margin-bottom: 20px;
    }
</style>

</html>