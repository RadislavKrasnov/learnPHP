<?php

session_start();

if (!empty($_SESSION['user_access']) && $_SESSION['user_access'] === true) {

    session_destroy();

    setcookie('email', '', time());
    setcookie('key', '', time());
    header('location: index.php');
}