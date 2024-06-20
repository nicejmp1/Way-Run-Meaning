<?php
include "../connect/connect.php";
include "../connect/session.php";
include "../connect/sessionCheck.php";


$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $youCrew = $_POST['youCrew'] ?? null;
    $youNickName = $_POST['youNickName'] ?? null;
    $runningStyles = json_decode($_POST['runningStyles'], true) ?? array();

    if ($youNickName) {
        $sql = "SELECT COUNT(*) AS cnt FROM members WHERE youNickName = ? AND memberID != ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('si', $youNickName, $_SESSION['memberID']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['cnt'] > 0) {
            $response['success'] = false;
            $response['message'] = '닉네임이 이미 사용 중입니다.';
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }

    $sql = "UPDATE members SET runningStyles = ?" . ($youCrew ? ", youCrew = ?" : "") . ($youNickName ? ", youNickName = ?" : "") . " WHERE memberID = ?";
    $stmt = $connect->prepare($sql);
    $runningStylesJson = json_encode($runningStyles);

    if ($youCrew && $youNickName) {
        $stmt->bind_param('ssss', $runningStylesJson, $youCrew, $youNickName, $_SESSION['memberID']);
    } elseif ($youCrew) {
        $stmt->bind_param('sss', $runningStylesJson, $youCrew, $_SESSION['memberID']);
    } elseif ($youNickName) {
        $stmt->bind_param('sss', $runningStylesJson, $youNickName, $_SESSION['memberID']);
    } else {
        $stmt->bind_param('ss', $runningStylesJson, $_SESSION['memberID']);
    }

    if ($stmt->execute()) {
        if ($youNickName) {
            $_SESSION['youNickName'] = $youNickName; // 세션 업데이트
        }
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['message'] = 'Database update failed';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method';
}

header('Content-Type: application/json');
echo json_encode($response);
?>