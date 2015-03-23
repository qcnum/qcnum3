<?php
require_once('../../../../../wp-config.php');

if(get_option('twitterJson')){
    $allResponse = get_option('twitterJson');
}

header('Content-type: application/json');
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date dans le passé
echo $allResponse;