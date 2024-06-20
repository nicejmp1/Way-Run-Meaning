<?php
include "../connect/connect.php";
include "../connect/session.php";
include "../connect/sessionCheck.php";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <?php include "../include/head.php" ?>
    <title>회원 정보 수정</title>
</head>

<body>
    <div id="wrap">
        <?php include "../include/header.php" ?>
        <main id="main" role="main">
            <div class="edite__member">
                <div class="container">
                    <div class="edite__member__title">
                        <h1 class="title">회원 정보 수정</h1>
                    </div>
                    <div class="profile">
                        <div class="profile__image">
                            <img id="profileImagePreview" class="img"
                                src="<?= $_SESSION['youImg'] ?? '../assets/img/mypage/my_info_1.svg' ?>" alt="프로필 이미지">
                        </div>
                        <div class="profile_actions">
                            <input type="file" id="profileImageUpload" name="profileImage" accept="image/*"
                                style="display: none;">
                            <button class="change" type="button"
                                onclick="document.getElementById('profileImageUpload').click();">이미지 변경</button>
                            <button class="save" type="button" onclick="uploadProfileImage()">저장</button>
                        </div>
                    </div>
                    <div class="login__wrap">
                        <form id="editeMember" action="editProfileUpdate.php" name="editeMember" method="post"
                            onsubmit="updateProfile(event)">
                            <fieldset>
                                <legend class="blind">회원 정보 수정 영역</legend>
                                <div class="edit__name">
                                    <label for="youCrew" class="required">러닝크루</label>
                                    <input type="text" name="youCrew" id="youCrew" placeholder="본인이 속한 러닝크루를 입력해주세요!!"
                                        autocomplete="off" class="input-text">
                                    <p class="msg" id="youNameComment"></p>
                                </div>
                                <div class="edit__nickname">
                                    <label for="youNickName" class="required">닉네임</label>
                                    <input type="text" name="youNickName" id="youNickName"
                                        placeholder="변경하실 닉네임을 입력해주세요!!" autocomplete="off" class="input-text">
                                    <p class="msg" id="youNickNameComment"></p>
                                </div>
                                <div class="edit__running_style">
                                    <p class="signname">러닝 스타일<span class="star">*</span></p>
                                    <div class="runwrap">
                                        <input type="checkbox" id="5km" name="running_style" value="5km"
                                            class="input-checkbox">
                                        <label for="5km">5km</label>
                                        <input type="checkbox" id="10km" name="running_style" value="10km"
                                            class="input-checkbox">
                                        <label for="10km">10km</label>
                                        <input type="checkbox" id="42km" name="running_style" value="42km"
                                            class="input-checkbox">
                                        <label for="42km">42km</label>
                                        <input type="checkbox" id="100km" name="running_style" value="100km"
                                            class="input-checkbox">
                                        <label for="100km">100km</label>
                                    </div>
                                </div>
                                <ul class="editepass">
                                    <li><a href="editpass.php">비밀번호 변경 하기</a></li>
                                </ul>
                                <div class="center">
                                    <button type="submit" class="insert__btn" id="mypage">저장하기</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
        </main>
        <?php include "../include/footer.php" ?>
    </div>
    <script>
        function uploadProfileImage() {
            const profileImageUpload = document.getElementById('profileImageUpload');
            const formData = new FormData();
            formData.append('profileImage', profileImageUpload.files[0]);

            fetch('editImgUpdate.php', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        document.getElementById('profileImagePreview').src = data.imagePath;
                        alert('프로필 이미지가 성공적으로 변경되었습니다.');
                    } else {
                        alert('이미지 업로드에 실패했습니다: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function checkNickname(youNickName) {
            return fetch('editNicknameCheck.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'youNickName=' + encodeURIComponent(youNickName)
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                });
        }

        function updateProfile(event) {
            event.preventDefault();
            const youCrew = document.getElementById('youCrew').value;
            const youNickName = document.getElementById('youNickName').value;

            checkNickname(youNickName).then(data => {
                if (data.success) {
                    const runningStyles = Array.from(document.querySelectorAll('input[name="running_style"]:checked')).map(checkbox => checkbox.value);

                    const formData = new FormData();
                    if (youCrew) formData.append('youCrew', youCrew);
                    formData.append('youNickName', youNickName);
                    formData.append('runningStyles', JSON.stringify(runningStyles));

                    fetch('editProfileUpdate.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                alert('회원 정보가 성공적으로 수정되었습니다.');
                                window.location.href = 'mypage.php';
                            } else {
                                alert('회원 정보 수정에 실패했습니다: ' + data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    alert(data.message);
                }
            }).catch(error => console.error('Error:', error));
        }

        // 이미지 파일 선택 시 미리보기 업데이트
        document.getElementById('profileImageUpload').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('profileImagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    </script>
</body>

</html>