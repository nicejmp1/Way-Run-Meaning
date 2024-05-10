
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    
    <style>
        /* 스타일 관련 코드 생략 */
    </style>
    <title>WayRunMeaning : 러닝 & 마라톤 - 로그인</title>
    <?php include "../include/head.php" ?>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
</head>
<body>
    <div id="wrap">
        <?php include "../include/header.php" ?>
        <main id="main" role="main">
            <div class="main_logsign">
                <div class="logsign">
                    <div class="log-btn splits">
                        <p>로그인을 해주세요!</p>
                        <button id="loginSwitch">로그인하기</button>
                    </div>
                    <div class="sign-btn splits">
                        <p>회원가입을 해주세요!</p>
                        <button id="signupSwitch">가입하기</button>
                    </div>
                    <div class="wrapper">
                        <!-- 로그인 폼 -->
                        <form action="loginSave.php" name="loginSave" method="post" id="login" tabindex="500">
                            <h3>로그인</h3>
                            <div class="mail">
                                <input type="mail" name="youEmail" placeholder="이메일 입력" autocapitalize="off" required>
                                <label>Mail</label>
                            </div>
                            <div class="passwd">
                                <input type="password" name="youPass" placeholder="비밀번호 입력" autocapitalize="off" required>
                                <label>Password</label>
                            </div>
                            <div class="submit">
                                <button type="submit" name="login" class="dark">로그인</button>
                            </div>
                            <div class="checks">
                                <ul>
                                    <li><a href="checkIDPSW.html" class="line-under">아이디, 비밀번호를 잊어버리셨나요?</a></li>
                                </ul>
                            </div>
                        </form>

                        <!-- 회원가입 폼 -->
                        <form action="signResult.php" name="signSave" method="post" onsubmit="return signupChecks()" id="signin" tabindex="502">
                            <h3>회원가입</h3>
                            <div>
                                <div class="mail">
                                    <label for="youEmail">이메일</label>
                                    <input type="mail" name="youEmail" id="youEmail" placeholder="이메일 입력" autocomplete="off">
                                    <div class="btns" onclick="EmailCheck()">이메일 중복검사</div>
                                </div>
                                <p class="msg" id="youEmailComment"></p>
                            </div>
                            <div class="uid">
                                <label for="youName">User Name</label>
                                <input type="text" name="youName" id="youName" placeholder="이름 입력" autocomplete="off">
                                <p class="msg" id="youNameComment"></p>
                            </div>
                            <div class="passwd">
                                <label for="youPass">Password</label>
                                <input type="password" name="youPass" id="youPass" placeholder="비밀번호 입력" autocomplete="off">
                                <p class="msg" id="youPassComment"></p>
                            </div>
                            <div class="passwdC">
                                <label for="youPassC">Password</label>
                                <input type="password" name="youPassC" id="youPassC" placeholder="비밀번호 확인" autocomplete="off">
                                <p class="msg" id="youPassCComment"></p>
                            </div>
                            <div>
                                <div class="name">
                                    <label for="youNickName">Nickname</label>
                                    <input type="text" name="youNickName" id="youNickName" placeholder="닉네임 입력" autocomplete="off">
                                    <div class="btns" onclick="NickNameCheck()">닉네임 중복검사</div>
                                </div>
                                <p class="msg" id="youNickNameComment"></p>
                            </div>
                            <div class="submit">
                                <button type="submit" name="register" class="dark">가입완료</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php include "../include/footer.php" ?>
    </div>

    <script>
        $(document).ready(function () {
            $("#signupSwitch").click(function () {
                $('.logsign .wrapper').addClass('move');
                $('.main_logsign').css('background', '#9BABB8');
            });
            $("#loginSwitch").click(function () {
                $('.logsign .wrapper').removeClass('move');
                $('.main_logsign').css('background', '#ff4931');
            });
        });

        function signupChecks() {
            // 회원가입 검증 함수 호출
            return signupChecks();
        }

        function EmailCheck() {
            // 이메일 중복 검사 함수 호출
            EmailCheck();
        }

        function NickNameCheck() {
            // 닉네임 중복 검사 함수 호출
            NickNameCheck();
        }
    </script>
