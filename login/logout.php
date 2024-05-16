<?php
    include "../connect/session.php";

    // 모든 세션 변수 제거
    session_unset();

    // 세션 파괴
    session_destroy();

    echo "<script>alert('로그아웃되었습니다.'); location.href='../main/main.php';</script>";
?>