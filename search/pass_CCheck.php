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
            <div class="main__passCC">
                <h1 class="passCC_title01">비밀번호 재설정</h1>
                <p class="passCC_title02">비밀번호가 기억나지 않는다고? 걱정하지마</p>
                <img class="secrch_img" src="../assets/img/login/login_id_find.svg" alt="캐릭터2">
                <div class="search__wrap">
                    <form action="pass_CCheckSave.php" id="pass_CCheck" name="pass_CCheck" method="post" onsubmit="return signupChecks()"
                    novalidate>
                        <fieldset>
                            <legend class="blind">비밀번호 재설정 영역</legend>
                            <div class="secrch_passC">
                                <input type="password" name="youPass" id="youPass" placeholder="새 비밀번호를 입력" autocomplete="off" required>
                                <label for="youPass" class="blind">비밀번호 재설정</label>
                                <p class="msg" id="youPassComment"></p>
                            </div>
                            <div class="secrch_passCC">
                                <input type="password" name="youPassC" id="youPassC" placeholder="새 비밀번호를 입력 확인" autocomplete="off" required>
                                <label for="youPassC" class="blind">비밀번호 재설정 확인</label>
                                <p class="msg" id="youPassCComment"></p>
                            </div>
                            <div class="submit">
                                <button class="passC_btn" type="submit">확인</button>
                            </div>
                            <div class="passC_checks">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    function signupChecks(){
            $(".msg").text("");
            
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

            
        }
</script>
</body>
</html>
