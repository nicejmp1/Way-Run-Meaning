<?php
include "../connect/connect.php";
include "../connect/session.php";


$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $youNickName = $_POST['youNickName'] ?? '';

    if (!empty($youNickName)) {
        $sql = "SELECT COUNT(*) AS cnt FROM members WHERE youNickName = ? AND memberID != ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('si', $youNickName, $_SESSION['memberID']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['cnt'] > 0) {
            $response['success'] = false;
            $response['message'] = '닉네임이 이미 사용 중입니다.';
        } else {
            $response['success'] = true;
        }
    } else {
        $response['success'] = true;
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method';
}

header('Content-Type: application/json');
echo json_encode($response);
?>