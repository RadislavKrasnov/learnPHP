<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>File Manager</title>
    </head>
    <body>
        <form action="index.php" method="GET">
            <input type="text" name="address">
            <input type="submit" value="Show">
        </form>
<?php
/**
 * Created by PhpStorm.
 * User: radik
 * Date: 25.05.17
 * Time: 17:46
 */

$address = $_GET['address']; // getting address of folder
$rootDir = 'accountsDir'; //root directory

//Directory check

if (is_dir($address)) {
    if (strpos(getcwd(), $address) === false &&
        strpos($address, "..") === false &&
        $address != ""
    ) {
        $dir = $address;
    } else {
        $dir = $rootDir;
    }
} else {
    $dir = $rootDir;
}

//form
echo ("<form action=request.php?address=$dir enctype='multipart/form-data' method='post'>");

echo $buttons = <<<buttons
    <br>
    <input type='submit' value='Delete' name='delete'>
    <input type='submit' value='Rename' name='rename'>
    <input type='submit' value='Copy' name='copy'>
    <input type='submit' value='Create folder' name='make-dir'>
    <input type='submit' value='Create file' name='create-file'>
    <input type='submit' value='Edit file' name='edit'>
    <input type='hidden' name='MAX_FILE_SIZE' value='10000'>
    <input type='file' name='userfile'>
    <input type='submit' name='file-submit' value='Upload file'> Upload file<br>
buttons;

//back button
if ($dir != $rootDir) {
    $back = substr($dir, 0, strpos($dir,"/"));
    echo ("<br><a href=index.php?address=$back>BACK</a><br>");
}

//reading directory
$openedDir = opendir($dir);
while (false !== ($content = readdir($openedDir))) {
    if ($content != "." && $content != "..") {
        $arrayFiles[] = $content;
    }
}

closedir($openedDir);

//show and sort all files in directory
if (count($arrayFiles) > 0) {
    asort($arrayFiles);
    foreach ($arrayFiles as $file) {
        $fullPath = $dir . "/" . $file;
        echo ("<br><input type='checkbox' name=item[] value=$file>");
        if (is_dir($fullPath) == true) {
            echo ("<a href=index.php?address=$fullPath><b>$file</b></a>");
        } else {
            echo ("<a href=$fullPath>$file</a>");
        }
        echo ("<br>");
    }
}

echo "</form>";
?>
    </body>
</html>



