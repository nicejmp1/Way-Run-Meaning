<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    // $youID = mysqli_real_escape_string($connect, $_POST['youID']);
    $youEmail = mysqli_real_escape_string($connect, $_POST['youEmail']);
    $youNickName = mysqli_real_escape_string($connect, $_POST['youNickName']);
    $youName = mysqli_real_escape_string($connect, $_POST['youName']);
    $youPass = mysqli_real_escape_string($connect, $_POST['youPass']);
    $youRegTime = time();

    // 비밀번호 해싱
    $hashedPass = password_hash($youPass, PASSWORD_DEFAULT);

    // 쿼리
    $sql = "INSERT INTO members(youEmail, youNickName, youName, youPass, youRegTime, youDelete) VALUES('$youEmail', '$youNickName', '$youName', '$hashedPass', '$youRegTime','1')"; 
    $result = $connect -> query($sql);

    // 결과
    if (!$result) {
        die("쿼리 실행에 실패했습니다: " . $connect->error);
    }

    // 데이터베이스 연결 닫기
    mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <?php include "../include/head.php" ?>
    <title>Way Run Menaing : 러닝 & 마라톤</title>
</head>

<body>
    <div id="wrap">
        <?php include "../include/header.php" ?>
        <!-- //header -->

        <main id="main" role="main">
            <div class="login__container">
                <div class="main__signup__title">
                        <h1>
<?php  
    echo ($youNickName).("님") ; 
?>  
               <br>가입을 축하합니다!</h1>
                </div>
                <div class="signup__img">
                    <img src="../assets/img/login/login_Congratulations.svg" alt="">
                </div>
                    
                    <div class="login__wrap">
                        <div class="btn">
                            <a href="../login/login.php">로그인하기</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- //main -->

        <?php include "../include/footer.php" ?>
        <!-- //footer -->
    </div>
    <!-- //wrap -->
</body>

</html>