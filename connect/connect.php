<?php
    $host = "localhost";
    $user = "nicejmp";
    $pw = "qkrwjdals12!";
    $db = "nicejmp";

    $connect = new mysqli($host, $user, $pw, $db);
    $connect -> set_charset("utf8");
    
    if($connect -> connect_error) {
        echo "Connect Failed" . $connect->connect_error;
    }
?>