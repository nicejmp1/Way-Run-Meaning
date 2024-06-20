<?php
include "../connect/connect.php";
include "../connect/session.php";
include "../connect/sessionCheck.php";

header('Content-Type: application/json');

$newPassword = $_POST['youPassNew'];
$memberID = $_SESSION['memberID'];

$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

$query = "UPDATE members SET youPass = ? WHERE memberID = ?";
$stmt = $connect->prepare($query);
$stmt->bind_param("ss", $hashedPassword, $memberID);
$stmt->execute();

$response = [];
if ($stmt->affected_rows > 0) {
    $response['status'] = 'success';
    $response['message'] = '비밀번호가 성공적으로 업데이트되었습니다.';
} else {
    $response['status'] = 'error';
    $response['message'] = '업데이트 과정에서 오류가 발생했습니다.';
}

echo json_encode($response);
$stmt->close();
$connect->close();
?>