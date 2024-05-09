<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $youEmail = mysqli_real_escape_string($connect, $_POST['youEmail']);
    $youPass = mysqli_real_escape_string($connect, $_POST['youPass']);

    $sql = "SELECT memberID, youEmail, youName, youNickName, youPass FROM members WHERE youEmail = '$youEmail'";
    $result = $connect -> query($sql);

    if($result) {
        $count = $result -> num_rows;

        if($count == 0) {
            // 사용자 ID가 존재하지 않는 경우
            echo "<script>alert('아이디 또는 비밀번호가 없습니다. 회원가입을 해주세요!')</script>";
            echo "<script>history.back();</script>";
        } else {
            $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

            if(password_verify($youPass, $memberInfo['youPass'])) {
                // 로그인 성공, 세션 설정
                $_SESSION['memberID'] = $memberInfo['memberID'];
                $_SESSION['youName'] = $memberInfo['youName'];
                $_SESSION['youNickName'] = $memberInfo['youNickName'];

                echo "<script>alert('로그인 성공!!')</script>";
                echo "<script>window.location.href = '../index.php';</script>";
            } else {
                // 로그인 실패
                echo "<script>alert('아이디 또는 비밀번호가 틀렸습니다. 다시 한번 확인해주세요!')</script>";
                echo "<script>history.back();</script>";
            }
        } 
    }
?>