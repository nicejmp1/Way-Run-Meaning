<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // 데이터 가져오기
        $feedCate = $connect->real_escape_string($_POST['feedCate']);
        $feedTitle = $connect->real_escape_string($_POST['feedTitle']);
        $feedCont = $connect->real_escape_string($_POST['feedCont']);
        $memberID = $_SESSION['memberID'];
        $feedAuthor = $_SESSION['youName'];

        // 파일 데이터 가져오기
        $feedFile = $_FILES['feedFile'];
        $feedFileName = $feedFile['name'];
        $feedFileTmp = $feedFile['tmp_name'];
        $feedFileSize = $feedFile['size'];
        $feedFileError = $feedFile['error'];

        // 파일 정보
        $allowedExt = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $uploadDir = "../assets/upload/";
        $feedImgFile = "default.jpg";
        $feedImgSize = 0;

        // 파일 업로드 (에러X AND 용량이 있을 때)
        if ($feedFileError === 0 && $feedFileSize > 0) {
            // 파일 확장자 확인
            $fileExt = strtolower(pathinfo($feedFileName, PATHINFO_EXTENSION));

            if (in_array($fileExt, $allowedExt)) {
                if ($feedFileSize < 1048576) {
                    $newFileName = "img_" . uniqid('', true) . "." . $fileExt;
                    $fileDestination = $uploadDir . $newFileName;

                    if (move_uploaded_file($feedFileTmp, $fileDestination)) {
                        $feedImgFile = $newFileName;
                        $feedImgSize = $feedFileSize;
                    } else {
                        echo "<script>alert('파일 업로드에 실패했습니다.'); history.back();</script>";
                        exit;
                    }
                } else {
                    echo "<script>alert('파일 용량이 너무 큽니다. 1MB 이하로 해주세요.'); history.back();</script>";
                    exit;
                }
            } else {
                echo "<script>alert('허용된 확장자 파일이 아닙니다.'); history.back();</script>";
                exit;
            }
        }

        $feedRegTime = time();

        // 데이터 입력
        $stmt = $connect->prepare("INSERT INTO feed (memberID, feedTitle, feedCont, feedCate, feedAuthor, feedRegTime, feedView, feedLike, feedImgFile, feedImgSize) 
                                   VALUES (?, ?, ?, ?, ?, ?, 0, 0, ?, ?)");
        $stmt->bind_param("issssssi", $memberID, $feedTitle, $feedCont, $feedCate, $feedAuthor, $feedRegTime, $feedImgFile, $feedImgSize);

        if ($stmt->execute()) {
            switch ($feedCate) {
                case 'popular':
                    $redirectPage = 'run_popular.php';
                    break;
                case 'new':
                    $redirectPage = 'run_new.php';
                    break;
                case 'my':
                    $redirectPage = 'run_my.php';
                    break;
                default:
                    $redirectPage = 'run_new.php';
            }
            echo "<script>alert('게시글이 성공적으로 작성되었습니다.'); location.href='$redirectPage';</script>";
        } else {
            echo "<script>alert('게시글 작성에 실패했습니다. 다시 시도해 주세요.'); history.back();</script>";
        }

        $stmt->close();
        $connect->close();

    } else {
        // POST 방식이 아닌 경우
        echo "<script>alert('잘못된 접근방식입니다. 관리자에게 문의하세요'); history.back();</script>";
    }
?>