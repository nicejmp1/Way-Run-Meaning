<?php
include "../connect/connect.php";
include "../connect/session.php";
include "../connect/sessionCheck.php";

header('Content-Type: application/json');

$currentPassword = $_POST['youPass'] ?? ''; // PHP 7.0+ null coalescing operator 사용
$memberID = $_SESSION['memberID'] ?? 0; // 세션 값이 설정되지 않았을 경우 기본값

if (empty($memberID) || empty($currentPassword)) {
    echo json_encode(['status' => 'error', 'message' => '➟ 필수 데이터가 누락되었습니다.']);
    exit;
}

$query = "SELECT youPass FROM members WHERE memberID = ?";
$stmt = $connect->prepare($query);
if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => '➟ 쿼리 준비 과정에서 오류가 발생했습니다.']);
    exit;
}

$stmt->bind_param("s", $memberID);
if (!$stmt->execute()) {
    echo json_encode(['status' => 'error', 'message' => '➟ 쿼리 실행 중 오류가 발생했습니다.']);
    exit;
}

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row && password_verify($currentPassword, $row['youPass'])) {
    echo json_encode(['status' => 'success', 'message' => '➟ 현재 패스워드가 확인되었습니다.']);
} else {
    echo json_encode(['status' => 'error', 'message' => '➟ 현재 패스워드가 일치하지 않습니다.']);
}

$stmt->close();
$connect->close();
?>