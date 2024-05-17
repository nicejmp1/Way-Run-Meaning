<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    if(isset($_GET['page'])){
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }

    $searchKeyword = $connect -> real_escape_string(trim($_GET['searchKeyword']));
    $searchOption = $connect -> real_escape_string(trim($_GET['searchOption']));

    $sql = "SELECT b.boardID, b.boardTitle, b.boardContents, m.youNickName, b.regTime, b.boardView FROM board3 b JOIN members m ON(b.memberID = m.memberID) ";

    switch($searchOption){
        case "title":
            $sql .= "WHERE b.boardTitle LIKE '%{$searchKeyword}%' ";
            break;
        case "content":
            $sql .= "WHERE b.boardContents LIKE '%{$searchKeyword}%' ";
            break;
        case "nickname":
            $sql .= "WHERE m.youNickName LIKE '%{$searchKeyword}%' ";
            break;
        default:
            echo "<script>alert('잘못된 검색 옵션입니다.');</script>";
            exit;
    }
    $sql .= "ORDER BY b.boardID DESC";
    
    $result = $connect -> query($sql);
    if (!$result) {
        echo "<script>alert('쿼리 실행 중 오류가 발생했습니다.');</script>";
        exit;
    }

    $totalCount = $result -> num_rows;
    ?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>WayRunMeaning : 러닝 & 마라톤 - 커뮤니티</title>
    <?php include "../include/head.php"; ?>
</head>
<body>
    <div id="wrap">
        <?php include "../include/header.php"; ?>

        <main id="main" role="main">
            <div class="container">
                <div class="main__comm">
                    <p class="title02">COMMU<br>RUNNING</p>
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
                            <li>
                                <span>크루모집</span>
                                <img src="../assets/img/community/commC2.svg" alt="comm2" class="comm2">
                            </li>
                        </a>
                        <a href="../community-M/comm_meet.php" class="links 03">
                            <li class="active">
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
                <div class="comm__table">
                    <section class="table__top">
                        <div class="left">
                            * 총 <em><?=$searchKeyword?></em>에 대한 검색 결과가 <em><?=$totalCount?></em>개 나왔습니다.
                        </div>
                        <div class="right"></div>
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
                                $viewNum = 10;
                                $viewLimit = ($viewNum * $page) - $viewNum;

                                $sql .= " LIMIT {$viewLimit}, {$viewNum}";
                                $result = $connect -> query($sql);

                                if($result){
                                    $count = $result -> num_rows;

                                    if($count > 0){
                                        while ($info = $result -> fetch_array(MYSQLI_ASSOC)){
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
                            // 총 페이지 개수
                            $boardTotalCount = ceil($totalCount/$viewNum);

                            $pageView = 4; 
                            $startPage = $page - $pageView;
                            $endPage = $page + $pageView;

                            if($startPage < 1) $startPage = 1;
                            if($endPage > $boardTotalCount) $endPage = $boardTotalCount;

                            if($page !=1){
                                $prevPage = $page - 1;
                                echo "<li class='first'><a href='comm_search.php?page=1&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>처음으로</a></li>";
                                echo "<li class='prev'><a href='comm_search.php?page={$prevPage}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>이전</a></li>";
                            }

                            for($i=$startPage; $i<=$endPage; $i++){
                                $active = ($i == $page) ? "active" : "";
                                echo "<li class='{$active}'><a href='comm_search.php?page={$i}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>{$i}</a></li>";
                            }

                            if($page < $boardTotalCount){
                                $nextPage = $page + 1;
                                echo "<li class='next'><a href='comm_search.php?page={$nextPage}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>다음</a></li>";
                                echo "<li class='last'><a href='comm_search.php?page={$boardTotalCount}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>마지막으로</a></li>";
                            }
                        ?>
                        </ul>
                    </section>
                </div>
            </div>
        </main>
        <?php include "../include/footer.php"; ?>
    </div>
</body>
</html>
