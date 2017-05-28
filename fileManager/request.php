<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Request</title>
    </head>
    <body>


<?php
/**
 * Created by PhpStorm.
 * User: radik
 * Date: 25.05.17
 * Time: 17:46
 */
$delete = $_POST['delete'];
$item = $_POST['item'];//files in dir
$address = $_GET['address'];
$copy = $_POST['copy'];
$rename = $_POST['rename'];
$makeDir = $_POST['make-dir'];
$createFile = $_POST['create-file'];
$edit = $_POST['edit'];
$fileSubmit = $_POST['file-submit'];

//select the folders from list that need copy

function foldersTree ($folder) {
    global $item;
    global $address;
    global $rootDir;
    $openedDir = opendir($folder);
    while (false !== ($content = readdir($openedDir))) {
        if (($content != "..") && ($content != ".")) {
            $fullPath = $folder ."/". $content;
            if (is_dir($fullPath)) {
//                Check for folder matches
                $isMatch = 0;
                foreach ($item as $i) {
                    if ($fullPath == $address ."/". $i) {
                        $isMatch = 1;
                    }

                    if ($isMatch == 0) {
                        if ($fullPath != $address) {
                            echo ("<input type='radio' name='copy-to' value=$fullPath>$fullPath<br>");
                        }
                        foldersTree($fullPath);
                    }
                }
            }
        }
    }
    closedir($openedDir);
}

echo ("<form action=process.php?address=$address method='post'>");

//copy files

if ($copy != "") {
    $rootDir = 'accountsDir';
    echo ("Objects for copy:<br>");
    foreach ($item as $i) {
        echo ("<input type='hidden' name=item[] value=$i>$address/$i<br>");
        echo ("Select folder: <br>");
        foldersTree($rootDir);
        if ($rootDir != $address) {
            echo ("<br><input type='radio' name='copy-to' value=$rootDir>$rootDir<br>");
        }
        echo ("<input type='submit' value='Copy' name='copy'>");
        echo ("<input type='submit' value='Cancel' name='cancel'>");
    }
}

//delete files

if ($delete != "") {
    echo ("Delete files?");
    foreach ($item as $i) {
        echo ("<input type='hidden' name=item[] value=$i>$i from $address");
    }
    echo ("<input type=submit value ='Delete' name='delete'><br>");
    echo ("<input type=submit value ='Cancel' name='cancel'><br>");
}

//rename files

if ($rename != "") {
    echo ("Rename files?<br>");
    foreach ($item as $i) {
        echo ("<input type=hidden name=old-name[] value=$i>");//old name
        echo ("$i");
        echo ("<input type=text size=30 name=changed-name[] value=$i><br>");
        echo ("<input type=submit value='Rename' name='rename'>");
        echo ("<br><input type=submit value='Cancel' name='cancel'>");
    }
}

//make dir

if ($makeDir != "") {
    echo ("Input name of folder: <br><input type='text' size='30' name='newname'>");
    echo ("<input type='submit' value='Create folder' name='make-dir'>");
    echo ("<br><input type=submit value='Cancel' name='cancel'>");
}

//create file

if ($createFile != "") {
    echo ("Input name of file: <br><input type=text size=30 name='newfile'>");
    echo ("<input type=submit value='Create file' name='create-file'>");
    echo ("<br><input type=submit value='Cancel' name='cancel'>");
}

//edit

if ($edit != "") {
    foreach ($item as $i) {
        $path = $address . "/" . $i;
        if (is_file($path)) {
            if (mime_content_type($path) == "text/plain") {

                $open = fopen($path, "a+b");
                $line = file($path);
                foreach ($line as $lines) {
                    $scrin .= htmlspecialchars($lines);
                }
                fclose($open);
                echo("<input type='hidden' name=editing[] value=$i> $address/$i");
                echo("<input type='submit' value='Save' name='edit'>");
                echo("<input type=submit value='Cancel' name='cancel'><br>");
                echo("<textarea name='textarea' cols='100' rows='100'>$scrin</textarea>");
            } else {
                echo "You cannot to open the file of this type!";
            }
        } else {
            echo "This is  not file, is's directory";
        }
    }
}

//upload files

if ($fileSubmit != "") {
    if (isset($_FILES['userfile']['name'])) {
        $uploaddir = 'accountsDir/Uploads/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

        if ((mime_content_type($_FILES['userfile']['tmp_name']) != 'text/plain') &&
            (mime_content_type($_FILES['userfile']['tmp_name']) != 'image/jpeg') &&
            (mime_content_type($_FILES['userfile']['tmp_name']) != 'image/png')
        ) {

            echo "An attempt was made to upload the file of an invalid type!
            Please make sure that it complies with the permitted types" .
                mime_content_type($_FILES['userfile']['tmp_name']);
            exit;
        }

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            echo "The file is correct and has been successfully downloaded.\n" . mime_content_type($uploadfile);
        } else {
            echo "Possible attack with file download!\n";
        }
    }
}

echo "</form>";

?>
    </body>
</html>
