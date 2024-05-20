<?php
    include "../connect/connect.php";

    $youEmail = $_POST['youEmail'];
    $youNickName = $_POST['youNickName'];
    $youName = $_POST['youName'];
    $youPass = $_POST['youPass'];
    $youPassC = $_POST['youPassC'];
    $youQuiz = $_POST['youQuiz'];
    $youRegTime = time();

    echo $youEmail, $youNickName, $youName, $youPass, $youPassC, $youQuiz;

    $sql = "INSERT INTO members(youEmail, youNickName, youName, youPass, youQuiz, youRegTime) VALUES('$youEmail', '$youNickName', '$youName', '$youPass', '$youQuiz', '$youRegTime')";
    $connect -> query($sql);
?>