<?php
include "../connect//connect.php";
include "../connect/session.php";
include "../connect/sessionCheck.php";

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
            <div class="edite__member">
                <div class="container">
                    <div class="edite__member__title">
                        <h1 class="title">회원 정보 수정</h1>
                    </div>
                    <div class="profile">
                        <div class="profile__image">
                            <img id="profileImagePreview" class="img" src="../assets/ico/favicon.svg" alt="프로필 이미지">
                        </div>
                        <div class="profile_actions">
                            <input type="file" id="profileImageUpload" name="profileImage" accept="image/*"
                                style="display: none;">
                        </div>
                    </div>

                    <div class="login__wrap">
                        <form id="editeMember" action="editPassCheck.php" name="editeMember" method="post"
                            onsubmit="return editeChecks()" novalidate>
                            <fieldset>
                                <legend class="blind">회원 정보 수정 영역</legend>
                                <div class="edit__name">
                                    <label for="youPass" class="required">현재 패스워드</label>
                                    <input type="password" name="youPass" id="youPass" placeholder="현재 패스워드를 입력해주세요!!"
                                        autocomplete="off" class="input-text">
                                    <p class="msg" id="youPassComment"></p>
                                </div>

                                <div class="edit__new-password">
                                    <label for="youPassNew" class="required">새 패스워드</label>
                                    <input type="password" name="youPassNew" id="youPassNew"
                                        placeholder="변경하실 패스워드를 입력해주세요!!" autocomplete="off" class="input-text"
                                        disabled>
                                    <p class="msg" id="youPassNewComment"></p>
                                </div>

                                <div class="edit__new-password">
                                    <label for="youPassNewC" class="required">새 패스워드 확인</label>
                                    <input type="password" name="youPassNewC" id="youPassNewC"
                                        placeholder="변경하실 패스워드를 다시 한번 입력해주세요!!" autocomplete="off" class="input-text"
                                        disabled>
                                    <p class="msg" id="youPassNewCComment"></p>
                                </div>

                                <ul>
                                    <li><a href="editmember.php">회원정보 수정하기</a></li>
                                </ul>
                                <div class="center">
                                    <button type="submit" class="insert__btn" id="mypage">변경하기</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
        </main>
        <!--//main -->

        <?php include "../include/footer.php" ?>
        <!-- //footer -->
    </div>
    <!-- //wrap -->

    <script>

        document.getElementById('youPass').addEventListener('input', function () {
            const currentPassword = this.value;
            const passwordComment = document.getElementById('youPassComment');
            const newPasswordInput = document.getElementById('youPassNew');
            const confirmPasswordInput = document.getElementById('youPassNewC');

            if (currentPassword.length === 0) {
                passwordComment.textContent = '';
                newPasswordInput.disabled = true; // 비활성화
                confirmPasswordInput.disabled = true; // 비활성화
                return;
            }

            fetch('editPassCheck.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'youPass=' + encodeURIComponent(currentPassword)
            })
                .then(response => response.json())
                .then(data => {
                    passwordComment.textContent = data.message;
                    if (data.status === 'success') {
                        isPassword = true;
                        newPasswordInput.disabled = false; // 활성화
                        confirmPasswordInput.disabled = false; // 활성화
                    } else {
                        isPassword = false;
                        newPasswordInput.disabled = true; // 비활성화
                        confirmPasswordInput.disabled = true; // 비활성화
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    passwordComment.textContent = '➟ 패스워드 확인 중 오류가 발생했습니다.';
                    isPassword = false;
                    newPasswordInput.disabled = true; // 비활성화
                    confirmPasswordInput.disabled = true; // 비활성화
                });
        });

        document.getElementById('editeMember').addEventListener('submit', function (event) {
            event.preventDefault();

            // 입력값 확인
            if (!document.getElementById('youPass').value || !document.getElementById('youPassNew').value || !document.getElementById('youPassNewC').value) {
                alert("모든 데이터를 입력해주세요");
                return;
            }

            // 유효성 검사
            if (!isPasswordValid || !isPasswordConfirmed) {
                alert("입력된 정보의 유효성을 다시 확인해주세요.");
                return;
            }

            // 폼 데이터 전송
            const formData = new FormData(this);

            fetch('editPassUpdate.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.status === 'success') {
                        window.location.href = 'mypage.php'; // 성공적으로 비밀번호를 변경한 후 mypage로 이동
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        function resetForm() {
            document.getElementById('editeMember').reset();
        }


        let isPassword = false;
        let isPasswordValid = false;
        let isPasswordConfirmed = false;


        document.getElementById('youPassNew').addEventListener('input', checkyouPassNew);
        document.getElementById('youPassNewC').addEventListener('input', checkyouPassNewC);

        document.getElementById('editPassCheck').addEventListener('submit', function (event) {
            event.preventDefault(); // 기본 제출 동작을 막습니다.
            if (isPasswordValid && isPasswordConfirmed) {
                this.submit(); // 모든 검증이 통과되면 폼 제출
            } else {
                alert("정확한 정보를 입력해주세요.");
            }
        });


        // 비밀번호 검증 함수
        function checkyouPassNew() {
            const password = document.getElementById('youPassNew').value;
            const passwordComment = document.getElementById('youPassNewComment');

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
            } else if (password === document.getElementById('youPass').value) {
                passwordComment.textContent = "➟ 새 비밀번호가 기존 비밀번호와 동일합니다."
                document.getElementById('youPassNew').value = ''; // 입력 필드 초기화
                document.getElementById('youPassNewC').value = ''; // 확인 입력 필드도 초기화
                isPasswordValid = false;
                return;
            }

            passwordComment.textContent = "";
            isPasswordValid = true;
        }

        // 비밀번호 확인 검증 함수
        function checkyouPassNewC() {
            const password = document.getElementById('youPassNew').value;
            const confirmPassword = document.getElementById('youPassNewC').value;
            const confirmPasswordComment = document.getElementById('youPassNewCComment');

            if (password !== confirmPassword) {
                confirmPasswordComment.textContent = '➟ 비밀번호가 일치하지 않습니다.';
                isPasswordConfirmed = false;
            } else if (password.length > 0) {
                confirmPasswordComment.textContent = '➟ 비밀번호가 일치합니다.';
                isPasswordConfirmed = true;
            } else if (password === document.getElementById('youPass').value) {
                passwordComment.textContent = "➟ 새 비밀번호가 기존 비밀번호와 동일합니다."
                isPasswordValid = false;
                return;
            }
        }
    </script>

</body>

</html>