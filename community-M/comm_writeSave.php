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

    // Fetch the role of the current user
    $sqlRole = "SELECT role FROM members WHERE memberID = '$memberID'";
    $resultRole = $connect->query($sqlRole);
    $rowRole = $resultRole->fetch_assoc();
    $userRole = $rowRole['role'];

    // Check if the user is an admin
    if ($userRole === 'ADMIN') {
        $boardTitle = "[공지사항] " . $boardTitle;
        $isPinned = 1;
    } else {
        $isPinned = 0;
    }

    if(empty($boardTitle) || empty($boardContents)){
        echo "<script>alert('제목 또는 내용을 작성해주세요')</script>";
        echo "<script>window.history.back()</script>";
    } else{
        // Find the last boardID
        $sqlLastID = "SELECT MAX(boardID) AS lastID FROM board3";
        $resultLastID = $connect->query($sqlLastID);
        $rowLastID = $resultLastID->fetch_assoc();
        $lastID = $rowLastID['lastID'];

        // Check if there are any deleted posts
        $sqlDeleted = "SELECT boardID FROM board3 WHERE boardDelete = 0 ORDER BY boardID DESC LIMIT 1";
        $resultDeleted = $connect->query($sqlDeleted);
        $rowDeleted = $resultDeleted->fetch_assoc();

        if ($rowDeleted && $rowDeleted['boardID'] > $lastID) {
            $boardID = $rowDeleted['boardID'];
        } else {
            $boardID = $lastID + 1;
        }

        $sql = "INSERT INTO board3(boardID, memberID, boardTitle, boardContents, regTime, isPinned) VALUES('$boardID', '$memberID', '$boardTitle', '$boardContents', '$regTime', '$isPinned')";
        $result = $connect->query($sql);

        if($result){
            echo "<script>alert('게시글이 성공적으로 작성되었습니다.'); window.location.href = 'comm_meet.php';</script>";
        } else {
            echo "<script>alert('게시글 작성에 오류가 있습니다.')</script>";
        }
    }   
?>
