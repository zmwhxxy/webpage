    <!-- top bar -->
    <style><?php include 'css/header.css'; ?></style>
    
    <div class="blue_bar">
        <div style="width: 800px; margin: auto; font-size: 30px;">

            <a href="index.php" style="color: white;">Mybook</a>

            &nbsp;&nbsp; <input type="text" class="search_box" placeholder="Search for people">

            <a href="profile.php">
                <img src="<?php echo $user_data['profile_image']; ?>" alt="selfie.jpg" style="width: 50px; height:50px; float: right;">
            </a>

            <a href="logout.php">
                <span style="font-size: 11px; float:right; margin: 10px; color:white;">Logout</span>
            </a>
        </div>
    </div>