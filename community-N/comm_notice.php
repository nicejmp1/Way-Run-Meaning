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
<html lang="en">
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
                        <li class="active">
                                <span>자유게시판</span>
                                <img src="../assets/img/community/commC1.svg" alt="comm1" class="comm1">
                            </li>
                        </a>
                        <a href="../community-C/comm_crew.php" class="links 02">
                            <li >
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
                            <form action="boardSearch.php" name="table__top" method="get">
                                <fieldset>
                                    <legend class="blind">게시판 검색 영역</legend>
                                    <input type="text" name="searchKeyword" placeholder="검색어를 입력해주세요.">
                                    <select name="searchOption" id="searchOption">
                                        <option value="title">제목</option>
                                        <option value="content">내용</option>
                                        <option value="name">등록자</option>
                                    </select>
                                    <button type="submit" class="btns1">검색</button>
                                    <button type="submit" class="btns2" formaction="comm_write.php">글쓰기</button>
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
if(isset($_GET['page'])){
    $page = (int) $_GET['page'];
} else {
    $page = 1;
}

$viewNum = 10;
$viewLimit = ($viewNum * $page) - $viewNum;

// 1~10 LIMIT 0, 10     ---> page1 ($viewNum * 1) - $viewNum
// 11~20 LIMIT 10, 10   ---> page2 ($viewNum * 2) - $viewNum
// 21~30 LIMIT 20, 10   ---> page3 ($viewNum * 3) - $viewNum
// 31~40 LIMIT 30, 10   ---> page4 ($viewNum * 4) - $viewNum

$sql = "SELECT b.boardID, b.boardTitle, m.youNickName, b.regTime, b.boardView FROM board b JOIN members m ON (b.memberID = m.memberID) ORDER BY boardID DESC LIMIT {$viewLimit}, {$viewNum}";
$result = $connect -> query($sql);

if($result){
    $count = $result -> num_rows;

    if($count > 0){
        for($i=0; $i<$count; $i++){
            $info = $result -> fetch_array(MYSQLI_ASSOC);

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
$boardTotalCount = ceil($boardTotalCount/$viewNum);

// 1 2 3 4 5 6 [7] 8 9 10 11 12
// $pageView = 4; --> 기준점 페이지 기준으로 양 옆에 4페이지씩 나온다는 의미
$pageView = 4; 
$startPage = $page - $pageView;
$endPage = $page + $pageView;

// 처음 페이지 초기화 & 마지막 페이지 초기화
if($startPage < 1) $startPage = 1;
if($endPage >= $boardTotalCount) $endPage = $boardTotalCount;

// 처음으로 & 이전
if($page !=1){
    $prevPage = $page - 1;
    echo "<li class='first'><a href='comm_notice.php?page=1'>처음으로</a></li>";
    echo "<li class='prev'><a href='comm_notice.php?page={$prevPage}'>이전</a></li>";
}

// 페이지
for($i=$startPage; $i<=$endPage; $i++){
    $active = "";
    if($i === $page) $active ="active";

    echo "<li class='{$active}'><a href='comm_notice.php?page={$i}'>{$i}</a></li>";
}

// 마지막으로 & 다음
if($page < $boardTotalCount){
    $nextPage = $page + 1;
    echo "<li class='next'><a href='comm_notice.php?page={$nextPage}'>다음</a></li>";
    echo "<li class='last'><a href='comm_notice.php?page={$boardTotalCount}'>마지막으로</a></li>";
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
</body>
</html>