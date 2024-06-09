<?php
    include "connect/connect.php";
    include "connect/session.php";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <?php include "include/head.php" ?>
    <title>Way Run Menaing : 러닝 & 마라톤</title>
</head>

<body>
    <div id="wrap">
        <?php include "include/header.php" ?>
        <!-- //header -->

        <section id="section">
            <header class="title">
                <h1 class="split">way run <br>
                    Menaing
                </h1>
            </header>
        </section>
        <!-- //section -->

        <main id="main" role="main">
            <div class="main__banner">
                <div class="container">
                    <img src="assets/img/character/character-1.svg" alt="character">
                    <a href="#">웨이런미닝 모토 바로가기</a>
                </div>
            </div>
            <!-- //main__banner -->

            <div class="cover">
                <p class="first-parallel"></p>
            </div>

            <div class="main__info">
                <div class="container">
                    <div class="main__info__title">
                        <h3>
                            Marathon information
                        </h3>
                        <p>마라톤 일정</p>
                    </div>
                    <div class="main__info__post">
                        <div class="main__post__style column4">
                                <div class="post">
                                    <img src="assets/img/post/post_2.png" alt="post1">
                                    <span class="tit">한강 나이트 워크 42K</span>
                                    <span class="pic">15,000원</span>
                                    <ul>
                                        <li class="day">2024.05.01 ~ 2024.05.02</li>
                                        <li class="like" id="youID" onclick="toggleHeart(this)"><span class="blind">좋아요</span></li>
                                    </ul>               
                                    <div class="post__con">
                                        <div class="post__left">
                                            <a href="#">웹사이트
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path class="svg-path"
                                                        d="M-3.9004e-07 8.92308L7.38462 1.53846L0.769231 1.53846L0.769231 -4.0349e-07L10 0L10 9.23077L8.46154 9.23077L8.46154 2.61538L1.07692 10L-3.9004e-07 8.92308Z"
                                                        fill="#FF4409" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="post__right">
                                            <a href="#">상세페이지
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path class="svg-path"
                                                        d="M-3.9004e-07 8.92308L7.38462 1.53846L0.769231 1.53846L0.769231 -4.0349e-07L10 0L10 9.23077L8.46154 9.23077L8.46154 2.61538L1.07692 10L-3.9004e-07 8.92308Z"
                                                        fill="#FF4409" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="post">
                                    <img src="assets/img/post/post_3.png" alt="">
                                    <span class="tit">한강 나이트 워크 42K</span>
                                    <span class="pic">15,000원</span>
                                    <ul>
                                        <li class="day">2024.05.01 ~ 2024.05.02</li>
                                        <li class="like"><span class="blind">좋아요</span></li>
                                    </ul> 
                                    <div class="post__con">
                                        <div class="post__left">
                                            <a href="#">웹사이트
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path class="svg-path"
                                                        d="M-3.9004e-07 8.92308L7.38462 1.53846L0.769231 1.53846L0.769231 -4.0349e-07L10 0L10 9.23077L8.46154 9.23077L8.46154 2.61538L1.07692 10L-3.9004e-07 8.92308Z"
                                                        fill="#FF4409" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="post__right">
                                            <a href="#">상세페이지
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path class="svg-path"
                                                        d="M-3.9004e-07 8.92308L7.38462 1.53846L0.769231 1.53846L0.769231 -4.0349e-07L10 0L10 9.23077L8.46154 9.23077L8.46154 2.61538L1.07692 10L-3.9004e-07 8.92308Z"
                                                        fill="#FF4409" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="post">
                                    <img src="assets/img/post/post_1.png" alt="">
                                    <span class="tit">한강 나이트 워크 42K</span>
                                    <span class="pic">15,000원</span>
                                    <ul>
                                        <li class="day">2024.05.01 ~ 2024.05.02</li>
                                        <li class="like"><span class="blind">좋아요</span></li>
                                    </ul> 
                                    <div class="post__con">
                                        <div class="post__left">
                                            <a href="#">웹사이트
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path class="svg-path"
                                                        d="M-3.9004e-07 8.92308L7.38462 1.53846L0.769231 1.53846L0.769231 -4.0349e-07L10 0L10 9.23077L8.46154 9.23077L8.46154 2.61538L1.07692 10L-3.9004e-07 8.92308Z"
                                                        fill="#FF4409" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="post__right">
                                            <a href="#">상세페이지
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path class="svg-path"
                                                        d="M-3.9004e-07 8.92308L7.38462 1.53846L0.769231 1.53846L0.769231 -4.0349e-07L10 0L10 9.23077L8.46154 9.23077L8.46154 2.61538L1.07692 10L-3.9004e-07 8.92308Z"
                                                        fill="#FF4409" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="post">
                                    <img src="assets/img/post/post_1.png" alt="">
                                    <span class="tit">한강 나이트 워크 42K</span>
                                    <span class="pic">15,000원</span>
                                    <ul>
                                        <li class="day">2024.05.01 ~ 2024.05.02</li>
                                        <li class="like"><span class="blind">좋아요</span></li>
                                    </ul> 
                                    <div class="post__con">
                                        <div class="post__left">
                                            <a href="#">웹사이트
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path class="svg-path"
                                                        d="M-3.9004e-07 8.92308L7.38462 1.53846L0.769231 1.53846L0.769231 -4.0349e-07L10 0L10 9.23077L8.46154 9.23077L8.46154 2.61538L1.07692 10L-3.9004e-07 8.92308Z"
                                                        fill="#FF4409" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="post__right">
                                            <a href="#">상세페이지
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path class="svg-path"
                                                        d="M-3.9004e-07 8.92308L7.38462 1.53846L0.769231 1.53846L0.769231 -4.0349e-07L10 0L10 9.23077L8.46154 9.23077L8.46154 2.61538L1.07692 10L-3.9004e-07 8.92308Z"
                                                        fill="#FF4409" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#">더보기 </a>

                    <!-- //main__info__post -->
                </div>
            </div>
            <!-- //main__info -->

            <div class="main__sub">
                <a href="#">2024 아디다스 러닝 25기 크루 신청하기 →</a>
            </div>
            <!-- //main__sub -->

            <div class="main__rank">
                <div class="container">
                    <div class="main__rank__title">
                        <h4>Marathon rankings</h4>
                        <p>마라톤 순위</p>
                    </div>
                    <div class="main__info__post rank">
                        <div class="main__post__style column3">
                            <div class="post rank1">
                                <img src="assets/img/post/post_2.png" alt="post1">
                                <span class="tit">한강 나이트 워크 42K</span>
                                <span class="pic">15,000원</span>
                                <p class="day">2024.05.01 ~ 2024.05.02</p>
                                <div class="post__con">
                                    <div class="post__left">
                                        <a href="#">웹사이트
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path class="svg-path"
                                                    d="M-3.9004e-07 8.92308L7.38462 1.53846L0.769231 1.53846L0.769231 -4.0349e-07L10 0L10 9.23077L8.46154 9.23077L8.46154 2.61538L1.07692 10L-3.9004e-07 8.92308Z"
                                                    fill="#FF4409" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="post__right">
                                        <a href="#">상세페이지
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path class="svg-path"
                                                    d="M-3.9004e-07 8.92308L7.38462 1.53846L0.769231 1.53846L0.769231 -4.0349e-07L10 0L10 9.23077L8.46154 9.23077L8.46154 2.61538L1.07692 10L-3.9004e-07 8.92308Z"
                                                    fill="#FF4409" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="post rank2">
                                <img src="assets/img/post/post_3.png" alt="">
                                <span class="tit">한강 나이트 워크 42K</span>
                                <span class="pic">15,000원</span>
                                <ul class="day">
                                    <li>2024.05.01 ~ 2024.05.02</li>
                                </ul>
                                <div class="post__con">
                                    <div class="post__left">
                                        <a href="#">웹사이트
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path class="svg-path"
                                                    d="M-3.9004e-07 8.92308L7.38462 1.53846L0.769231 1.53846L0.769231 -4.0349e-07L10 0L10 9.23077L8.46154 9.23077L8.46154 2.61538L1.07692 10L-3.9004e-07 8.92308Z"
                                                    fill="#FF4409" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="post__right">
                                        <a href="#">상세페이지
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path class="svg-path"
                                                    d="M-3.9004e-07 8.92308L7.38462 1.53846L0.769231 1.53846L0.769231 -4.0349e-07L10 0L10 9.23077L8.46154 9.23077L8.46154 2.61538L1.07692 10L-3.9004e-07 8.92308Z"
                                                    fill="#FF4409" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="post rank3">
                                <img src="assets/img/post/post_1.png" alt="">
                                <span class="tit">한강 나이트 워크 42K</span>
                                <span class="pic">15,000원</span>
                                <ul class="day">
                                    <li>2024.05.01 ~ 2024.05.02</li>
                                </ul>
                                <div class="post__con">
                                    <div class="post__left">
                                        <a href="#">웹사이트
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path class="svg-path"
                                                    d="M-3.9004e-07 8.92308L7.38462 1.53846L0.769231 1.53846L0.769231 -4.0349e-07L10 0L10 9.23077L8.46154 9.23077L8.46154 2.61538L1.07692 10L-3.9004e-07 8.92308Z"
                                                    fill="#FF4409" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="post__right">
                                        <a href="#">상세페이지
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path class="svg-path"
                                                    d="M-3.9004e-07 8.92308L7.38462 1.53846L0.769231 1.53846L0.769231 -4.0349e-07L10 0L10 9.23077L8.46154 9.23077L8.46154 2.61538L1.07692 10L-3.9004e-07 8.92308Z"
                                                    fill="#FF4409" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //main__rank -->

            <div class="main__crew">
                <div class="container">
                    <div class="main__crew__title">
                        <h5>Crew ranking</h5>
                        <p>크루 랭킹</p>
                    </div>
                    <div class="main__crew__rank">
                        <div class="crew__rank column4">
                            <div class="crew">
                                <p class="crew-tit">인천</p>
                                <p class="crew-day">썬데이 인천</p>
                                <img src="assets/ico/crew/crew-ico-1.svg" alt="">
                            </div>
                            <div class="crew">
                                <p class="crew-tit">서울</p>
                                <p class="crew-day">썬데이 서울</p>
                                <img src="assets/ico/crew/crew-ico-2.svg" alt="">
                            </div>
                            <div class="crew">
                                <p class="crew-tit">경기</p>
                                <p class="crew-day">썬데이 경기</p>
                                <img src="assets/ico/crew/crew-ico-3.svg" alt="">
                            </div>
                            <div class="crew">
                                <p class="crew-tit">강원</p>
                                <p class="crew-day">썬데이 강원</p>
                                <img src="assets/ico/crew/crew-ico-4.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //main__crew -->

            <div class="main__news">
                <div class="container">
                    <div class="main__news__title">
                        <h6>
                            marathon article
                        </h6>
                        <p>마라톤 기사</p>
                    </div>
                    <div class="main__news__post">
                        <div class="main__news__style column4">
                            <div class="post news1">
                                <a href="">
                                <img src="assets/img/news/news1.png" alt="">
                                <span class="news-tit">마라톤은 왜 42Km 일까?</span>
                                <span class="news-pic">2024.04.17</span>
                                </a>
                            </div>
                            <div class="post news2">
                                <a href="">
                                <img src="assets/img/news/news2.png" alt="">
                                <span class="news-tit">마라톤은 왜 42Km 일까?</span>
                                <span class="news-pic">2024.04.17</span>
                                </a>
                            </div>
                            <div class="post news3">
                                <a href="">
                                <img src="assets/img/news/news3.png" alt="">
                                <span class="news-tit">마라톤은 왜 42Km 일까?</span>
                                <span class="news-pic">2024.04.17</span>
                                </a>
                            </div>
                            <div class="post news4">
                                <a href="">
                                <img src="assets/img/news/news1.png" alt="">
                                <span class="news-tit">마라톤은 왜 42Km 일까?</span>
                                <span class="news-pic">2024.04.17</span>
                                </a>
                            </div>
                        </div>
                        <div class="main__news__style column4">
                            <div class="post news1">
                                <a href="">
                                <img src="assets/img/news/news1.png" alt="">
                                <span class="news-tit">마라톤은 왜 42Km 일까?</span>
                                <span class="news-pic">2024.04.17</span>
                                </a>
                            </div>
                            <div class="post news2">
                                <a href="">
                                <img src="assets/img/news/news2.png" alt="">
                                <span class="news-tit">마라톤은 왜 42Km 일까?</span>
                                <span class="news-pic">2024.04.17</span>
                                </a>
                            </div>
                            <div class="post news3">
                                <a href="">
                                <img src="assets/img/news/news3.png" alt="">
                                <span class="news-tit">마라톤은 왜 42Km 일까?</span>
                                <span class="news-pic">2024.04.17</span>
                                </a>
                            </div>
                            <div class="post news4">
                                <a href="">
                                <img src="assets/img/news/news1.png" alt="">
                                <span class="news-tit">마라톤은 왜 42Km 일까?</span>
                                <span class="news-pic">2024.04.17</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //main__news -->

            <div class="main__community">
                <div class="container">
                    <div class="main__community__title">
                        <h6>marathon community</h6>
                        <p>마라톤 커뮤니티</p>
                    </div>
                    <div class="main__community__mojib">
                        <a class="box1" href="#">
                            <span class="box_title">자유게시판
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M-7.02072e-07 16.0615L13.2923 2.76923L1.38461 2.76923L1.38461 -7.26282e-07L18 0L18 16.6154L15.2308 16.6154L15.2308 4.70769L1.93846 18L-7.02072e-07 16.0615Z"
                                        fill="#FF4409" />
                                </svg>
                           
                            </span>
                        </a>
                        <a class="box2" href="#">
                            <span class="box_title">크루모집
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M-7.02072e-07 16.0615L13.2923 2.76923L1.38461 2.76923L1.38461 -7.26282e-07L18 0L18 16.6154L15.2308 16.6154L15.2308 4.70769L1.93846 18L-7.02072e-07 16.0615Z"
                                        fill="#FF4409" />
                                </svg>
                             
                            </span>
                        </a>
                        <a class="box3" href="#">
                            <span class="box_title">번개모임
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M-7.02072e-07 16.0615L13.2923 2.76923L1.38461 2.76923L1.38461 -7.26282e-07L18 0L18 16.6154L15.2308 16.6154L15.2308 4.70769L1.93846 18L-7.02072e-07 16.0615Z"
                                        fill="#FF4409" />
                                </svg>
                              
                            </span>
                        </a>
                        <a class="box4" href="#">
                            <span class="box_title">질문있어요
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M-7.02072e-07 16.0615L13.2923 2.76923L1.38461 2.76923L1.38461 -7.26282e-07L18 0L18 16.6154L15.2308 16.6154L15.2308 4.70769L1.93846 18L-7.02072e-07 16.0615Z"
                                        fill="#FF4409" />
                                </svg>
                            </span>
                      
                        </a>
                    </div>
                </div>
            </div>
            <!-- //main__community -->
            <div class="main__footer">
                <div class="container">
                    <span>let's run with <br>
                        way run meaning
                    </span>
                </div>
            </div>
        </main>
        <!-- //main -->

        <?php include "include/footer.php" ?>
        <!-- //footer -->
    </div>
    <!-- //wrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.1/ScrollToPlugin.min.js"></script>
    <script src="https://unpkg.com/split-type"></script>
    <script src="../assets/js/movetext.js"></script>
    <script src="../assets/js/posthover.js"></script>
    <script src="../assets/js/gsap.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const likes = document.querySelectorAll('.like');
            likes.forEach(function(like, index) {
        // 고유한 'data-id' 설정
        like.setAttribute('data-id', 'like' + index);
        // 페이지 로드 시 상태 복원
        if (localStorage.getItem('like' + index) === 'active') {
            like.classList.add('active');
        }
        // 클릭 이벤트에 toggleHeart 함수 연결
        like.onclick = function() { toggleHeart(this); };
    });
});

function toggleHeart(like) {
    like.classList.toggle('active');
    const likeId = like.getAttribute('data-id');
    // localStorage에 상태 저장
    if (like.classList.contains('active')) {
        localStorage.setItem(likeId, 'active');
    } else {
        localStorage.removeItem(likeId);
    }
}



    </script>
</body>

</html>