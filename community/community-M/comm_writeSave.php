<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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

    // echo $boardTitle;
    // echo $boardContents;

    if(empty($boardTitle) || empty($boardContents)){
        echo "<script>alert('제목 또는 내용을 작성해주세요')</script>";
        echo "<script>window.history.back()</script>";
    } else{
        $sql = "INSERT INTO board3(memberID, boardTitle, boardContents, regTime) VALUES('$memberID', '$boardTitle', '$boardContents', '$regTime')";
        $result = $connect -> query($sql);

        if($result){
            echo "<script>alert('게시글이 성공적으로 작성되었습니다.'); window.location.href = 'comm_meet.php';</script>";
        } else {
            echo "<script>alert('게시글 작성에 오류가 있습니다.')</script>";
        }
    }   
?>
</body>
</html>