<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>WayRunMeaning : 러닝 & 마라톤 - 커뮤니티</title>
    <?php include "../include/head.php" ?>
</head>

<body>
<div id="wrap">
        <?php include "../include/header.php" ?>

        <main id="main" role="main">
            <div class="login__container">
                <div class="main__signcon">
                    <h2 class="title02">
                    <?
                                if(isset($_SESSION['memberID'])){
                            ?>
                                <?=$_SESSION['youNickName'];?>
                            <?
                                }
                            ?>
                        <br>가입을 축하합니다!!
                    </h2>
                    <img src="../assets/img/login/login_Congratulations.svg" alt="캐릭터1" class="ok1">
                    <div class="login__wrap">
                        <div class="signCon">
                            <button class="dark" type="submit"><a href="../login/login.php">홈으로</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--//main -->
        
        <?php include "../include/footer.php" ?>
    </div>
</body>
</html>