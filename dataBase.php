<?php

include_once 'functions.php';

$message = '';
//connection with DB
$link = mysqli_connect('localhost', 'Radik', '1111', 'testDB');

//SIGN UP
if ($_POST['create-account'] != "") {
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) &&
        !empty($_POST['password']) && !empty($_POST['confirm_password']) &&
        !empty($_POST['month']) && !empty($_POST['day']) &&
        !empty($_POST['year']) && !empty($_POST['gender']) && !empty($_POST['region']) &&
        isset($_POST['place']) && isset($_POST['country'])) {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPass = $_POST['confirm_password'];
        $month = $_POST['month'];
        $day = (int) $_POST['day'];
        $year = (int) $_POST['year'];
        $gender = $_POST['gender'];
        $place = $_POST['place'];
        $region = $_POST['region'];
        $country = $_POST['country'];
        $remember = $_POST['remember-checkbox'];



        if ($password !== $confirmPass) {
            $message = 'Password is not confirmed';
        } else {

$query = <<<SQL
SELECT `email`
FROM `credentials`
WHERE `email` = $email;
SQL;

            $result = mysqli_query($link, $query);
            $emailExist = mysqli_fetch_assoc($result);

            if (empty($emailExist)) {
                $salt = generateSalt();
                $saltedPassword = sha1($password.$salt);

$query = <<<SQL
INSERT INTO `users` SET 
  `id`         = NULL
, `first_name` = '$firstname'
, `last_name`  = '$lastname'
 , `place`     = '$place'
, `region`     = '$region'
, `country`    = '$country'
, `month`      = '$month'
, `day`        = $day
, `year`       = $year
, `gender`     = '$gender';
SQL;

$querySec = <<<SQL
INSERT INTO `credentials` SET
  `id` = NULL
, `users_id` = LAST_INSERT_ID()
, `email` = '$email'
, `password` = '$saltedPassword'
, `salt` = '$salt';
SQL;

"<pre>";
print $query;
"</pre>";

                mysqli_query($link, $query);
                mysqli_query($link, $querySec);
                session_start();
                $_SESSION['user_access'] = true;
                $message = 'You have successfully registered!';
                header('Refresh: 1; URL = home.php' );

            } else {
                $message = 'This email is exists already';
            }
        }
    } else {
        $message = 'You have some field empty';
    }
}

//SIGN IN

//check cookie

if (empty($SESSION['user_access']) || $SESSION['user_access'] === false) {
    if (!empty($COOKIE['email']) && !empty($COOKIE['key'])) {
        $email = $COOKIE['email'];
        $key = $COOKIE['key'];//like a password

$isExistCookie = <<<SQL
SELECT `email`, `cookie`, `status`, `id`
FROM `credentials` 
WHERE `email` = $email AND `cookie` = $key;
SQL;
        $cookieResult = mysqli_fetch_assoc(mysqli_query($link, $isExistCookie));

        if (!empty($isExistCookie)) {
            session_start();
            $_SESSION['user_access'] = true;
            $_SESSION['email'] = $credential['email'];
            $_SESSION['status'] = $credential['status'];
            $_SESSION['id'] = $credential['id'];
//rewrite cookie
            $key = generateSalt();
            setcookie('email', $email, time() + 60 * 60 * 24 * 30);
            setcookie('key', $key, time() + 60 * 60 * 24 * 30);

            $queryCookie = <<<SQL
UPDATE `credentials` SET `cookie` = $key 
WHERE `email` = $email;
SQL;
            mysqli_query($link, $queryCookie);
        }

    }
}
//If cookie not exists we enter email and password
if ($_POST['signin'] != "") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];


//        $query = <<<SQL
//SELECT *
//FROM `profiles`
//WHERE `email` = "$email"   AND `password` = SHA1($password);
//SQL;
//$query = <<<SQL
//SELECT `email`, `salt`, `password`
//FROM `credentials`
//WHERE `email` = '$email';
//SQL;
$query = <<<SQL
SELECT credentials.`id`, credentials.`status`
     , credentials.`email`, credentials.`salt`
     , credentials.`password`, users.`first_name`, users.`last_name`
FROM `credentials`
JOIN common ON credentials.id = common.credentials_id
JOIN users ON common.users_id = users.id
WHERE `email` = '$email';
SQL;


        $result = mysqli_query($link, $query);

        $credential = mysqli_fetch_assoc($result);

        if (!empty($credential)) {
            $salt = $credential['salt'];
            $saltedPassword = sha1($password.$salt);
            if ($credential['password'] === $saltedPassword) {
                session_start();
                $_SESSION['user_access'] = true;
                $_SESSION['first_name'] = $credential['first_name'];
                $_SESSION['last_name'] = $credential['last_name'];
//              $_SESSION['place'] = $credential['place'];
//              $_SESSION['country'] = $credential['country'];
//              $_SESSION['month_birth'] = $credential['month_birth'];
//              $_SESSION['day_birth'] = $credential['day_birth'];
//              $_SESSION['year_birth'] = $credential['year_birth'];
                $_SESSION['email'] = $credential['email'];
//              $_SESSION['gender'] = $credential['gender'];
                $_SESSION['status'] = $credential['status'];
                $_SESSION['id'] = $credential['id'];

                if (!empty($remember) && $remember === 'remember-me') {
                    $key = generateSalt();
                    setcookie('email', $credential['email'], time() + 60 * 60 * 24 * 30);
                    setcookie('key', $key, time() + 60 * 60 * 24 * 30);

$queryCookie = <<<SQL
UPDATE `credentials` SET `cookie` = $key 
WHERE `email` = $email;
SQL;
                    mysqli_query($link, $queryCookie);
                }

                $message = "Welcome " . $_SESSION['first_name'] . " " . $_SESSION['last_name'] . "!";
                header('Refresh: 2; URL = home.php');

                mysqli_free_result($result);
            } else {
                $message = 'Wrong username or password';
            }

        } else {

            $message = 'Wrong username or password';

        }
    }
}
//close connection with DB
mysqli_close($link);
