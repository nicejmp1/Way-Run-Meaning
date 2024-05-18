<?php
    include "../connect/connect.php"; 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        $youEmail = $connect -> real_escape_string($_POST['youEmail']);
        $youName = $connect -> real_escape_string($_POST['youName']);
        
        $stmt = $connect -> prepare("SELECT * FROM members WHERE youEmail = ? AND youName = ?");
        $stmt -> bind_param("ss", $youEmail, $youName); 
        $stmt -> execute();
        $result = $stmt -> get_result();

        if ($result -> num_rows > 0) {
            echo "<script>alert('해당 계정이 존재합니다. 로그인을 진행해주세요!'); location.href='../login/login.php';</script>";
        } else {
            echo "<script>alert('해당 계정이 존재하지 않습니다. 회원가입을 진행해 주세요!'); location.href='../signup/signupInsert.php';</script>";
        }
        
        $stmt -> close();
    } else {
        echo "<script>alert('잘못된 접근입니다. 관리자에게 문의하세요!'); history.back();</script>";
    }

    $connect -> close();
?>
