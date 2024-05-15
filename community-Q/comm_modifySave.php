<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $boardID = mysqli_real_escape_string($connect, $_POST['boardID']);
    $boardTitle = mysqli_real_escape_string($connect, $_POST['boardTitle']);
    $boardContents = mysqli_real_escape_string($connect, $_POST['boardContents']);
    $boardPass = $_POST['boardPass'];
    $memberID = $_SESSION['memberID'];

    // echo $boardID, $boardTitle, $boardContents, $boardPass, $memberID;

    // 회원정보 조회
    $sql = "SELECT * FROM members WHERE memberID = {$memberID}";
    $result = $connect -> query($sql);

    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);

        // 비밀번호 확인
        if(password_verify($boardPass, $info['youPass'])){
            // 게시글 작성자 확인
            $sql = "SELECT * FROM board4 WHERE boardID = {$boardID}";
            $boardResult = $connect -> query($sql);
            $boardInfo = $boardResult -> fetch_array(MYSQLI_ASSOC);

            if($boardInfo['memberID'] === $memberID){
                // 게시글 수정
                $sql = "UPDATE board4 SET boardTitle = '{$boardTitle}', boardContents = '{$boardContents}' WHERE boardID = '{$boardID}'";
                $connect -> query($sql);
                echo "<script>alert('게시글이 성공적으로 수정되었습니다.')</script>";
                echo "<script>window.location.href = 'comm_question.php';</script>";
            }
        } else {
            echo "<script>alert('비밀번호가 일치하지 않습니다.')</script>";
            echo "<script>window.history.back()</script>";
        }
    } else {
        echo "<script>alert('관리자에게 문의하세요.')</script>";
    }
?>