<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $feedID = isset($_GET['feedID']) ? $_GET['feedID'] : 0;

    // feedID가 없거나 잘못된 페이지로 왔을 경우
    if ($feedID == 0) {
        echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
        exit;
    }

    // 조회수 증가
    $view_query = "UPDATE feed SET feedView=feedView+1 WHERE feedID = {$feedID}";
    $view_result = $connect -> query($view_query);

    // 해당 글 정보 가져오기
    $sql = "SELECT * FROM feed WHERE feedID = {$feedID}";
    $result = $connect -> query($sql);

    // 결과가 없으면 에러처리
    if ($result -> num_rows == 0) {
        echo "<script>alert('접근 오류입니다.'); history.back();</script>";
        exit;
    }

    // 블로그 데이터 가져오기
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    $feedTitle = $row['feedTitle'];
    $feedCont = $row['feedCont'];
    $feedCate = $row['feedCate'];
    $feedAuthor = $row['feedAuthor'];
    $feedRegTime = date('Y.m.d', $row['feedRegTime']);

    // 이전글 가져오기
    $prev_sql = "SELECT feedID, feedTitle FROM feed WHERE feedID < {$feedID} AND feedCate = '{$feedCate}' ORDER BY feedID DESC LIMIT 1";
    $prevresult = $connect -> query($prev_sql);
    $prevRow = $prevresult -> fetch_array();
    $prevfeedID = $prevRow ? $prevRow['feedID'] : null;
    $prevfeedTitle = $prevRow ? $prevRow['feedTitle'] : null;

    // 다음글 가져오기
    $next_sql = "SELECT feedID, feedTitle FROM feed WHERE feedID > {$feedID} AND feedCate = '{$feedCate}' ORDER BY feedID ASC LIMIT 1";
    $nextresult = $connect -> query($next_sql);
    $nextRow = $nextresult -> fetch_array();
    $nextfeedID = $nextRow ? $nextRow['feedID'] : null;
    $nextfeedTitle = $nextRow ? $nextRow['feedTitle'] : null;

    // 좋아요
    $isLiked = false;
    $likeCount = 0;

    if (isset($_SESSION['memberID'])) {
        $memberID = $_SESSION['memberID'];

        // 좋아요 상태 가져오기
        $likeSql = "SELECT COUNT(*) as count FROM feedLike WHERE feedID = {$feedID} AND memberID = {$memberID}";
        $likeResult = $connect->query($likeSql);
        if ($likeResult) {
            $likeData = $likeResult->fetch_assoc();
            $isLiked = $likeData['count'] > 0;
        }

        // 좋아요 개수 가져오기
        $likeCountSql = "SELECT COUNT(*) as count FROM feedLike WHERE feedID = {$feedID}";
        $likeCountResult = $connect->query($likeCountSql);
        if ($likeCountResult) {
            $likeCountData = $likeCountResult->fetch_assoc();
            $likeCount = $likeCountData['count'];
        }
    }
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
            <div class="container">
                <div class="feed__title">
                    <p class="title02">RUN FEED</p>
                    <h1 class="title01">런피드</h1>
                </div>
                <!-- //feed__title -->

                <div class="feed__inner">
                    <div class="left">
                        <section class="feed__view">
                            <h3><?php echo $feedTitle ?></h3>
                            <div class="info">
                                <div>
                                    <span><?php echo $feedRegTime ?></span>
                                    <span><?php echo $feedAuthor ?></span>
                                </div>
                                <div>
                                    <span><a href="feedUpdate.php?feedID=<?php echo $feedID; ?>">수정</a></span>
                                    <span><a href="feedDelete.php?feedID=<?php echo $feedID; ?>" onclick="return confirm('삭제하시겠습니까?')">삭제</a></span>
                                    <span><a href="run_popular.php">목록</a></span>
                                </div>
                            </div>
                            <div class="contents">
                                <span><?php echo nl2br($feedCont) ?></span>
                            </div>
                        </section>
                        <!-- //feed__view -->

                        <article class="feed__next">
                            <h4 class="blind">이전글/다음글</h4>
                            <?php if($prevfeedID){ ?>
                                <a href="blogView.php?feedID=<?php echo $prevfeedID; ?>" class="prev"><i>이전글</i><span><?php echo $prevfeedTitle; ?></span></a>
                            <?php } else { ?>
                                <a href="#" class="prev"><i>이전글</i><span>이전글이 없습니다.</span></a>
                            <?php } ?>

                            <?php if($nextfeedID){ ?>
                                <a href="blogView.php?feedID=<?php echo $nextfeedID; ?>" class="next"><i>다음글</i><span><?php echo $nextfeedTitle; ?></span></a>
                            <?php } else { ?>
                                <a href="#" class="next"><i>다음글</i><span>다음글이 없습니다.</span></a>
                            <?php } ?>
                        </article>
                        <!-- //feed__next -->

                        <div class="feed__pages">
                        </div>
                        <!-- feed__pages -->
                    </div>
                </div>
            </div>
        </main>
        <!-- //main -->

        <?php include "../include/footer.php" ?>
        <!-- //footer -->
    </div>
    <!-- //wrap -->

</body>

</html>
