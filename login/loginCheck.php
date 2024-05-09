<?php
include "../connect/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];

    if ($type == "isEmailCheck") {
        $youEmail = mysqli_real_escape_string($connect, $_POST['youEmail']);
        $sql = "SELECT * FROM members WHERE youEmail = '$youEmail'";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            echo json_encode(["result" => "bad"]);
        } else {
            echo json_encode(["result" => "good"]);
        }
    }

    if ($type == "isNickNameCheck") {
        $youNickName = mysqli_real_escape_string($connect, $_POST['youNickName']);
        $sql = "SELECT * FROM members WHERE youNickName = '$youNickName'";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            echo json_encode(["result" => "bad"]);
        } else {
            echo json_encode(["result" => "good"]);
        }
    }
}

mysqli_close($connect);
?>