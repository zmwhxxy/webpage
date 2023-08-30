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
        header("Location: profile.php");
        die;
    } else {
        include "components/errors.php";
    }
}

// collect posts
$posts = $post->get_posts($id);

// collect friends
$user = new User();
$friends = $user->get_friends($id)

?>



<html>

<head>
    <title>Profile | Mybook</title>
    <link rel="stylesheet" href="css/layout.css">
</head>

<body>
    <br>
    <!-- top bar:header.php -->
    <?php
    include("components/header.php");
    ?>

    <!-- cover area -->
    <div style="width: 800px; margin: auto; min-height: 400px;">

        <div style="background-color: white; text-align: center; color: #405d9b; ">
            <img src="<?php echo $user_data['cover_image']; ?>" alt="mountain" style="width: 100%;">
            <img src="<?php echo $user_data['profile_image']; ?>" alt="selfie" class="profile_pic profile_ext"> <br>
            <span style="font-size: 12px;">
                <a style="text-decoration: none; color:#f0f;" href="change.php?change=profile_image">更换形象</a>
                <span>|</span>
                <a style="text-decoration: none; color:#f0f;" href="change.php?change=cover_image">更换封面</a>
            </span>
            <div style="font-size: 20px; margin-top: -40px; color: white;"><?php echo $user_data['last_name'] . " " . $user_data['first_name'] ?></div>
            <br>
            <?php include "components/menubar.php"; ?>
        </div>

        <!-- blew cover area -->
        <div style="display: flex;">
            <!-- friend area -->
            <div style="min-height: 400px; flex: 2;">

                <div class="friends_bar">
                    Friends <br>
                    <?php
                    if ($friends) {
                        foreach ($friends as $friend_row) {
                            include("user.php");
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- posts area -->
            <div style="min-height: 400px; flex: 5; padding: 20px; padding-right: 0px;">

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
    .profile_ext {
        margin-top: -200px;
    }

    .friends_bar {
        background-color: white;
        min-height: 840px;
        margin-top: 20px;
        color: #aaa;
        padding: 8px;
    }
</style>


</html>