<?php
// cookie 有时间限制，所以数据存放到cookie时要考虑时间因素
    setcookie("fav_food", "pizza", time() + (86400*2), "/");
    setcookie("fav_dirnk", "coffee", time() + (86400*3), "/");
    setcookie("fav_dessert", "ice cream", time() + (85400*4), "/");

    foreach($_COOKIE as $key => $value) {
        echo "{$key} = {$value} <br>";
    }
?>