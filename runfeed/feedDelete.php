<?php
include "../connect/connect.php";
include "../connect/session.php";
include "../connect/sessionCheck.php";

if(isset($_GET['feedID'])){
    $feedID = $connect -> real_escape_string($_GET['feedID']);
    $memberID = $_SESSION['memberID']; // 세션에서 회원 ID 가져오기

    // 블로그 게시글의 작성자 ID 조회
    $sql = "SELECT memberID FROM feed WHERE feedID = ?";
    $stmt = $connect -> prepare($sql);
    $stmt -> bind_param("i", $feedID);
    $stmt -> execute();
    $stmt -> bind_result($feedOwnerID);
    $stmt -> fetch();
    $stmt -> close();
    
    // 현재 로그인한 사용자가 게시글 작성자인지 확인
    if($memberID == $feedOwnerID){
        // 게시글 삭제 상태로 변경하기
        $sql = "UPDATE feed SET feedDelete = 0 WHERE feedID = ?";
        $stmt = $connect -> prepare($sql);
        $stmt -> bind_param("i", $feedID);
        if($stmt -> execute()){
            echo "<script>alert('게시글이 성공적으로 삭제되었습니다'); location.href='run_popular.php'</script>";
        } else {
            echo "<script>alert('게시글 삭제에 실패했습니다'); history.back();</script>";
        }
        $stmt -> close();
        $connect -> close();
    } else {
        echo "<script>alert('권한이 없습니다. 자신의 게시글만 삭제할 수 있습니다.'); history.back();</script>";
    }
} else {
    echo "<script>alert('잘못된 접근입니다. 관리자에게 문의하세요'); history.back();</script>";
}
?>