<div class="friends">
    <?php
        
        $image = "images/male.png";
        if($friend_row['gender'] == 'Female') {
            $image = "images/female.png";
        }
    ?>
    <img class="friends_img" src="<?php echo $image; ?>" alt="user1">
    <br>
    <?php
    echo $friend_row['first_name'] . ' ' . $friend_row['last_name'];
    ?>
</div>