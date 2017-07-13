<?php
/**
 * Created by PhpStorm.
 * User: radik
 * Date: 18.06.17
 * Time: 21:20
 */

$name = $_POST['name'];
$email = $_POST['email'];
$feedback = $_POST['feedback'];

$toaddress = 'feedback@example.com';
$subject = 'Response from website';
$mailcontent = "Client name: $name"."\n".
               "Email: $email"."\n".
               "Comments:\n" . "$feedback"."\n";
