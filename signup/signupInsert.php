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
            <div class="container">
                <div class="main__signup__title">
                    <h1>회원가입</h1>
                    <p>웨이런미닝과 함께 달릴 준비 되셨나요??</p>
                </div>
                <div class="member__insert">
                    <form id="signupSave" action="signupResult.php" name="signupSave" method="post" onsubmit="return signupChecks()"
                    novalidate>
                        <fieldset>
                            <legend class="blind">회원가입 영역</legend>
                            <!-- <div>
                                <label for="youID" class="required">아이디</label>
                                <input type="text" name="youID" id="youID" placeholder="아이디를 적어주세요!!" autocomplete="off" class="input-style" >
                                <p class="msg" id="youIDComment"></p>
                            </div> -->
                            <div>
                                <label for="youEmail" class="required">이메일</label>
                                <input type="email" name="youEmail" id="youEmail" placeholder="이메일을 적어주세요!!" autocomplete="off" class="input-style" >
                                <p class="msg" id="youEmailComment"></p>
                            </div>
                            <div>
                                <label for="youNickName" class="required">닉네임</label>
                                <input type="text" name="youNickName" id="youNickName" placeholder="닉네임을 적어주세요!!" autocomplete="off" class="input-style">
                                <p class="msg" id="youNickNameComment"></p>
                            </div>
                            <div>
                                <label for="youName" class="required">이름</label>
                                <input type="text" name="youName" id="youName" placeholder="이름을 적어주세요!!" autocomplete="off" class="input-style">
                                <p class="msg" id="youNameComment"></p>
                            </div>
                            <div>
                                <label for="youPass" class="required">비밀번호</label>
                                <input type="password" name="youPass" id="youPass" placeholder="비밀번호를 입력해주세요!!" autocomplete="off" class="input-style">
                                <p class="msg" id="youPassComment"></p>
                            </div>
                            <div>
                                <label for="youPassC" class="required">비밀번호</label>
                                <input type="password" name="youPassC" id="youPassC" placeholder="다시 한번 비밀번호를 입력해주세요!!" autocomplete="off" class="input-style">
                                <p class="msg" id="youPassCComment"></p>
                            </div>
                            <div class="center">
                                <button type="submit" class="insert__btn" id="signupButton">회원가입</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </main>
        <!-- //main -->

        <?php include "../include/footer.php" ?>
        <!-- //footer -->
    </div>
    <!-- //wrap -->    

    <script>
 // 상태 변수 초기화
// let isIdvalid = false;
let isEmailValid = false;
let isNicknameValid = false;
let isPasswordValid = false;
let isPasswordConfirmed = false;

// 이벤트 리스너 설정
// document.getElementById('youID').addEventListener('input', checkyouId);
document.getElementById('youEmail').addEventListener('input', checkyouEmail);
document.getElementById('youNickName').addEventListener('input', checkyouNickName);
document.getElementById('youPass').addEventListener('input', checkyouPass);
document.getElementById('youPassC').addEventListener('input', checkyouPassC);

document.getElementById('signupSave').addEventListener('submit', function(event) {
    event.preventDefault(); // 기본 제출 동작을 막습니다.
    if (isEmailValid && isNicknameValid && isPasswordValid && isPasswordConfirmed) {
        this.submit(); // 모든 검증이 통과되면 폼 제출
    } else {
        alert("사용중인 닉네임 또는 이메일, 비밀번호가 일치하지 않습니다.");
    }
});

// function checkyouId() {
//     const id = this.value.trim();
//     const idComment = document.getElementById('youIDComment');

//     if (!id.match(/^[a-zA-Z][a-zA-Z0-9]{3,20}$/)) {
//         idComment.textContent = '➟ 올바른 아이디를 입력해주세요';
//         isIdvalid = false;
//         return;
//     }

