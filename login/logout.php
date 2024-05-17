<?php
    include "../connect/session.php";

    // 모든 세션 변수 제거
    session_unset();
    // 세션 파괴
    session_destroy();

    echo "<script>window.location.href='../index.php';</script>";
?>