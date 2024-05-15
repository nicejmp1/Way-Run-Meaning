<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    // 총 게시글 개수
    $sql = "SELECT count(boardID) FROM board3";
    $result = $connect -> query($sql);

    $boardTotalCount = $result -> fetch_array(MYSQLI_ASSOC);
    $boardTotalCount = $boardTotalCount['count(boardID)'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WayRunMeaning : 러닝 & 마라톤 - 공지사항</title>
    <?php include "../include/head.php" ?>
    <link rel="stylesheet" href="../coding/assets/css/comm_notice.css">
</head>

<body>
<div id="wrap">
        <?php include "../include/header.php" ?>

        <main id="main" role="main">
        <div class="container">
                <div class="main__community">
                    <p class="title02">
                        COMMU<br />
                        RUNNING
                    </p>
                    <h1 class="title01">마라톤 커뮤니티</h1>
                </div>
                <!-- <div class="comm__link">
                    <ul>
                        <a href="../community-N/comm_notice.php" class="links 01">
                            <li>
                                <span>자유게시판</span>
                                <img src="../assets/img/ch01.png" alt="캐릭터1">
                            </li>
                        </a>
                        <a href="#" class="links 02">
                            <li>
                                <span>크루모집</span>
                                <img src="../assets/img/ch02.png" alt="캐릭터2">
                            </li>
                        </a>
                        <a href="#" class="links 03">
                            <li>
                                <span>번개모임</span>
                                <img src="../assets/img/ch03.png" alt="캐릭터3">
                            </li>
                        </a>
                        <a href="#" class="links 04">
                            <li>
                                <span>질문있어요</span>
                                <img src="../assets/img/ch04.png" alt="캐릭터4">
                            </li>
                        </a>
                    </ul>
                </div> -->
                <!-- //comm__link -->

                <div class="comm__inner">
                    <div class="comm__write">
                        <form action="comm_writeSave.php" name="comm_writeSave" method="post">
                            <fieldset>
                                <legend class="blind">게시글 작성하기</legend>
                                <div>
                                    <label for="boardTitle">제목</label>
                                    <input type="text" id="boardTitle" name="boardTitle" class="input-style">
                                </div>
                                <div>
                                    <label for="boardContents">내용</label>
                                    <textarea name="boardContents" id="boardContents" rows="40"
                                        class="input-style"></textarea>
                                </div>
                                <div class="btn_01">
                                    <button type="submit">저장하기</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>                   
                </div>
                <!-- //comm__inner -->
            </div>
        </main>
        <!--//main -->
        <?php include "../include/footer.php" ?>
    </div>
</body>
</html>