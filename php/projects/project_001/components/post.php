<!-- posts -->
<div class="post">
    <div>
        <?php
        $image = "images/male.png";
        if ($userinfo['gender'] == 'Female') {
            $image = "images/female.png";
        }
        ?>
        <img src="<?php echo $image ?>" alt="user1" style="width: 75px; margin-right: 4px; ">
    </div>

    <div>
        <div class="friends"><?php echo $userinfo['last_name'] . " " . $userinfo['first_name'] ?></div>
        <?php echo $postinfo['post'] ?>
        <br><br>
        <a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;"> <?php echo $postinfo['date'] ?> <span>
    </div>
</div>

<style>
     .post {
        padding: 4px;
        font-size: 13px;
        display: flex;
        margin-bottom: 20px;
    }
</style>