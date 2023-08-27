<div class="friends">
    <?php
    $image = "images/male.png";
    if ($friend_row['gender'] == 'Female') {
        $image = "images/female.png";
    }
    ?>
    <img class="friends_img" src="<?php echo $image; ?>" alt="user1">
    <br>
    <?php
    echo $friend_row['last_name'] . ' ' . $friend_row['first_name'];
    ?>
</div>

<style>
    .friends {
        clear: both;
        font-size: 12px;
        font-weight: bold;
        color: #405d9b;
    }


    .friends_img {
        width: 75px;
        float: left;
        margin: 8px;
    }

    
</style>