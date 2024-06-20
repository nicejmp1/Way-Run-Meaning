<?php
include "../connect/connect.php";
include "../connect/session.php";
include "../connect/sessionCheck.php";

// 회원가입 기준 날짜 구하는 방법
$memberID = $_SESSION['memberID'];

$sql = "SELECT youRegTime, youImg, youCrew FROM members WHERE memberID = '{$memberID}'";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $youRegTime = $row['youRegTime'];
    $profileImage = $row['youImg'];
    $youCrew = $row['youCrew'];

    // 프로필 이미지가 설정되어 있는지 확인
    if (empty($profileImage)) {
        $profileImage = '../assets/img/mypage/my_info_1.svg'; // 기본 이미지 경로
    }

    // 크루 정보가 없는 경우 기본값 설정
    if (empty($youCrew)) {
        $youCrew = '크루없음';
    }

    // 세션에 크루 정보 저장
    $_SESSION['youCrew'] = $youCrew;

    // 디버그 로그
    error_log("Profile Image: " . $profileImage);

    $today = date('Y-m-d H:i:s');
    $d_day = (strtotime($today) - strtotime($youRegTime)) / (60 * 60 * 24);
    $d_day = abs($d_day) + 1; // 양수로 변환
    $d_day = (int) $d_day; // 소수점 제거

} else {
    $d_day = "정보 없음";
    $profileImage = '../assets/img/mypage/my_info_1.svg'; // 기본 이미지 경로
    $_SESSION['youCrew'] = '크루없음'; // 세션에 기본 크루 정보 설정
}

// JSON 파일 읽기
$json_data = file_get_contents('../info/posts.json');
$posts = json_decode($json_data, true);

// 좋아요 수 가져오기
$likes_data = file_get_contents('../info/getLikes.php');
// echo ('Likes Data Raw: ' . $likes_data); // 로그에 원본 데이터 기록
$likes_data = json_decode($likes_data, true);

// $likes = $likes_data['likes'];

$userLikes = $likes_data[$_SESSION['memberID']]['likes'] ?? [];

// 게시물에 좋아요 수 추가 및 사용자가 찜한 게시물만 필터링
$filtered_posts = [];
foreach ($posts as &$post) {
    $post_id = $post['post_id'];
    $post['like_count'] = $likes[$post_id] ?? 0;

    if (in_array((string) $post_id, $userLikes)) { // ID 형변환 확인
        if (empty($post['image_path'])) {
            $post['image_path'] = '../assets/img/motto/motto-1.png'; // 기본 이미지
        }
        $filtered_posts[] = $post;
    }
}

// 상위 4개 포스트 추출
$posts_to_display = array_slice($filtered_posts, 0, 4);


$connect->close();
?>


<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <?php include "../include/head.php" ?>
    <title>Way Run Menaing : 러닝 & 마라톤</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'ko',
                events: function (fetchInfo, successCallback, failureCallback) {
                    fetch('../info/posts.json')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // console.log('Posts data:', data); // 데이터 확인용 로그
                            fetch('../info/getLikes.php')
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                })
                                .then(likeData => {
                                    // console.log('Likes data:', likeData); // 데이터 확인용 로그
                                    const userLikes = likeData.userLikes;
                                    const events = data.filter(post => userLikes.includes(post.post_id)).map(post => {
                                        // 각 데이터 객체를 처리하는 부분
                                        let startDate, endDate;

                                        if (post.last_start) {
                                            // 첫 번째 형식 데이터 처리
                                            const dates = post.last_start.split(' ~ ');
                                            startDate = `${dates[0]}`;
                                            endDate = `${dates[1]}`;
                                        } else {
                                            // 두 번째 형식 데이터 처리
                                            startDate = post.start_date;
                                            endDate = post.end_date;
                                        }

                                        return {
                                            title: post.title,
                                            start: startDate,
                                            end: endDate,
                                            url: post.website_url // 수정된 부분: website_url 사용
                                        };
                                    });
                                    // console.log('Events:', events); // 데이터 확인용 로그
                                    successCallback(events);
                                })
                                .catch(error => {
                                    console.error('Error fetching likes:', error);
                                    failureCallback(error);
                                });
                        })
                        .catch(error => {
                            console.error('Error fetching posts:', error);
                            failureCallback(error);
                        });
                },
                eventClick: function (info) {
                    // 이벤트 클릭 시 해당 URL로 이동
                    window.location.href = info.event.url;
                    info.jsEvent.preventDefault(); // 기본 동작 방지
                }
            });


            calendar.render();
        });

        function updateCalendarEvents(events) {
        }

    </script>
