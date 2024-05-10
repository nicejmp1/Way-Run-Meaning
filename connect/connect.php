<?php 
    $host = "localhost";
    $user = "webweaver420";
    $pw = "al235753!!!";
    $db = "webweaver420";

    $connect = new mysqli($host, $user, $pw, $db);
    $connect -> set_charset("utf8");

   if($connect->connect_error) {
        echo "Connect Failed" . $connect->connect_error;
   }
?>

