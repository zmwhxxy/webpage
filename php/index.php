<?php

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");


$id = $_SESSION['mybook_userid'];

$login = new Login();
$user_data = $login->check_login($id);


?>



<html>

<head>
    <title>Timeline | Mybook</title>
</head>

<body>
    <br>
    <!-- top bar -->
    <?php
    include("header.php");
    ?>

    <!-- cover area -->
    <div style="width: 800px; margin: auto; min-height: 400px;">

        <div style="background-color: white; text-align: center; color: #405d9b; ">
            <br>
            <div style="font-size: 20px; margin-top: -40px; color: white;"></div>
            <br>
            <div class="menu_button">Timeline</div>
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
                    <img src="images/selfie.jpg" alt="selfie" class="profile_pic">
                    <br>
                    <a href="profile.php" style="text-decoration: none;">
                        <?php
                        echo $user_data['first_name'] . " " . $user_data['last_name'];
                        ?>
                    </a>
                </div>


            </div>

            <!-- posts area -->
            <div style="min-height: 400px; flex: 5; padding: 20px; padding-right: 0px;">

                <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
                    <textarea placeholder="What's no your mind?"></textarea>
                    <input class="post_button" type="submit" value="Post">
                    <br>
                    <br>
                </div>

                <!-- posts -->
                <div class="post_bar">


                    <div class="post">
                        <div>
                            <img src="images/user5.jpg" alt="user1" style="width: 75px; margin-right: 4px; ">
                        </div>

                        <div>
                            <div class="friends">Mary</div>
                            My coat and my umbrella please.
                            Here is my ticket.
                            Thank you, sir.
                            <br><br>

                            <a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;">8/23 2023<span>
                        </div>
                    </div>


                </div>

            </div>
        </div>

    </div>


</body>




</html>