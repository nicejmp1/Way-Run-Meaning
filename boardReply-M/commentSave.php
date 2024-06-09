<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    header('Content-Type: application/json');

    // POST 데이터 가져오기
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 필수 필드 검증
        if (isset($_POST['boardID']) && isset($_POST['commentText'])) {
            $boardID = intval($_POST['boardID']);
            $commentText = $_POST['commentText'];
            $commentTime = time();
            
            // 세션에서 사용자 정보 가져오기
            if (isset($_SESSION['memberID']) && isset($_SESSION['youNickName'])) {
                $memberID = intval($_SESSION['memberID']);
                $commentName = $_SESSION['youNickName'];

                // 댓글 저장
                $sql = "INSERT INTO boardReply3 (boardID, memberID, commentName, commentText, commentTime) VALUES (?, ?, ?, ?, ?)";
                $stmt = $connect -> prepare($sql);
                $stmt -> bind_param("iissi", $boardID, $memberID, $commentName, $commentText, $commentTime);
                if ($stmt -> execute()) {
                    $commentID = $stmt -> insert_id;
                    echo json_encode([
                        "status" => "success",
                        "message" => "댓글이 성공적으로 등록되었습니다.",
                        "commentID" => $commentID,
                        "commentName" => $commentName,
                        "commentText" => $commentText,
                        "commentTime" => date('Y.m.d H:i', $commentTime)
                    ]);
                } else {
                    echo json_encode(["status" => "error", "message" => "댓글 등록에 실패했습니다: " . $stmt->error]);
                }
                $stmt -> close();
            } else {
                echo json_encode(["status" => "error", "message" => "사용자 세션이 올바르게 설정되지 않았습니다."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "잘못된 입력입니다."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "잘못된 요청 방식입니다."]);
    }

    $connect -> close();
?>
