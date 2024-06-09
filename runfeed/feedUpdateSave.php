white200feed<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // 데이터 가져오기
        $feedID = $connect->real_escape_string($_POST['feedID']);
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
        $feedImgFile = "";
        $feedImgSize = 0;

        // 파일 업로드
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

        // 데이터 수정
        if($feedImgFile){
            $sql = "UPDATE feed SET feedCate = ?, feedTitle = ?, feedCont = ?, feedImgFile = ?, feedImgSize = ? WHERE feedID = ?";
            $stmt = $connect -> prepare($sql);
            $stmt -> bind_param("ssssii", $feedCate, $feedTitle, $feedCont, $feedImgFile, $feedImgSize, $feedID);
        } else {
            $sql = "UPDATE feed SET feedCate = ?, feedTitle = ?, feedCont = ? WHERE feedID = ?";
            $stmt = $connect -> prepare($sql);
            $stmt -> bind_param("sssi", $feedCate, $feedTitle, $feedCont, $feedID);
        }

        // 실행
        if($stmt -> execute()){
            echo "<script>alert('게시글을 수정했습니다.'); location.href='blogView.php?feedID=$feedID';</script>";
        } else {
            echo "<script>alert('게시글 수정에 실패했습니다. 관리자에게 문의하세요'); history.back();</script>";
        }

    } else {
        echo "<script>alert('잘못된 접근입니다. 관리자에게 문의하세요'); history.back();</script>";
    }
?>