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
                    <div class="comm__view">
                    <table>
                        <colgroup>
                            <col style="width: 20%" />
                            <col style="width: 80%" />
                        </colgroup>
                        <tbody>
<?php
    $boardID = $_GET['boardID'];

    // 보드뷰 + 1
    $sql = "UPDATE board SET boardView = boardView + 1 WHERE boardID = {$boardID}";
    $connect -> query($sql);

    // 데이터 가져오기
    $sql = "SELECT b.boardTitle, m.youNickName, b.regTime, b.boardView, b.boardContents FROM board b JOIN members m ON(b.memberID = m.memberID) WHERE b.boardID = {$boardID}";
    $result = $connect -> query($sql);

    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);

        echo "<tr><th>제목</th><td>".$info['boardTitle']."</td></tr>";
        echo "<tr><th>등록자</th><td>".$info['youNickName']."</td></tr>";
        echo "<tr><th>등록일</th><td>".date('Y-m-d', $info['regTime'])."</td></tr>";
        echo "<tr><th>조회수</th><td>".$info['boardView']."</td></tr>";
        echo "<tr><th>내용</th><td>".$info['boardContents']."</td></tr>";
    }
?>
                        </tbody>
                    </table>
                    <div class="btn_03">
                        <a href="comm_modify.php?boardID=<?=$_GET['boardID']?>" class="btn__01">수정하기</a>
                        <a href="comm_delete.php?boardID=<?=$_GET['boardID']?>" class="btn__02" onclick="return confirm('정말 삭제하시겠습니까?')">삭제하기</a>
                        <a href="comm_notice.php" class="btn__03">목록보기</a>
                    </div>
                </div>
            </div>
            <!-- //board__inner -->
        </div>
    </main>
    <!-- //main -->
        <?php include "../include/footer.php" ?>
    </div>
</html>