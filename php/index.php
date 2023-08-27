<?php

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");


$id = $_SESSION['mybook_userid'];
$login = new Login();
$user_data = $login->check_login($id);

$post = new Post();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $errors = $post->create_post($id, $_POST);
    if ($errors == "") {
        header("Location: index.php");
        die;
    } else {
        include "components/errors.php";
    }
}


// collect posts
$posts = $post->get_posts($id);

?>


<html>

<head>
    <title>Timeline | Mybook</title>
    <link rel="stylesheet" href="css/layout.css">
</head>

<body>
    <br>
    <!-- top bar -->
    <?php include("components/header.php"); ?>

    <div class="index_main">

        <?php include "components/menubar.php" ?>

        <!-- blew cover area -->
        <div style="display: flex;">

            <!-- self area -->
            <div style="min-height: 400px; flex: 2;">
                <div class="index_self">
                    <img src="<?php echo $user_data['profile_image']; ?>" alt="selfie" class="profile_pic"> <br>
                    <a href="profile.php" style="text-decoration: none;">
                        <?php echo $user_data['first_name'] . " " . $user_data['last_name']; ?>
                    </a>
                </div>
            </div>

            <!-- posts area -->
            <div style="min-height: 400px; flex: 5; padding: 20px; padding-right: 0px;">

                <!-- 留言 -->
                <?php include "components/message_board.php" ?>

                <!-- posts -->
                <div class="post_bar">
                    <?php
                    if ($posts) {
                        foreach ($posts as $postinfo) {
                            $user = new User();
                            $userinfo = $user->get_user($postinfo['userid']);
                            include("components/post.php");
                        }
                    }
                    ?>
                </div>

            </div>
        </div>

    </div>

</body>

<style>
 

    .index_main {
        width: 800px;
        margin: auto;
        min-height: 400px;
    }

    .index_self {
        min-height: 840px;
        margin-top: 20px;
        padding: 8px;
        text-align: center;
        font-size: 20px;
        color: #405d9b;
    }

   
</style>

</html>