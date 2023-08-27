<?php

session_start();

if(isset($_SESSION['mybook_userid'])) {
    unset($_SESSION['mybook_userid']);
    $_SESSION['mybook_userid'] = null;
}


header("Location: login.php");
die;

?>