<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    $boardID = $_GET['boardID'];
    $memberID = $_SESSION['memberID'];

    // 게시글 소유자 확인
    $sql = "SELECT memberID FROM board2 WHERE boardID = {$boardID}";
    $result = $connect -> query($sql);
    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);
        $boardOwnerID = $info['memberID'];
        // 로그인 memberID 게시글 memberID 일치 여부
        if($memberID == $boardOwnerID){
            $sql = "DELETE FROM board2 WHERE boardID = {$boardID}";
            $connect -> query($sql);
            echo "<script>alert('게시글이 삭제되었습니다.')</script>";
        }else{
            echo "<script>alert('게시글은 소유자만 삭제할 수 있습니다.')</script>";
        }
    }else{
        echo "<script>alert('관리자에게 문의하세요.')</script>";
    }
?>
<script>
    location.href = "comm_crew.php";
</script>