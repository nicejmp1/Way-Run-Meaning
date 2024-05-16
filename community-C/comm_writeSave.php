<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    $boardTitle = mysqli_real_escape_string($connect, $_POST['boardTitle']);
    $boardContents = mysqli_real_escape_string($connect, $_POST['boardContents']);
    $boardView = 1;
    $boardDelete = 1; 
    $regTime = time();
    $memberID = $_SESSION['memberID'];

    if(empty($boardTitle) || empty($boardContents)){
        echo "<script>alert('제목 또는 내용을 작성해주세요')</script>";
        echo "<script>window.history.back()</script>";
    } else{
        // Find the last boardID
        $sqlLastID = "SELECT MAX(boardID) AS lastID FROM board2";
        $resultLastID = $connect->query($sqlLastID);
        $rowLastID = $resultLastID->fetch_assoc();
        $lastID = $rowLastID['lastID'];

        // Check if there are any deleted posts
        $sqlDeleted = "SELECT boardID FROM board2 WHERE boardDelete = 0 ORDER BY boardID DESC LIMIT 1";
        $resultDeleted = $connect->query($sqlDeleted);
        $rowDeleted = $resultDeleted->fetch_assoc();

        if ($rowDeleted && $rowDeleted['boardID'] > $lastID) {
            $boardID = $rowDeleted['boardID'];
        } else {
            $boardID = $lastID + 1;
        }

        $sql = "INSERT INTO board2(boardID, memberID, boardTitle, boardContents, regTime) VALUES('$boardID', '$memberID', '$boardTitle', '$boardContents', '$regTime')";
        $result = $connect -> query($sql);

        if($result){
            echo "<script>alert('게시글이 성공적으로 작성되었습니다.'); window.location.href = 'comm_crew.php';</script>";
        } else {
            echo "<script>alert('게시글 작성에 오류가 있습니다.')</script>";
        }
    }   
?>