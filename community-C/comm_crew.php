<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $isLoggedIn = isset($_SESSION['memberID']);

    // 총 게시글 개수
    $sql = "SELECT count(boardID) AS total FROM board2 WHERE boardDelete = 1";
    $result = $connect -> query($sql);
    $boardTotalCount = $result -> fetch_array(MYSQLI_ASSOC)['total'];

    if(isset($_GET['page'])){
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }

    $viewNum = 10;
    $viewLimit = ($viewNum * $page) - $viewNum;

    // 고정된 게시글과 일반 게시글을 따로 가져옴
    $sqlPinned = "SELECT b.boardID, b.boardTitle, m.youNickName, b.regTime, b.boardView, b.isPinned 
                  FROM board2 b JOIN members m ON (b.memberID = m.memberID) 
                  WHERE b.boardDelete = 1 AND b.isPinned = 1 
                  ORDER BY b.regTime DESC";

    $sqlGeneral = "SELECT b.boardID, b.boardTitle, m.youNickName, b.regTime, b.boardView, b.isPinned 
                   FROM board2 b JOIN members m ON (b.memberID = m.memberID) 
                   WHERE b.boardDelete = 1 AND b.isPinned = 0 
                   ORDER BY b.regTime DESC 
                   LIMIT {$viewLimit}, {$viewNum}";

    $resultPinned = $connect->query($sqlPinned);
    $resultGeneral = $connect->query($sqlGeneral);
?>

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
        <div class="container">
            <div class="main__comm">
                <p class="title02">
                    COMMU<br />
                    RUNNING
                </p>
                <h1 class="title01">마라톤 커뮤니티</h1>
            </div>
            <div class="comm__link">
                <ul>
                    <a href="../community-N/comm_notice.php" class="links 01">
                        <li>
                            <span>자유게시판</span>
                            <img src="../assets/img/community/commC1.svg" alt="comm1" class="comm1">
                        </li>
                    </a>
                    <a href="../community-C/comm_crew.php" class="links 02">
                        <li class="active">
                            <span>크루모집</span>
                            <img src="../assets/img/community/commC2.svg" alt="comm2" class="comm2">
                        </li>
                    </a>
                    <a href="../community-M/comm_meet.php" class="links 03">
                        <li>
                            <span>번개모임</span>
                            <img src="../assets/img/community/commC3.svg" alt="comm3" class="comm3">
                        </li>
                    </a>
                    <a href="../community-Q/comm_question.php" class="links 04">
                        <li>
                            <span>질문있어요</span>
                            <img src="../assets/img/community/commC4.svg" alt="comm4" class="comm4">
                        </li>
                    </a>
                </ul>
            </div>
            <!-- //comm__link -->
            <div class="comm__table">
                <section class="table__top">
                    <div class="left">
                        * 총 <em><?=$boardTotalCount?></em>개 게시물이 등록되어 있습니다.
                    </div>
                    <div class="right">
                        <form action="comm_search.php" name="table__top" method="get" id="tableForm">
                            <fieldset>
                                <legend class="blind">게시판 검색 영역</legend>
                                <input type="text" name="searchKeyword" placeholder="검색어를 입력해주세요.">
                                <select name="searchOption" id="searchOption">
                                    <option value="title">제목</option>
                                    <option value="content">내용</option>
                                    <option value="nickname">등록자</option>
                                </select>
                                <button type="submit" class="btns1">검색</button>
                                <button type="button" class="btns2" onclick="handleWriteButton()">글쓰기</button>
                            </fieldset>
                        </form>
                    </div>
                </section>
                <section class="table__board">
                    <table>
                        <colgroup>
                            <col style="width: 5%"/>
                            <col style="width: 63%"/>
                            <col style="width: 10%"/>
                            <col style="width: 15%"/>
                            <col style="width: 7%"/>
                        </colgroup>
                        <thead>
                            <tr>
                                <th>번호</th>
                                <th>제목</th>
                                <th>등록자</th>
                                <th>등록일</th>
                                <th>조회수</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
// 고정된 게시글 출력
if($resultPinned) {
    $countPinned = $resultPinned->num_rows;
    if($countPinned > 0) {
        for($i=0; $i<$countPinned; $i++) {
            $info = $resultPinned->fetch_array(MYSQLI_ASSOC);
            echo "<tr class='pinned'>";
            echo "<td>".$info['boardID']."</td>";
            echo "<td><a href='comm_view.php?boardID={$info['boardID']}'>".$info['boardTitle']."</a></td>";
            echo "<td>".$info['youNickName']."</td>";
            echo "<td>".date('Y-m-d', $info['regTime'])."</td>";
            echo "<td>".$info['boardView']."</td>";
            echo "</tr>";
        }
    }
}

// 일반 게시글 출력
if($resultGeneral) {
    $countGeneral = $resultGeneral->num_rows;
    if($countGeneral > 0) {
        for($i=0; $i<$countGeneral; $i++) {
            $info = $resultGeneral->fetch_array(MYSQLI_ASSOC);
            echo "<tr>";
            echo "<td>".$info['boardID']."</td>";
            echo "<td><a href='comm_view.php?boardID={$info['boardID']}'>".$info['boardTitle']."</a></td>";
            echo "<td>".$info['youNickName']."</td>";
            echo "<td>".date('Y-m-d', $info['regTime'])."</td>";
            echo "<td>".$info['boardView']."</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>게시글이 없습니다.</td></tr>";
    }
} else {
    echo "<script>alert('에러 발생! 관리자에게 문의하세요!')</script>";
}
?>
                        </tbody>
                    </table>
                </section>
                <section class="table__bottom">
                    <ul>
<?php
// 총 페이지 개수 (ceil -> 소수점 무조건 반올림)
$totalPages = ceil($boardTotalCount / $viewNum);

// 페이지네이션 범위 설정
$pageView = 4; 
$startPage = $page - $pageView;
$endPage = $page + $pageView;

// 페이지 범위 조정
if($startPage < 1) $startPage = 1;
if($endPage > $totalPages) $endPage = $totalPages;

// 처음으로 & 이전
if($page != 1){
    $prevPage = $page - 1;
    echo "<li class='first'><a href='comm_crew.php?page=1'>처음으로</a></li>";
    echo "<li class='prev'><a href='comm_crew.php?page={$prevPage}'>이전</a></li>";
}

// 페이지 번호 출력
for($i = $startPage; $i <= $endPage; $i++){
    $active = "";
    if($i === $page) $active = "active";
    echo "<li class='{$active}'><a href='comm_crew.php?page={$i}'>{$i}</a></li>";
}

// 다음 & 마지막으로
if($page < $totalPages){
    $nextPage = $page + 1;
    echo "<li class='next'><a href='comm_crew.php?page={$nextPage}'>다음</a></li>";
    echo "<li class='last'><a href='comm_crew.php?page={$totalPages}'>마지막으로</a></li>";
}
?>
                    </ul>
                </section>
            </div>
        </div>
    </main>
    <!--//main -->
    <?php include "../include/footer.php" ?>
</div>
<script>
function handleWriteButton() {
    var isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
    if (isLoggedIn) {
        document.getElementById('tableForm').action = "comm_write.php";
        document.getElementById('tableForm').submit();
    } else {
        alert("로그인이 필요합니다.");
    }
}
</script>
</body>
</html>