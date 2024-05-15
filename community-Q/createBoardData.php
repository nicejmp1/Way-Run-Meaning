<?php
    include "../connect/connect.php";

    for($i=1; $i<=300; $i++){
        $regTime = time();
        $sql = "INSERT INTO board4(memberID, boardTitle, boardContents, boardView, regTime) VALUES(1, '게시판 제목입니다.${i}', '${i}번째 게시판 내용입니다. 내용입니다. 내용입니다. 애뇽', 1, '$regTime')";
        $connect -> query($sql);
    }
?>