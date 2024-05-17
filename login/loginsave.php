<?php
    // include "../connect/connect.php";
    // include "../connect/session.php";

    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $youEmail = $connect -> real_escape_string(trim($_POST['youEmail']));
    //     $youPass = $connect -> real_escape_string(trim($_POST['youPass']));

    //     // 유효성 검사
    //     if (empty($youEmail) || empty($youPass)) {
    //         echo "<script>alert('아이디와 비밀번호를 입력해주세요.'); history.back();</script>";
    //         exit;
    //     }

    //     // 쿼리 작성 및 실행
    //     $stmt = $connect -> prepare("SELECT memberID, youEmail, youName, youNickName, youPass FROM members WHERE youEmail = ?");
    //     $stmt -> bind_param("s", $youEmail);
    //     $stmt -> execute();
    //     $result = $stmt -> get_result();

    //     if ($result -> num_rows > 0) {
    //         $info = $result -> fetch_assoc();

    //         // 비밀번호 확인
    //         if (password_verify($youPass, $info['youPass'])) {
    //             // 세션 설정
    //             $_SESSION['memberID'] = $info['memberID'];
    //             $_SESSION['youEmail'] = $info['youEmail'];
    //             $_SESSION['youName'] = $info['youName'];
    //             $_SESSION['youNickName'] = $info['youNickName'];
    //             $_SESSION['youPass'] = $info['youPass'];

    //             echo "<script>alert('로그인 성공!'); location.href='../index.php';</script>";
    //         } else {
    //             echo "<script>alert('비밀번호가 틀렸습니다.'); history.back();</script>";
    //         }
    //     } else {
    //         echo "<script>alert('존재하지 않는 아이디입니다.'); history.back();</script>";
    //     }

    //     $stmt -> close();
    //     $connect -> close();
    // } else {
    //     echo "<script>alert('잘못된 접근입니다. 관리자에게 문의하세요!'); history.back();</script>";
    // }
?>

<?php
header('Content-Type: application/json');
include "../connect/connect.php";
include "../connect/session.php";

$response = ['success' => false, 'message' => '잘못된 접근입니다.'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $youEmail = $connect -> real_escape_string(trim($_POST['youEmail']));
    $youPass = $connect -> real_escape_string(trim($_POST['youPass']));

    if (empty($youEmail) || empty($youPass)) {
        $response['message'] = '아이디와 비밀번호를 입력해주세요.';
    } else {
        $stmt = $connect -> prepare("SELECT memberID, youEmail, youName, youNickName, youPass FROM members WHERE youEmail = ?");
        $stmt -> bind_param("s", $youEmail);
        $stmt -> execute();
        $result = $stmt -> get_result();

        if ($result -> num_rows > 0) {
            $info = $result -> fetch_assoc();

            if (password_verify($youPass, $info['youPass'])) {
                $_SESSION['memberID'] = $info['memberID'];
                $_SESSION['youEmail'] = $info['youEmail'];
                $_SESSION['youName'] = $info['youName'];
                $_SESSION['youNickName'] = $info['youNickName'];

                $response = ['success' => true, 
                'message' => $info['youNickName']. '님 환영합니다!!', 
                'redirect' => '../index.php'];
            } else {
                $response['message'] = '비밀번호가 틀렸습니다.';
            }
        } else {
            $response['message'] = '존재하지 않는 아이디입니다.';
        }

        $stmt -> close();
    }
    $connect -> close();
}

echo json_encode($response);
?>
