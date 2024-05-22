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
            <div class="sign__container">
                <div class="main__signup__title">
                    <h1>회원가입</h1>
                    <p>웨이런미닝과 함께 달릴 준비 되셨나요??</p>
                </div>
                <div class="member__insert">
                    <form id="signupSave" action="signupResult.php" name="signupSave" method="post" onsubmit="return signupChecks()"
                    novalidate>
                        <fieldset>
                            <legend class="blind">회원가입 영역</legend>
                            <div>
                                <label for="youEmail" class="required">이메일</label>
                                <div class="check">
                                    <input type="email" name="youEmail" id="youEmail" placeholder="이메일을 적어주세요!!"  
                                    autocomplete="off" class="input-style" >
                                    <div class="btn" onclick="emailChecking()">이메일 중복검사</div>
                                </div>
                                <p class="msg" id="youEmailComment"></p>
                            </div>
                            <div>
                                <label for="youNickName" class="required">닉네임</label>
                                <div class="check">
                                    <input type="text" name="youNickName" id="youNickName" placeholder="닉네임을 적어주세요!!" autocomplete="off" class="input-style">
                                    <div class="btn" onclick="nickNameChecking()">닉네임 중복검사</div>
                                </div>
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
                            <div>
                                <label for="youQuiz" class="required">비밀번호 찾기</label>
                                <select class="secrch_Quiz">
                                    <option>질문을 선택해주세요.</option>
                                    <option value="1">당신이 태어난 나라는?</option>
                                    <option value="2">가장 좋아하는 색은?</option>
                                    <option value="3">가장 좋아하는 음식은?</option>
                                    <option value="4">당신이 졸업한 고등학교는?</option>
                                    <option value="5">최근 관심이 생긴 취미는?</option>
                                </select>
                                <input type="text" name="youQuiz" id="youQuiz" placeholder="답변을 적어주세요!!" autocomplete="off" class="input-style">
                                <p class="msg" id="youQuizComment"></p>
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
    <?php include "../include/script.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <script>
        let isnicknameCheck = false;
        let isEmailCheck = false;

        function nickNameChecking() {
            let youNickName = $("#youNickName").val();

            if(youNickName == null || youNickName == '') {
                $("#youNickNameComment").text("➟ 닉네임을 입력해주세요!");
                $("#youNickName").focus();
                return false;
            } else {
                let getyouNickName = RegExp(/^[가-힣a-zA-Z][가-힣a-zA-Z0-9]{2,20}$/);

                if(!getyouNickName.test($("#youNickName").val())) {
                    $("#youNickNameComment").text("➟ 아이디는 영어 또는 숫자 또는 한글을 포함하여 4~20글자 이내로 작성이 가능합니다.");
                    $("#youNickName").val('');
                    $("#youNickName").focus();
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: "signupCheck.php",
                    data: {"youNickName": youNickName, "type": "isnicknameCheck"},
                    dataType: "json",
                    success: function(data){
                        if(data.result == "good") {
                            $("#youNickNameComment").text("➟ 사용 가능한 아이디입니다.");
                            isnicknameCheck = true;
                        } else {
                            $("#youNickNameComment").text("➟ 이미 사용중인 아이디입니다.");
                            isnicknameCheck = false;
                        }
                    }
                });
            }
        }

        function emailChecking() {
            let youEmail = $("#youEmail").val();

            if(youEmail == null || youEmail == '') {
                $("#youEmailComment").text("➟ 이메일을 입력해주세요!");
                $("#youEmail").focus();
                return false;
            } else {
                let getYouEmail = RegExp(/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([\-.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i);

                if(!getYouEmail.test($("#youEmail").val())) {
                    $("#youEmailComment").text("➟ 올바른 이메일 주소를 입력해주세요");
                    $("#youEmail").val('');
                    $("#youEmail").focus();
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: "signupCheck.php",
                    data: {"youEmail": youEmail, "type": "isEmailCheck"},
                    dataType: "json",
                    success: function(data){
                        if(data.result == "good") {
                            $("#youEmailComment").text("➟ 사용 가능한 이메일 입니다.");
                            isEmailCheck = true;
                        } else {
                            $("#youEmailComment").text("➟ 이미 사용중인 이메일 입니다.");
                            isEmailCheck = false;
                        }
                    }
                });
            }
        }

        function signupChecks(){
            $(".msg").text("");

            let youName = $("#youName").val();
            if(youName == null || youName == '') {
                $("#youNameComment").text("➟ 이름을 입력해주세요!");
                $("#youName").focus();
                return false;
            } else {
                let getYouName = RegExp(/^[가-힣]{3,5}$/);
                if(!getYouName.test($("#youName").val())){
                    $("#youNameComment").text("➟ 이름은 한글(3~5글자)만 사용할 수 있습니다.");
                    $("#youName").val('');
                    $("#youName").focus();
                    return false;
                }
            }

            let youPass = $("#youPass").val();
            if(youPass == null || youPass == '') {
                $("#youPassComment").text("➟ 비밀번호를 입력해주세요!");
                $("#youPass").focus();
                return false;
            } else {
                let getYouPass = $("#youPass").val();
                let getYouPassNum = getYouPass.search(/[0-9]/g);
                let getYouPassEng = getYouPass.search(/[a-z]/ig);
                let getYouPassSpe = getYouPass.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

                if(getYouPass.length < 8 || getYouPass.length > 20){
                    $("#youPassComment").text("➟ 8자리 ~ 20자리 이내로 입력해주세요");
                    return false;
                } else if (getYouPass.search(/\s/) != -1){
                    $("#youPassComment").text("➟ 비밀번호는 공백없이 입력해주세요!");
                    return false;
                } else if (getYouPassNum < 0 || getYouPassEng < 0 || getYouPassSpe < 0 ){
                    $("#youPassComment").text("➟ 영문, 숫자, 특수문자를 혼합하여 입력해주세요!");
                    return false;
                } 
            }

            let youPassC = $("#youPassC").val();
            if(youPassC == null || youPassC == '') {
                $("#youPassCComment").text("➟ 확인 비밀번호를 입력해주세요!");
                $("#youPassC").focus();
                return false;
            }

            if($("#youPass").val() !== $("#youPassC").val()){
                $("#youPassCComment").text("➟ 비밀번호가 일치하지 않습니다.");
                $("#youPass").focus();
                return false;
            }

            let youQuiz = $("#youQuiz").val();
            if(youQuiz == null || youQuiz == '') {
                $("#youQuizComment").text("➟ 답변을 입력해주세요!");
                $("#youQuiz").focus();
                return false;
            } else {
                let getyouQuiz = RegExp(/^[가-힣]{1,10}$/);
                if(!getyouQuiz.test($("#youQuiz").val())){
                    $("#youQuizComment").text("➟ 답변은 한글(1~10글자)만 사용할 수 있습니다.");
                    $("#youQuiz").val('');
                    $("#youQuiz").focus();
                    return false;
                }
            }
             
            if(!isnicknameCheck || !isEmailCheck) {
                alert("중복 확인을 먼저 진행해주세요!");
                return false;
            } else {
                alert("회원가입을 축하합니다.");
            }
        }
    </script>
</body>

</html>