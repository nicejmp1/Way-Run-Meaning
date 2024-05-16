<?php
    $host = "localhost";
    $user = "nicejmp";
    $pw = "qkrwjdals12!";
    $db = "nicejmp";

    $connect = new mysqli($host, $user, $pw, $db);
    $connect -> set_charset("utf8");
    
    echo "<script>alert('커넥트연결성공')</script>;";
    echo "<script>window.location.href='../admin.php'</script>";

    if($connect -> connect_error) {
        echo "Connect Failed" . $connect->connect_error;
    }
?>