<?php
/**
 * Created by PhpStorm.
 * User: radik
 * Date: 25.05.17
 * Time: 17:47
 */

$delete = $_POST['delete'];
$item = $_POST['item'];
$address = $_GET['address'];
$copy = $_POST['copy'];
$rename = $_POST['rename'];
$makeDir = $_POST['make-dir'];
$createFile = $_POST['create-file'];
$edit = $_POST['edit'];
$fileSubmit = $_POST['file-submit'];
$oldName = $_POST['old-name'];
$changedName = $_POST['changed-name'];
$newName = $_POST['newname'];
$newFile = $_POST['newfile'];
$editing = $_POST['editing'];
$copyTo = $_POST['copy-to'];
$textarea = $_POST['textarea'];
$editing = $_POST['editing'];
$rootDir = 'accountsDir';

if  ((strpos($address, $rootDir) !== 0) ||
    (strpos($address, "..") !== false)) {
    exit;
}

//delete files in directory and delete dir

function deleteFiles ($address) {
    $openedDir = opendir($address);
    while (false !== ($content = readdir($openedDir))) {
        if ($content != "." && $content != "..") {
            if (is_dir($address ."/". $content) == true) {
                deleteFiles($address ."/". $content);
                rmdir($address ."/". $content);
            } else {
                unlink($address ."/". $content);
            }
        }
    }
    closedir($openedDir);
}

//copy directory with files inside

function copyFolder ($address, $i, $copyTo) {
    if (file_exists($copyTo."/".$i) !== true) {
        mkdir($copyTo."/".$i);
    }

    $openedDir = opendir($address . "/" . $i);
    while (false !== ($file = readdir($openedDir))) {
        if ($file != "." || $file != "..") {
            if (is_dir($address . "/" . $i . "/" . $file)) {
                copyFolder($address . "/" . $i, $file, $copyTo . "/" . $i);
            } else {
                copy($address . "/" . $i . "/" . $file, $copyTo . "/" . $i . "/" . $file);
            }
        }
    }
    closedir($openedDir);
}

// delete

if ($delete != "") {
    foreach ($item as $i) {
        if (is_dir($address ."/". $i) == true) {
            deleteFiles($address ."/". $i);
            rmdir($address ."/". $i);
        } else {
            unlink($address ."/". $i);
        }
    }
}

//rename

if ($rename != "") {
    for ($i = 0; $i < count($oldName); $i++) {
        $changedName[$i] = strtr( $changedName[$i], '[]{},/\!@#$%л&*', '_');
        while (file_exists($address . "/" . $changedName[$i])) {
            $changedName[$i] = "_" . $changedName[$i];
            rename($address . "/" . $oldName[$i], $address . "/" . $changedName[$i]);
        }

        rename($address . "/" . $oldName[$i], $address . "/" . $changedName[$i]);
    }
}

//copy

if ($copy != "") {
    foreach ($item as $i) {
        if (is_dir($address ."/". $i) == true) {
            if (srtpos($copyTo, $address ."/". $i) === false) {
                copyFolder($address, $i, $copyTo);
            }
        } else {
            copy ($address ."/". $i, $copyTo ."/". $i);
        }
    }
}

//mkdir

if ($makeDir != "") {
    $newName = strtr($newName, '[]{},/\!@#$%л&*', '_');
    mkdir($address ."/". $newName, 0777);
}

// create file

if ($createFile != "") {
    $newFile = strtr($newFile, '[]{},/\!@#$%л&*', '_');
    $newFile .= ".txt";
    $path = $address ."/". $newFile;
    if (file_exists($path) !== true) {
        fopen($path, "a+b");
    } else {
        echo "file is exist already!";
    }
}

//edit file

if ($edit != "") {
    foreach ($editing as $i) {
        $openPath = "$address/$i";
        if (mime_content_type($openPath) == "text/plain") {
            $openedFile = fopen($openPath, "a+b");
            fwrite($openedFile, $textarea);
            fclose($openedFile);
        }
    }
}

header ("Location: index.php?address=$address");