</body>

<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollToPlugin.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- <script src="./assets/js/movetext.js"></script>
<script src="./assets/plugin/slider.js"></script>
<script src="./assets/js/gsap.js"></script> -->

<script>
    window.onload = function () {
        const navList = document.querySelectorAll(".nav >ul>li");

        navList.forEach(function (navItem) {
            navItem.addEventListener("mouseover", function () {
                this.querySelector(".submenu").style.display = "block";
            })

            navItem.addEventListener("mouseout", function () {
                this.querySelector(".submenu").style.display = "none";
            })
        })
    }


    document.addEventListener('DOMContentLoaded', function () {
        let boxs = document.querySelectorAll('.goal__box1, .goal__box2, .goal__box3');

        boxs.forEach(function (box) {
            box.addEventListener('mouseover', function () {
                this.style.backgroundColor = '#fff';
                this.querySelector('p').style.color = '#FF4409';
                this.querySelector('span').style.color = '#FF4409';
                this.querySelector('.svg-path').setAttribute('fill', '#FF4409'); // SVG 색상 변경
            });
            box.addEventListener('mouseout', function () {
                // 마우스가 요소에서 벗어날 때 색상 복원
                this.style.backgroundColor = ''; // 원래 백그라운드 색상으로 복원
                this.querySelector('p').style.color = ''; // 원래 텍스트 색상으로 복원
                this.querySelector('span').style.color = ''; // 원래 span 텍스트 색상으로 복원
                this.querySelector('.svg-path').setAttribute('fill', '#FBF1E7'); // SVG 색상 변경
            });
        })
    })

    // document.addEventListener('mousemove', function (e) {
    //     const cursor = document.getElementById('cursor');
    //     cursor.style.left = e.clientX + 'px';
    //     cursor.style.top = e.clientY + 'px';
    // });
</script>

<!-- 중복검사 -->
<script>

let isEmailCheck = false;
let isNickNameCheck = false;

