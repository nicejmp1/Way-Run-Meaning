<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>WayRunMeaning : 러닝 & 마라톤 - 공지사항</title>
    <?php include "../include/head.php" ?>
</head>

<body>
<div id="wrap">
        <?php include "../include/header.php" ?>

        <main id="main" role="main">
        <div class="container">
                <div class="main__comm">
                    <p class="title02">
                        COMMU<br />
                        RUNNING
                    </p>
                    <h1 class="title01">마라톤 커뮤니티</h1>
                </div>
                <!-- //main__community -->

                <div class="comm__inner">
                    <div class="comm__modify">
                        <form action="comm_modifySave.php" name="comm_modifySave" method="post">
                            <fieldset>
                            <legend class="blind">게시글 수정하기</legend>
                            <?php
                                $boardID = $_GET['boardID'];

                                $sql = "SELECT * FROM board2 WHERE boardID = {$boardID}";
                                $result = $connect -> query($sql);

                                if($result){
                                    $info = $result -> fetch_array(MYSQLI_ASSOC);

                                    echo "<div style='display:none'><label for='boardID'>번호</label><input type='text' id='boardID' name='boardID' class='input-style' value ='".$info['boardID']."'></div>";
                                    echo "<div><label class='comm_write1' for='boardTitle'>제목</label><input type='text' id='boardTitle' name='boardTitle' class='comm_input' value ='".$info['boardTitle']."'></div>";
                                    echo "<div><label class='comm_write2' for='boardContents'>내용</label><textarea name='boardContents' id='boardContents' rows='40' class='comm_text'>".$info['boardContents']."</textarea></div>";
                                    echo "<div><label class='comm_write2' for='boardPass' class='mt50'>비밀번호</label><input type='password' id='boardPass' name='boardPass' class='comm_input mb10' autocomplete='off' placeholder='글을 수정하려면 로그인 비밀번호를 입력하셔야 합니다.' required></div>";
                                }
                            ?>
                            <div class="btn_04">
                                <button type="submit" class="btn__04">수정하기</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- //board__inner -->
        </div>
    </main>
    <!-- //main -->
        <?php include "../include/footer.php" ?>
    </div>
</body>
</html>