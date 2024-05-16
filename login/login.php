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
                <div class="main__login">
                    <h1 class="title01">어서와 마라톤 커뮤니티는 처음이지?</h1>
                    <img src="../assets/img/login/login_login.svg" alt="캐릭터1">
                    <div class="login__wrap">
                        <form action="loginsave.php" id="login" name="loginsave" method="post">
                            <fieldset>
                            <legend class="blind">로그인 영역</legend>
                                <div class="mail">
                                    <input type="text" id="youEmail" name="youEmail" placeholder="아이디 입력" autocomplete="off" required>
                                    <label for="youEmail" class="blind">이메일</label>
                                </div>
                                <div class="passwd">
                                    <input type="password" name="youPass" id="youPass" placeholder="패스워드 입력" autocomplete="off" required>
                                    <label for="youPass" class="blind">패스워드</label>
                                </div>
                                <div class="submit">
                                    <button class="dark" type="submit">로그인</button>
                                </div>
                                <div class="checks">
                                    <ul>
                                        <li><a href="../html/coding/login/login_sign.html" class="line-under">회원가입</a></li>
                                        <p class="login__li">|</p>
                                        <li><a href="../html/coding/login/login_IDfind.html" class="line-under">아이디 찾기</a></li>
                                        <p class="login__li">|</p>
                                        <li><a href="../html/coding/login/login_PWfind.html" class="line-under">비밀번호 찾기</a></li>
                                    </ul>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!--//main -->
        
        <?php include "../include/footer.php" ?>
    </div>
</body>
</html>