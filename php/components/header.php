<!-- header -->

<div class="blue_bar">
    <div class="header_template">

        <a href="index.php" style="color: white; text-decoration:none;">我的博客</a>

        &nbsp;&nbsp; <input type="text" class="search_box" placeholder="收索用户">

        <a href="profile.php">
            <img class="header_image_a" src="<?php echo $user_data['profile_image']; ?>" alt="<?php echo $user_data['profile_image']; ?>">
        </a>

        <a href="logout.php">
            <span class="logout_btn">退出</span>
        </a>
    </div>
</div>



<style>
    .blue_bar {
        height: 50px;
        background-color: #405d9b;
        color: #d9dfeb;
    }

    .header_template {
        width: 800px;
        margin: auto;
        font-size: 30px;
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

    .header_image_a {
        width: 50px;
        height: 50px;
        float: right;
    }

    .logout_btn {
        font-size: 12px;
        float: right;
        margin-top: 19px;
        margin-right: 2px;
        ;
        color: white;
    }
</style>