
<?php
include "../connect/connect.php"; // 데이터베이스 연결 파일
header('Content-Type: application/json');

$type = $_POST['type'] ?? '';
// $youID = $_POST['youID'] ?? '';  
$youEmail = $_POST['youEmail'] ?? '';
$youNickName = $_POST['youNickName'] ?? '';
$jsonResult = "bad";

// if ($type == "isIDCheck" && !empty($youID)) {
//     $stmt = $connect->prepare("SELECT youID FROM members WHERE youID = ?");
//     $stmt->bind_param("s", $youID);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     if ($result->num_rows == 0) {
//         $jsonResult = "good";
//     }
//     $stmt->close();
// }

if ($type == "isEmailCheck" && !empty($youEmail)) {
    $stmt = $connect->prepare("SELECT youEmail FROM members WHERE youEmail = ?");
    $stmt->bind_param("s", $youEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        $jsonResult = "good";
    }
    $stmt->close();
}

if ($type == "isNicknameCheck" && !empty($youNickName)) {
    $stmt = $connect->prepare("SELECT youNickName FROM members WHERE youNickName = ?");
    $stmt->bind_param("s", $youNickName);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        $jsonResult = "good";
    }
    $stmt->close();
}

echo json_encode(array("result" => $jsonResult));

?>

