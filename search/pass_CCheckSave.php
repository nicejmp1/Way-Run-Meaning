<?php
include "../connect/connect.php";
include "../connect/session.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $youPass = trim($_POST['youPass']);
    $youPassC = trim($_POST['youPassC']);

    // 비밀번호 검증
    if ($youPass === $youPassC) {
        // 비밀번호 해시화
        $hashedPass = password_hash($youPass, PASSWORD_DEFAULT);

        // 세션에서 사용자 ID 가져오기 (로그인 세션이 있다고 가정)
        $memberID = $_SESSION['memberID'];

        // 비밀번호 업데이트 쿼리
        $sql = "UPDATE members SET youPass = ? WHERE memberID = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('si', $hashedPass, $memberID);

        // 쿼리 실행
        if ($stmt->execute()) {
            echo "<script>alert('비밀번호가 성공적으로 변경되었습니다.'); location.href='../login/login.php';</script>";
        } else {
            echo "<script>alert('비밀번호 변경에 실패했습니다. 다시 시도해 주세요.'); history.back();</script>";
        }
        
        $stmt->close();
    } else {
        echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back();</script>";
    }
} else {
    echo "<script>alert('잘못된 접근입니다.'); location.href='../index.php';</script>";
}

$connect->close();
?>
