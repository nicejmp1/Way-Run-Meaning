<?php
    include "../connect/connect.php";

    $youEmail = mysqli_real_escape_string($connect, $_POST['youEmail']);
    $youName = mysqli_real_escape_string($connect, $_POST['youName']);
    $youPass = mysqli_real_escape_string($connect, $_POST['youPass']);
    $youNickName = mysqli_real_escape_string($connect, $_POST['youNickName']);
    $youRegTime = time();

    // 비밀번호 해싱
    $hashedPass = password_hash($youPass, PASSWORD_DEFAULT);

    // 쿼리
    $sql = "INSERT INTO members(youEmail, youName, youPass, youNickName, youRegTime, youDelete) VALUES('$youEmail', '$youName', '$hashedPass', '$youNickName', '$youRegTime', '1')"; 
    $result = $connect -> query($sql);

    // 결과
    if (!$result) {
        die("쿼리 실행에 실패했습니다: " . $connect->error);
    }

    // 데이터베이스 연결 닫기
    mysqli_close($connect);
    echo "<script>location.href = 'logsign.php'</script>";
?>
<!-- 회원가입 -->