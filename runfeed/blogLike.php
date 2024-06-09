<?php
include "../connect/connect.php";
include "../connect/session.php";

header('Content-Type: application/json');

if (!isset($_SESSION['memberID'])) {
    echo json_encode(['status' => 'error', 'message' => '로그인이 필요합니다.']);
    exit;
}

$memberID = $_SESSION['memberID'];
$feedID = $_POST['feedID'];

// 좋아요 상태 확인
$sql = "SELECT * FROM blogLike WHERE memberID = {$memberID} AND feedID = {$feedID}";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    // 이미 좋아요를 누른 경우 좋아요 취소
    $sql = "DELETE FROM blogLike WHERE memberID = {$memberID} AND feedID = {$feedID}";
} else {
    // 좋아요를 누르지 않은 경우 좋아요 추가
    $sql = "INSERT INTO blogLike (feedID, memberID) VALUES ({$feedID}, {$memberID})";
}

if ($connect->query($sql) === TRUE) {
    // 좋아요 수 계산
    $sql = "SELECT COUNT(*) AS likeCount FROM blogLike WHERE feedID = {$feedID}";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();
    $likeCount = $row['likeCount'];

    // 좋아요 상태 계산
    $isLiked = $connect->query("SELECT COUNT(*) AS count FROM blogLike WHERE feedID = {$feedID} AND memberID = {$memberID}")->fetch_assoc()['count'] > 0;

    echo json_encode(['status' => 'success', 'likeCount' => $likeCount, 'isLiked' => $isLiked]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'DB 처리 실패']);
}

$connect->close();
?>