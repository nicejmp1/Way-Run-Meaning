<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    // 총 게시글 개수
    $sql = "SELECT count(boardID) FROM board";
    $result = $connect -> query($sql);

    $boardTotalCount = $result -> fetch_array(MYSQLI_ASSOC);
    $boardTotalCount = $boardTotalCount['count(boardID)'];
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
                <!-- //main__comm -->
                
                <div class="comm__inner">
                    <div class="comm__write">
                        <form action="comm_writeSave.php" name="comm_writeSave" method="post">
                            <fieldset>
                                <legend class="blind">게시글 작성하기</legend>
                                <div>
                                    <label class="comm_write1" for="boardTitle">제목</label>
                                    <input type="text" id="boardTitle" name="boardTitle" class="comm_input">
                                </div>
                                <div>
                                    <label class="comm_write2" for="boardContents">내용</label>
                                    <textarea name="boardContents" id="boardContents" rows="40"
                                        class="comm_text"></textarea>
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

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/translations/ko.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#boardContents'), {
                language: 'ko'
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>
</html>