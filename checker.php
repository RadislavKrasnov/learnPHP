<?php

session_start();

if (empty($_SESSION['user_access']) && $_SESSION['user_access'] !== true) {
        echo "<h1>You have not permission for this page! Please <a href='signin.php'>Sign in</a></h1>";
        header('Refresh: 3; URL = index.php');
        die;
}