//     fetch('signupCheck.php', {
//         method: 'POST',
//         headers: {'Content-Type': 'application/x-www-form-urlencoded'},
//         body: 'type=isIDCheck&youID=' + encodeURIComponent(id)
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.result === "good") {
//             idComment.textContent = '➟ 사용 가능한 아이디 입니다.';
//             isIdvalid = true;
//         } else {
//             idComment.textContent = '➟ 이미 사용 중인 아이디 입니다.';
//             isIdvalid = false;
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         idComment.textContent = '➟ 서버 오류가 발생하였습니다. 관리자에게 문의하세요.';
//         isIdvalid = false;
//     });
// }

// 이메일 검증 함수
function checkyouEmail() {
    const email = this.value.trim();
    const emailComment = document.getElementById('youEmailComment');

    if (!email.match(/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([\-.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i)) {
        emailComment.textContent = '➟ 올바른 이메일 주소를 입력해주세요';
        isEmailValid = false;
        return;
    }

    fetch('signupCheck.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'type=isEmailCheck&youEmail=' + encodeURIComponent(email)
    })
    .then(response => response.json())
    .then(data => {
        if (data.result === "good") {
            emailComment.textContent = '➟ 사용 가능한 이메일 입니다.';
            isEmailValid = true;
        } else {
            emailComment.textContent = '➟ 이미 사용 중인 이메일 입니다.';
            isEmailValid = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        emailComment.textContent = '➟ 서버 오류가 발생하였습니다. 관리자에게 문의하세요.';
        isEmailValid = false;
    });
}

// 닉네임 검증 함수
function checkyouNickName() {
    const nickname = this.value.trim();
    const nicknameComment = document.getElementById('youNickNameComment');

    if (!nickname.match(/^[가-힣a-zA-Z0-9]{2,20}$/)) {
        nicknameComment.textContent = '➟ 닉네임은 2~20자의 한글, 영문, 숫자만 사용 가능합니다.';
        isNicknameValid = false;
        return;
    }

    fetch('signupCheck.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'type=isNicknameCheck&youNickName=' + encodeURIComponent(nickname)
    })
    .then(response => response.json())
    .then(data => {
        if (data.result === "good") {
            nicknameComment.textContent = '➟ 사용 가능한 닉네임입니다.';
            isNicknameValid = true;
        } else {
            nicknameComment.textContent = '➟ 이미 사용 중인 닉네임입니다.';
            isNicknameValid = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        nicknameComment.textContent = '➟ 서버 오류가 발생하였습니다. 관리자에게 문의하세요.';
        isNicknameValid = false;
    });
}

// 비밀번호 검증 함수
function checkyouPass() {
    const password = document.getElementById('youPass').value;
    const passwordComment = document.getElementById('youPassComment');

    if (password.length < 8 || password.length > 20) {
        passwordComment.textContent = "➟ 8자리 ~ 20자리 이내로 입력해주세요";
        isPasswordValid = false;
        return;
    } else if (password.search(/\s/) != -1) {
        passwordComment.textContent = "➟ 비밀번호는 공백 없이 입력해주세요!";
        isPasswordValid = false;
        return;
    } else if (password.search(/[0-9]/) == -1 || password.search(/[a-zA-Z]/) == -1 || password.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/) == -1) {
        passwordComment.textContent = "➟ 영문, 숫자, 특수문자를 혼합하여 입력해주세요!";
        isPasswordValid = false;
        return;
    }

    passwordComment.textContent = "";
    isPasswordValid = true;
}

// 비밀번호 확인 검증 함수
function checkyouPassC() {
    const password = document.getElementById('youPass').value;
    const confirmPassword = document.getElementById('youPassC').value;
    const confirmPasswordComment = document.getElementById('youPassCComment');

    if (password !== confirmPassword) {
        confirmPasswordComment.textContent = '➟ 비밀번호가 일치하지 않습니다.';
        isPasswordConfirmed = false;
    } else if (password.length > 0) {
        confirmPasswordComment.textContent = '➟ 비밀번호가 일치합니다.';
        isPasswordConfirmed = true;
    }
}

    </script>
</body>

</html>