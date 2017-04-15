<?php
$name = 'Radik';
$surname = 'Krasnov';
$age = 22;

//task#1

echo "My name is $name <br> 
My surname is $surname <br>";

//task#2

if ($age < 6) {
    echo "You are $age years. You need go to kindergarten<br>";
} elseif (6 <= $age && $age < 17) {
    echo "You are $age years.You need go to school<br>";
} elseif (17 <= $age && $age < 22) {
    echo "You are $age years.You need go to university<br>";
} elseif (22 <= $age && $age < 65) {
    echo "You are $age years.You need go to work<br>";
} elseif (65 <= $age && $age < 90) {
    echo "You are $age years. You are pensioner<br>";
} else {
    echo "You are $age years.Maybe, you soon to die <br>";
}

//task#3

switch ($age) {
    case $age < 6:
        echo "You are $age years. You need go to kindergarten";
        break;
    case 6 <= $age && $age < 17:
        echo "You are $age years.You need go to school(swithc/case)<br>";
        break;
    case 17 <= $age && $age < 22:
        echo "You are $age years.You need go to work(swithc/case)<br>";
        break;
    case 22 <= $age && $age < 65:
        echo "You are $age years.You need go to work(swithc/case)<br>";
        break;
    case 65 <= $age && $age < 90:
        echo "You are $age years. You are pensioner(swithc/case)<br>";
        break;
    default:
        echo "You are $age years.Maybe, you soon to die(swithc/case)<br>";
        break;
}

//task#4

for ($i=0; $i <= 100; $i++) {
    if (!($i % 2)) {
        continue;
    }
    echo $i . "<br>";
}
//task#5

$siteParts = [
    "header" => "header.php ",
    "main"   => "main.php",
    "footer" => "footer.php",
];

foreach ($siteParts as $key => $value) {
    echo " {$key} => {$value} <br>";
}










