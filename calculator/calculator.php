<?php
/**
 * Created by PhpStorm.
 * User: radik
 * Date: 15.04.17
 * Time: 16:53
 */

$symbol = $_POST['mathSymbol'];
$pattern = '/[0-9]/';

if (preg_match($pattern, $_POST['num-1']) &&
    preg_match($pattern, $_POST['num-2'])) {

    if (isset($_POST['num-1'], $_POST['num-2']) &&
        !empty($_POST['num-1']) && !empty($_POST['num-2'])
    ) {
        $numFirst = (int)$_POST['num-1'];
        $numSecond = (int)$_POST['num-2'];

        switch ($symbol) {
            case '+':
                $result = $numFirst + $numSecond;
                break;
            case '-':
                $result = $numFirst - $numSecond;
                break;
            case '*':
                $result = $numFirst * $numSecond;
                break;
            case '/':
                $result = $numFirst / $numSecond;
                break;
            case '**':
                $result = pow($numFirst, $numSecond);
                break;
            case '%':
                $result = $numFirst * ($numSecond / 100);
                break;
        }

    } elseif (empty($_POST['num-2']) && $symbol == "/") {
        $result = (string)'E';
    } elseif (empty($_POST['num-1']) || empty($_POST['num-2'])) {
        $result = (string)'Null';
    }
} else {
    $result = (string)'Null';
}





