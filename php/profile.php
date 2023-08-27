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
    $result = $post->create_post($id, $_POST);
    if ($result == "") {
        header("Location: profile.php");
        die;
    } else {
        echo "<div style='text-align:center; font-size:120x; color:white; background-color:grey;'></div>";
        echo "<br>The following errors occured:<br><br>";
        echo $result;
        echo "</div>";
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
</head>

<body>
    <br>
    <!-- top bar:header.php -->
    <?php
        include("header.php");
    ?>

    <!-- cover area -->
    <div style="width: 800px; margin: auto; min-height: 400px;">

        <div style="background-color: white; text-align: center; color: #405d9b; ">
            <img src="<?php echo $user_data['cover_image']; ?>" alt="mountain" style="width: 100%;">
            <span style="font-size: 12px;">
                <img src="<?php echo $user_data['profile_image']; ?>" alt="selfie" class="profile_pic"> <br>

                <a style="text-decoration: none; color:#f0f;" href="change_profile_image.php?change=profile_image">Change Image</a>
                <!-- <span>|</span>
                <a style="text-decoration: none; color:#f0f;" href="change_profile_image.php?change=cover_image">Change Cover</a> -->
            </span>
            <br>
            <div style="font-size: 20px; margin-top: -40px; color: white;"><?php echo $user_data['first_name'] . $user_data['last_name'] ?></div>
            <br>
            <a href="index.php">
                <div class="menu_button">Timeline</div>
            </a>
            <div class="menu_button">About </div>
            <div class="menu_button">Friends </div>
            <div class="menu_button">Photos </div>
            <div class="menu_button">Settings</div>
        </div>

        <!-- blew cover area -->
        <div style="display: flex;">
            <!-- friend area -->
            <div style="min-height: 400px; flex: 2;">

                <div class="friends_bar">
                    Friends <br>
                    <?php
                        if ($friends) 
                        {
                            foreach($friends as $friend_row) {
                                include("user.php");
                            }
                        }
                    ?>
                </div>
            </div>

            <!-- posts area -->
            <div style="min-height: 400px; flex: 5; padding: 20px; padding-right: 0px;">

                <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
                    <form action="" method="post">
                        <textarea name="post" placeholder="What's no your mind?"></textarea>
                        <input class="post_button" type="submit" value="Post">
                        <br>
                        <br>
                    </form>

                </div>

                <!-- posts -->
                <div class="post_bar">
                    <?php
                    if ($posts) {
                        foreach ($posts as $postinfo) {
                            $user = new User();
                            $userinfo = $user->get_user($postinfo['userid']);
                            include("post.php");
                        }
                    }
                    ?>
                </div>


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

    .profile_pic {
        width: 150px;
        height: 150px;
        margin-top: -200px;
        border-radius: 50%;
        border: solid 2px white;
    }

    .menu_button {
        width: 100px;
        display: inline-block;
        margin: 2px;
    }

    .friends_img {
        width: 75px;
        float: left;
        margin: 8px;
    }

    .friends_bar {
        background-color: white;
        min-height: 840px;
        margin-top: 20px;
        color: #aaa;
        padding: 8px;
    }

    .friends {
        clear: both;
        font-size: 12px;
        font-weight: bold;
        color: #405d9b;
    }

    textarea {
        width: 100%;
        border: none;
        font-family: Tahoma;
        font-size: 14px;
        height: 100px;
    }

    .post_button {
        float: right;
        background-color: #405d9b;
        border: none;
        color: white;
        padding: 4px;
        font-size: 14px;
        border-radius: 2px;
        width: 50px;
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