// 이메일 중복 검사 함수
function EmailCheck() {
    // 메시지 초기화
    $(".msg").text("");

    // 이메일 값 가져오기
    let youEmail = $("#youEmail").val();

    // 이메일 입력 여부 확인
    if (youEmail == null || youEmail === '') {
        $("#youEmailComment").text("➟ 이메일을 입력해주세요.");
        $("#youEmail").focus();
        return false;
    } else {
        // 이메일 유효성 검사 정규식
        let getYouEmail = RegExp(/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([\-.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i);

        // 올바르지 않은 이메일 형식 확인
        if (!getYouEmail.test($("#youEmail").val())) {
            $("#youEmailComment").text("➟ 올바른 이메일 주소를 입력해주세요.");
            $("#youEmail").val('');
            $("#youEmail").focus();
            return false;
        }

        // 이메일 중복 검사 AJAX 요청
        $.ajax({
            type: "POST",
            url: "loginCheck.php",
            data: { "youEmail": youEmail, "type": "isEmailCheck" },
            dataType: "json",
            success: function (data) {
                if (data.result === "good") {
                    $("#youEmailComment").text("➟ 사용 가능한 이메일입니다.");
                    isEmailCheck = true;
                } else {
                    $("#youEmailComment").text("➟ 이미 사용 중인 이메일입니다.");
                    isEmailCheck = false;
                }
            }
        });
    }
}

// 닉네임 중복 검사 함수
function NickNameCheck() {
    // 메시지 초기화
    $(".msg").text("");

    // 닉네임 값 가져오기
    let youNickName = $("#youNickName").val();

    // 닉네임 입력 여부 확인
    if (youNickName == null || youNickName === '') {
        $("#youNickNameComment").text("➟ 닉네임을 입력해주세요.");
        $("#youNickName").focus();
        return false;
    } else {
        // 닉네임 유효성 검사 정규식
        let getyouNickName = RegExp(/^[가-힣a-zA-Z0-9]{3,20}$/);

        // 올바르지 않은 닉네임 형식 확인
        if (!getyouNickName.test($("#youNickName").val())) {
            $("#youNickNameComment").text("➟ 닉네임은 10자 이내로 작성해주세요.");
            $("#youNickName").val('');
            $("#youNickName").focus();
            return false;
        }

        // 닉네임 중복 검사 AJAX 요청
        $.ajax({
            type: "POST",
            url: "loginCheck.php",
            data: { "youNickName": youNickName, "type": "isNickNameCheck" },
            dataType: "json",
            success: function (data) {
                if (data.result === "good") {
                    $("#youNickNameComment").text("➟ 사용 가능한 닉네임입니다.");
                    isNickNameCheck = true;
                } else {
                    $("#youNickNameComment").text("➟ 이미 사용 중인 닉네임입니다.");
                    isNickNameCheck = false;
                }
            }
        });
    }
}

// 회원가입 검증 함수
function signupChecks() {
    // 메시지 초기화
    $(".msg").text("");

    // 이름 값 가져오기
    let youName = $("#youName").val();

    // 이름 입력 여부 확인
    if (youName == null || youName === '') {
        $("#youNameComment").text("➟ 이름을 입력해주세요.");
        $("#youName").focus();
        return false;
    } else {
        // 이름 유효성 검사 정규식
        let getYouName = RegExp(/^[가-힣]{3,5}$/);

        // 올바르지 않은 이름 형식 확인
        if (!getYouName.test($("#youName").val())) {
            $("#youNameComment").text("➟ 이름은 한글(3~5글자)만 사용할 수 있습니다.");
            $("#youName").val('');
            $("#youName").focus();
            return false;
        }
    }

    // 비밀번호 값 가져오기
    let youPass = $("#youPass").val();

    // 비밀번호 입력 여부 확인
    if (youPass == null || youPass === '') {
        $("#youPassComment").text("➟ 비밀번호를 입력해주세요.");
        $("#youPass").focus();
        return false;
    } else {
        // 비밀번호 유효성 검사
        let getYouPass = $("#youPass").val();
        let getYouPassNum = getYouPass.search(/[0-9]/g);
        let getYouPassEng = getYouPass.search(/[a-z]/ig);
        let getYouPassSpe = getYouPass.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

        if (getYouPass.length < 8 || getYouPass.length > 20) {
            $("#youPassComment").text("➟ 8자리 ~ 20자리 이내로 입력해주세요.");
            return false;
        } else if (getYouPass.search(/\s/) !== -1) {
            $("#youPassComment").text("➟ 비밀번호는 공백 없이 입력해주세요!");
            return false;
        } else if (getYouPassNum < 0 || getYouPassEng < 0 || getYouPassSpe < 0) {
            $("#youPassComment").text("➟ 영문, 숫자, 특수문자를 혼합하여 입력해주세요!");
            return false;
        }
    }

    // 비밀번호 확인 값 가져오기
    let youPassC = $("#youPassC").val();

    // 비밀번호 확인 입력 여부 확인
    if (youPassC == null || youPassC === '') {
        $("#youPassCComment").text("➟ 확인 비밀번호를 입력해주세요!");
        $("#youPassC").focus();
        return false;
    }

    // 비밀번호 동일 여부 확인
    if ($("#youPass").val() !== $("#youPassC").val()) {
        $("#youPassCComment").text("➟ 비밀번호가 일치하지 않습니다.");
        $("#youPass").focus();
        return false;
    }

    // 중복 확인 여부 검사
    if (!isEmailCheck || !isNickNameCheck) {
        alert("중복 확인을 먼저 진행해주세요!");
        return false;
    } else {
        alert("회원가입을 축하합니다!");
        return true;
    }
}

</script>
</html>