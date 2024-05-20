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
            <div class="main__search_pass">
                <h1 class="Pass_title01">비밀번호 찾기</h1>
                <p class="Pass_title02">비밀번호가 기억나지 않는다고? 걱정하지마</p>
                <img class="secrch_img" src="../assets/img/login/login_id_find.svg" alt="캐릭터2">
                <div class="search__wrap">
                    <form action="search_passQCheck.php" id="search_pass" name="search_pass" method="post" onsubmit="return validateForm()">
                        <fieldset>
                            <legend class="blind">비밀번호 찾기 영역</legend>
                                <div class="secrch_pass">
                                    <input type="email" name="youEmail" id="youEmail" placeholder="이메일 입력" autocomplete="off" required>
                                    <label for="youEmail" class="blind">이메일</label>
                                    <div class="secrch_pass_btn" onclick="emailChecking()">이메일 중복검사</div>
                                </div>
                            <div>
                                <select class="secrch_quiz">
                                    <option>가입했을 때 입력한 질문을 선택해주세요.</option>
                                    <option value="1">당신이 태어난 나라는?</option>
                                    <option value="2">가장 좋아하는 색은?</option>
                                    <option value="3">가장 좋아하는 음식은?</option>
                                    <option value="4">당신이 졸업한 고등학교는?</option>
                                    <option value="5">최근 관심이 생긴 취미는?</option>
                                </select>
                                <input class="secrch_quizA" type="text" name="youQuiz" id="youQuiz" placeholder="답변 입력" autocomplete="off" required>
                                <label for="youQuiz" class="blind">답변</label>
                            </div>
                            <div class="submit">
                                <button class="searchPass_btn" type="submit" onclick="return validateForm()">확인</button>
                            </div>
                            <div class="secrch_checks">
                                <ul>
                                    <li><a href="../search/search_id.php" class="line-under">혹시 이메일을 잊으셨나요?</a></li>
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
        const quiz = document.getElementById('youQuiz').value.trim();

        if (email === '') {
            alert('이메일을 입력해 주세요.');
            return false;
        }

        if (quiz === '') {
            alert('답변을 입력해 주세요.');
            return false;
        }

        return true;
    }

    function emailChecking() {
        const email = document.getElementById('youEmail').value.trim();

        if (email === '') {
            alert('이메일을 입력해 주세요.');
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'search_passECheck.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = xhr.responseText;
                if (response === 'exists') {
                    alert('해당 계정이 존재합니다.');
                } else {
                    alert('해당 계정이 존재하지 않습니다.');
                }
            }
        };
        xhr.send('youEmail=' + encodeURIComponent(email));
    }
</script>
</body>
</html>
