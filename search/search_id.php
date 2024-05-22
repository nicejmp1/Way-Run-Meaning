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
            <div class="main__search_id">
                <h1 class="ID_title01">아이디 찾기</h1>
                <p class="ID_title02">아이디가 기억나지 않는다고? 걱정하지마</p>
                <img class="secrch_img" src="../assets/img/login/login_id_find.svg" alt="캐릭터2">
                <div class="search__wrap">
                    <form action="search_idCheck.php" id="search_id" name="search_id" method="post">
                        <fieldset>
                            <legend class="blind">아이디 찾기 영역</legend>
                            <div class="secrch_mail">
                                <input type="text" id="youEmail" name="youEmail" placeholder="이메일 입력" autocomplete="off" required>
                                <label for="youEmail" class="blind">이메일</label>
                            </div>
                            <div class="secrch_name">
                                <input type="text" name="youName" id="youName" placeholder="이름 입력" autocomplete="off" required>
                                <label for="youName" class="blind">이름</label>
                            </div>
                            <div class="submit">
                                <button class="searchID_btn" type="submit" onclick="return validateForm()">확인</button>
                            </div>
                            <div class="secrch_checks">
                                <ul>
                                    <li><a href="../find/find__pass.php" class="line-under">혹시 비밀번호를 잊으셨나요?</a></li>
                                </ul>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include "../include/footer.php" ?>
</div>

<script>
    function validateForm() {
        const email = document.getElementById('youEmail').value.trim();
        const name = document.getElementById('youName').value.trim();

        if (email === '') {
            alert('이메일을 입력해 주세요.');
            return false;
        }

        if (name === '') {
            alert('이름을 입력해 주세요.');
            return false;
        }

        return true;
    }
</script>
</body>
</html>
