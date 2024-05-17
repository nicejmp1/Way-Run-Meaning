<?php
    include "../connect/connect.php";

    $youEmail = $_POST['youEmail'];
    $youNickName = $_POST['youNickName'];
    $youName = $_POST['youName'];
    $youPass = $_POST['youPass'];
    $youPassC = $_POST['youPassC'];
    $youRegTime = time();

    echo $youEmail, $youNickName, $youName, $youPass, $youPassC;

    $sql = "INSERT INTO members(youEmail, youNickName, youName, youPass, youRegTime) VALUES('$youEmail', '$youNickName', '$youName', '$youPass', '$youRegTime')";
    $connect -> query($sql);
?>