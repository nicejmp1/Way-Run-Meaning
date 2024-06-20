<?php
include "../connect/connect.php";
include "../connect/session.php";


$response = array();

if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == UPLOAD_ERR_OK) {
    $uploadDir = '../uploads/';
    $uploadFile = $uploadDir . basename($_FILES['profileImage']['name']);

    if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $uploadFile)) {
        $sql = "UPDATE members SET youImg = ? WHERE memberID = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('si', $uploadFile, $_SESSION['memberID']);
        if ($stmt->execute()) {
            $_SESSION['youImg'] = $uploadFile; // 세션 업데이트
            $response['success'] = true;
            $response['imagePath'] = $uploadFile;
        } else {
            $response['success'] = false;
            $response['message'] = 'Database update failed';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'File upload failed';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'No file uploaded or upload error';
}

header('Content-Type: application/json');
echo json_encode($response);
?>