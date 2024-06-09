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
                                    <input type="text" id="youEmail" name="youEmail" placeholder="이메일" autocomplete="off">
                                    <label for="youEmail" class="blind">이메일</label>
                                </div>
                                <div class="passwd">
                                    <input type="password" name="youPass" id="youPass" placeholder="비밀번호" autocomplete="off">
                                    <label for="youPass" class="blind">패스워드</label>
                                </div>
                                <div class="submit">
                                    <button class="insert__btn" type="submit">로그인</button>
                                </div>
                                <div class="checks">
                                    <ul>
                                        <li>
                                            <a href="../signup/signupInsert.php" class="line-under">회원가입</a></li>
                                        <p class="login__li">|</p>
                                        <li><a href="../search/search_id.php" class="line-under">아이디 찾기</a></li>
                                        <p class="login__li">|</p>
                                        <li><a href="../find/find__pass.php" class="line-under">비밀번호 찾기</a></li>
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
    <script>
    document.getElementById('login').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('loginsave.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())  // JSON 형식으로 응답 변환
    .then(data => {
        if (data.success) {
            alert(data.message);
            window.location.href = data.redirect; // 성공 시 페이지 리다이렉트
        } else {
            alert(data.message); // 실패 시 메시지 표시
        }
    })
    .catch(error => console.error('Error:', error));
});
    </script>
</body>
</html>