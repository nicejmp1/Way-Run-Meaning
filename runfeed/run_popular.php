<?php
include "../connect/connect.php";
include "../connect/session.php";

// feedID를 받아옴 (feedID가 URL 또는 POST 데이터로 전달되어야 함)
$feedID = $_GET['feedID'] ?? $_POST['feedID'] ?? null;

$isLiked = false;
$likeCount = 0;

if (isset($_SESSION['memberID']) && $feedID) {
    $memberID = $_SESSION['memberID'];

    // 좋아요 상태 가져오기
    $likeSql = "SELECT COUNT(*) as count FROM blogLike WHERE feedID = ? AND memberID = ?";
    $likeStmt = $connect->prepare($likeSql);
    $likeStmt->bind_param("ii", $feedID, $memberID);
    $likeStmt->execute();
    $likeResult = $likeStmt->get_result();
    if ($likeResult) {
        $likeData = $likeResult->fetch_assoc();
        $isLiked = $likeData['count'] > 0;
    }

    // 좋아요 개수 가져오기
    $likeCountSql = "SELECT COUNT(*) as count FROM blogLike WHERE feedID = ?";
    $likeCountStmt = $connect->prepare($likeCountSql);
    $likeCountStmt->bind_param("i", $feedID);
    $likeCountStmt->execute();
    $likeCountResult = $likeCountStmt->get_result();
    if ($likeCountResult) {
        $likeCountData = $likeCountResult->fetch_assoc();
        $likeCount = $likeCountData['count'];
    }

    $likeStmt->close();
    $likeCountStmt->close();
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
                    <p class="title02">
                        RUN FEED
                    </p>
                    <h1 class="title01">런피드</h1>
                </div>
                <!-- //feed__title -->

                <div class="feed__info">
                    <h3 class="feed__menu">
                        <ul>
                            <li class="active"><a href="../runfeed/run_popular.php">일상</a></li>
                            <li><a href="../runfeed/run_new.php">추천&공유</a></li>
                            <li><a href="../runfeed/run_my.php">자랑</a></li>
                        </ul>
                        <a href="../runfeed/run_write.php" class="write">글쓰기</a>
                    </h3>
                </div>
                <!-- //feed__info -->

                <div class="feed__inner">
                    <div class="left">
                        <div class="card__style column3">
                            <?php
                            $category = 'popular';  // 인기 피드 카테고리
                            $sql = "SELECT * FROM feed WHERE feedDelete = 1 AND feedCate = ? ORDER BY feedRegTime DESC LIMIT 10";
                            $stmt = $connect->prepare($sql);
                            $stmt->bind_param("s", $category);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $feedID = $row['feedID'];
                                    $feedTitle = $row['feedTitle'];
                                    $feedCont = $row['feedCont'];
                                    $feedCate = $row['feedCate'];
                                    $feedAuthor = $row['feedAuthor'];
                                    $feedRegTime = date('Y.m.d', $row['feedRegTime']);
                                    $feedImgFile = $row['feedImgFile'];
                                    $feedView = $row['feedView'];
                                    $feedCont = mb_strimwidth(strip_tags($feedCont), 0, 180, "...", "UTF-8");

                                    // 좋아요 상태 가져오기
                                    $likeSql = "SELECT COUNT(*) as count FROM blogLike WHERE feedID = ? AND memberID = ?";
                                    $likeStmt = $connect->prepare($likeSql);
                                    $likeStmt->bind_param("ii", $feedID, $memberID);
                                    $likeStmt->execute();
                                    $likeResult = $likeStmt->get_result();
                                    $isLiked = false;
                                    if ($likeResult) {
                                        $likeData = $likeResult->fetch_assoc();
                                        $isLiked = $likeData['count'] > 0;
                                    }

                                    // 좋아요 개수 가져오기
                                    $likeCountSql = "SELECT COUNT(*) as count FROM blogLike WHERE feedID = ?";
                                    $likeCountStmt = $connect->prepare($likeCountSql);
                                    $likeCountStmt->bind_param("i", $feedID);
                                    $likeCountStmt->execute();
                                    $likeCountResult = $likeCountStmt->get_result();
                                    $likeCount = 0;
                                    if ($likeCountResult) {
                                        $likeCountData = $likeCountResult->fetch_assoc();
                                        $likeCount = $likeCountData['count'];
                                    }

                                    $likeStmt->close();
                                    $likeCountStmt->close();
                            ?>
                                    <div class="card">
                                        <figure class="card__img">
                                            <a href="blogView.php?feedID=<?php echo $feedID; ?>">
                                                <img src="../assets/upload/<?php echo $feedImgFile; ?>" alt="<?php echo $feedTitle; ?>">
                                            </a>
                                        </figure>
                                        <div class="card__info">
                                            <div class="title">
                                                <a href="blogView.php?feedID=<?php echo $feedID; ?>">
                                                    <h3><?php echo $feedTitle; ?></h3>
                                                    <p><?php echo $feedCont; ?></p>
                                                </a>
                                            </div>
                                            <div class="detail">
                                                <div>
                                                    <a href="#" class="author"><?php echo $feedAuthor; ?></a>
                                                    <span class="date"><?php echo $feedRegTime; ?></span>
                                                </div>
                                                <div>
                                                    <span class="view"><span class="blind">조회수</span> <?php echo $feedView; ?></span>
                                                    <a href="#" class="likeButton <?php echo $isLiked ? 'on' : ''; ?>" data-feed-id="<?php echo $feedID; ?>">
                                                        <span class="like"></span>
                                                        <span class="likeCount"><?php echo $likeCount; ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "<p class='center'>게시글이 없습니다.</p>";
                            }

                            $stmt->close();
                            ?>
                        </div>
                        <!-- card -->
                    </div>
                </div>
                <!-- //feed__inner -->
            </div>
            <!-- //container -->
        </main>
        <!-- //main -->

        <?php include "../include/footer.php" ?>
        <!-- //footer -->
    </div>
    <!-- //wrap -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.likeButton').click(function (event) {
            event.preventDefault();
            var feedID = $(this).data('feed-id');
            var likeButton = $(this);

            // Toggle the "on" class immediately to provide feedback
            likeButton.toggleClass('on');

            $.ajax({
                url: '../runfeed/blogLike.php',
                type: 'POST',
                data: { feedID: feedID },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        var likeCount = response.likeCount;
                        var isLiked = response.isLiked;

                        likeButton.find('.likeCount').text(likeCount);

                        // Ensure the "on" class reflects the actual like state
                        if (isLiked) {
                            likeButton.addClass('on');
                        } else {
                            likeButton.removeClass('on');
                        }
                    } else {
                        alert(response.message);
                        // Revert the "on" class if there's an error
                        likeButton.toggleClass('on');
                    }
                },
                error: function () {
                    alert('서버 요청에 실패했습니다. 다시 시도해 주세요.');
                    // Revert the "on" class if there's an error
                    likeButton.toggleClass('on');
                }
            });
        });
    });
</script>
</body>
</html>