<?php
include "../connect/connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $youEmail = trim($_POST['youEmail']);

    $sql = "SELECT * FROM members WHERE youEmail = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param('s', $youEmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'exists';
    } else {
        echo 'not_exists';
    }

    $stmt->close();
    $connect->close();
}
?>