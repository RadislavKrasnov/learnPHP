<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>World of Racing</title>
        <style>
        </style>
    </head>
    <body>

<?php
include_once 'simple_html_dom.php';
include_once 'url_to_absolute/url_to_absolute.php';
function get_data($url) {
    $timeout = 5;
    $domain = 'https://www.windingroad.com';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
    $rawdata = curl_exec($ch);
    curl_close($ch);

    $html = new simple_html_dom();
    $body = $html->load($rawdata);

    if (count($body)) {
        $ul = $body->find('ul[id=articles]');
        $img = $body->find('img[class=article-image]');
        $lia = $body->find('li a');
        $a = $body->find('h2 a[property=dc:title]');
        $span = $body->find('h2 span');

//        for ($j = 0; $j <= 19; $j++) {
//            echo $a[$j]->href = $domain.$a[$j]->href . "<br>";
//        }
        for ($i = 0; $i <= 9; $i++) {
             $img[$i]->src = $domain.$img[$i]->src;
             $lia[$i]->href = $domain.$lia[$i]->href;
             $a[$i]->href = $domain.$a[$i]->href;
             $span[$i]->outertext = '';
        }
        echo $ul[0];

    }

}
$getData = get_data('https://www.windingroad.com/articles/');
?>

    </body>
</html>