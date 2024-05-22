<?php
include "../connect/connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $youEmail = trim($_POST['youEmail']);
    $youQuiz = trim($_POST['youQuiz']);

    $sql = "SELECT * FROM members WHERE youEmail = ? AND youQuiz = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param('ss', $youEmail, $youQuiz);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        $connect->close();
        echo "<script>alert('일치합니다. 비밀번호 재설정을 진행해주세요!'); location.href='../search/pass_CCheck.php';</script>";
        exit;
    } else {
        $stmt->close();
        $connect->close();
        echo "<script>alert('일치하지 않습니다. 다시 답변을 해주세요!'); history.back();</script>";
        exit;
    }
}
?>