</head>

<body>
    <div id="wrap">
        <?php include "../include/header.php" ?>
        <!-- //header -->

        <main id="main" role="main">
            <div class="container">
                <div class="mypage__title">
                    <span class="mypage__title01">MY PAGE</span>
                    <span class="mypage__text02">마이 페이지</span>
                </div>
                <!-- //mypage__title -->

                <div class="mypage__information">
                    <div class="mypage__text03">내 정보</div>
                    <div class="mypage__information__wrap">
                        <div class="mypage__information__aside">
                            <div class="mypage__nickname">
                                <div class="img">
                                    <img src="<?= $profileImage ?>" alt="">
                                </div>
                                <div class="my__name">
                                    <span class="my__nik"><?= $_SESSION['youNickName'] . "님" ?></span>
                                    <span class="my__info"><a href="editmember.php">정보 수정하기</a></span>
                                </div>
                                <span class="my__email"><?= $_SESSION['youEmail'] ?></span>
                                <a href="../login/logout.php">로그아웃</a>
                            </div>
                        </div>
                        <div class="mypage__information__contents">
                            <div class="mypage__contents1">
                                <div class="mypage__contents1-1">
                                    <p class="mp__tt">내 러닝 레벨</p>
                                    <span class="mp__text">1</span>
                                </div>
                                <div class="mypage__contents1-2">
                                    <p class="mp__tt">우리가 함께 한 지</p>
                                    <span class="mp__text"><?= $d_day . "일" ?></span>
                                </div>
                            </div>
                            <div class="mypage__contents2">
                                <div class="mp__wr">
                                    <p class="mp__tt">소속 크루</p>
                                    <span class="mp__text"><?= $_SESSION['youCrew'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //mypage__information -->
            <div class="container">
                <div class="calendar__text03">러닝 캘린더</div>

                <div class="calendar__wrap">
                    <div class="calendar__cont">
                        <div class="calendar__cont1">
                            <div id='calendar'></div>
                        </div>
                        <div class="event-list" id="event-list">
                            <ul id="liked-events-list">
                                <li id="no-liked-events">찜하신 목록이 없습니다!</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- calendar__wrap -->

            <div class="main__info">
                <div class="container">
                    <div class="save__text03">
                        <h1>
                            찜한 마라톤
                        </h1>
                    </div>
                    <div class="save__info">
                        <div class="main__post__style column4 mt60">
                            <?php foreach ($posts_to_display as $post): ?>
                                <div class="post" data-post-id="<?= htmlspecialchars($post['post_id']) ?>">
                                    <div class="img">
                                        <?php if (!empty($post['image_path'])): ?>
                                            <img src="<?= htmlspecialchars($post['image_path']) ?>" alt="post">
                                        <?php else: ?>
                                            <img src="../assets/img/motto/motto-1.png" alt="default image">
                                        <?php endif; ?>
                                    </div>
                                    <span class="tit line-one"><?= htmlspecialchars($post['title']) ?></span>
                                    <span class="pic"><?= htmlspecialchars($post['price']) ?> </span>
                                    <ul>
                                        <li class="day">접수기간 : <?= htmlspecialchars($post['start_date']) ?> ~
                                            <?= htmlspecialchars($post['end_date']) ?>
                                        </li>
                                    </ul>
                                    <span class="day">대회일시 : <?= htmlspecialchars($post['last_start']) ?></span>
                                    <ul>
                                        <li><span class="day">장소 : <?= htmlspecialchars($post['map']) ?></span></li>
                                        <span class="like" data-id="<?= htmlspecialchars($post['post_id']) ?>"><span
                                                class="blind">찜하기</span><span
                                                class="like-count"><?= htmlspecialchars($post['like_count']) ?></span></span>
                                    </ul>
                                    <div class="post__con">
                                        <div class="post__left">
                                            <a href="<?= htmlspecialchars($post['website_url']) ?>" target="_blank">웹사이트
                                                <!-- <i class="ri-arrow-right-up-line"></i> -->
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
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- calendar -->
        </main>
        <!-- //main -->

        <?php include "../include/footer.php" ?>
        <!-- //footer -->
        <!-- //wrap -->

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                function updateLikedEventsList(events) {
                    const likedEventsList = document.getElementById('liked-events-list');
                    const noLikedEventsItem = document.getElementById('no-liked-events');

                    // 기존 내용 제거
                    likedEventsList.innerHTML = '';

                    if (events.length === 0) {
                        // 이벤트가 없으면 "찜하신 목록이 없습니다!" 문구 표시
                        likedEventsList.appendChild(noLikedEventsItem);
                    } else {
                        // 이벤트가 있으면 목록 업데이트
                        events.forEach(event => {
                            const listItem = document.createElement('li');
                            const eventLink = document.createElement('a');
                            eventLink.href = event.url;
                            eventLink.textContent = event.title;
                            const eventDate = document.createElement('span');
                            eventDate.textContent = event.start;

                            listItem.appendChild(eventLink);
                            listItem.appendChild(eventDate);
                            likedEventsList.appendChild(listItem);
                        });
                    }
                }

                function fetchLikedEvents() {
                    fetch('../info/posts.json')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // console.log('Posts data:', data); // 데이터 확인용 로그
                            fetch('../info/getLikes.php')
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                })
                                .then(likeData => {
                                    // console.log('Likes data:', likeData); // 데이터 확인용 로그
                                    const userLikes = likeData.userLikes;
                                    const events = data.filter(post => userLikes.includes(post.post_id)).map(post => {
                                        let startDate;

                                        if (post.last_start) {
                                            // 첫 번째 형식 데이터 처리
                                            const dates = post.last_start.split(' ~ ');
                                            startDate = dates[0];
                                        } else {
                                            // 두 번째 형식 데이터 처리
                                            startDate = post.start_date;
                                        }

                                        return {
                                            title: post.title,
                                            start: startDate,
                                            url: post.website_url
                                        };
                                    });

                                    // 찜한 이벤트 리스트 업데이트
                                    updateLikedEventsList(events);

                                    // console.log('Events:', events); // 데이터 확인용 로그

                                    // 캘린더 이벤트에도 링크 추가
                                    updateCalendarEvents(events);
                                })
                                .catch(error => {
                                    console.error('Error fetching likes:', error);
                                });
                        })
                        .catch(error => {
                            console.error('Error fetching posts:', error);
                        });
                }

                // 찜한 이벤트 데이터를 가져와서 리스트를 업데이트
                fetchLikedEvents();
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const likeButtons = document.querySelectorAll('.like');

                // 페이지 로드 시 좋아요 상태 및 카운트 복원
                fetch('../info/getLikes.php')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // 각 게시물의 좋아요 카운트 설정
                            for (const [postId, likeCount] of Object.entries(data.likes)) {
                                const likeButton = document.querySelector(`.like[data-id='${postId}']`);
                                if (likeButton) {
                                    likeButton.querySelector('.like-count').textContent = likeCount;
                                }
                            }

                            // 로그인한 사용자의 좋아요 상태 설정
                            data.userLikes.forEach(postId => {
                                const likeButton = document.querySelector(`.like[data-id='${postId}']`);
                                if (likeButton) {
                                    likeButton.classList.add('active');
                                }
                            });
                        }
                    });

                likeButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        if (!<?= isset($_SESSION['memberID']) ? 'true' : 'false' ?>) {
                            alert('로그인이 필요합니다.');
                            return;
                        }

                        const postId = this.getAttribute('data-id');
                        fetch('../info/infoLike.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ post_id: postId })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    const likeCount = this.querySelector('.like-count');
                                    likeCount.textContent = data.like_count;
                                    this.classList.toggle('active', data.is_liked);
                                } else {
                                    alert(data.message);
                                }
                            });
                    });
                });

            });
        </script>
</body>

</html>