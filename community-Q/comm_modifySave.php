<?php
include "../connect/connect.php";
include "../connect/session.php";

$boardID = mysqli_real_escape_string($connect, $_POST['boardID']);
$boardTitle = mysqli_real_escape_string($connect, $_POST['boardTitle']);
$boardContents = $_POST['boardContents'];
$boardPass = $_POST['boardPass'];
$memberID = $_SESSION['memberID'];

// 세션 정보가 올바른지 확인
if(!isset($memberID)) {
    echo "<script>alert('로그인이 필요합니다.')</script>";
    echo "<script>window.location.href = '../login/login.php';</script>";
    exit;
}

// 회원정보 조회
$sql = "SELECT * FROM members WHERE memberID = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $memberID);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $info = $result->fetch_array(MYSQLI_ASSOC);

    // 비밀번호 확인
    if(password_verify($boardPass, $info['youPass'])){
        // 게시글 작성자 확인
        $sql = "SELECT * FROM board4 WHERE boardID = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $boardID);
        $stmt->execute();
        $boardResult = $stmt->get_result();

        if($boardResult->num_rows > 0){
            $boardInfo = $boardResult->fetch_array(MYSQLI_ASSOC);

            if($boardInfo['memberID'] === $memberID){

                // // 게시글 수정
                $sql = "UPDATE board4 SET boardTitle = ?, boardContents = ? WHERE boardID = ?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("ssi", $boardTitle, $boardContents, $boardID);
                if($stmt->execute()){
                    echo "<script>alert('게시글이 성공적으로 수정되었습니다.')</script>";
                    echo "<script>window.location.href = 'comm_question.php';</script>";
                } else {
                    echo "<script>alert('게시글 수정에 실패했습니다.')</script>";
                    echo "<script>window.history.back()</script>";
                }
            } else {
                echo "<script>alert('작성자가 아닙니다.')</script>";
                echo "<script>window.history.back()</script>";
            }
        } else {
            echo "<script>alert('게시글을 찾을 수 없습니다.')</script>";
            echo "<script>window.history.back()</script>";
        }
    }
}
?>