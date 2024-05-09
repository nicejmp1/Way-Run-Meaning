<?php
    include "../connect/connect.php";

    $youEmail = $_POST['youEmail'];
    $youName = $_POST['youName'];
    $youPass = $_POST['youPass'];
    $youPassC = $_POST['youPassC'];
    $youNickName = $_POST['youNickName'];
    $youRegTime = time();

    echo $youEmail, $youName, $youPass, $youPassC, $youNickName;

    $sql = "INSERT INTO members(youEmail, youName, youPass, youNickName, youRegTime) VALUES('$youEmail', '$youName', '$youPass', '$youNickName', '$youRegTime')";
    $connect -> query($sql);

?>