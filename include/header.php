<header id="header" class="line-bot" role="banner">
    <div class="container">
        <div class="header__inner">
            <h1 class="logo">
                <a href="../index.php"><img src="../assets/ico/logo/logo.svg" alt="logo"></a>
            </h1>
            <nav class="nav" role="navigation">
                <ul>
                    <li><a href="main.html">대회일정</a></li>
                    <li><a href="../aboutpage/about.php">마이페이지</a></li>
                    <li><a href="../aboutpage/about.php">어바웃</a></li>
                    <li><a href="../community-N/comm_notice.php">커뮤니티</a></li>
                </ul>
            </nav>
            <div class="member">
                <ul class="modal__inner">
                    <?php if(isset($_SESSION['memberID'])){?>
                        <li>
                            <button type="button" class="modal_btn"><?=$_SESSION['youNickName']."님";?></button>
                        </li>
                        <div class="modal">
                            <div class="modal_popup">
                                <span><em>닉네임</em> : <?= $_SESSION['youNickName']."님";?></span>
                                <p><em>이메일</em> : <?= $_SESSION['youEmail'];?></p>
                                <button type ="button" class="logout_btn">로그아웃
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 18C1.45 18 0.979333 17.8043 0.588 17.413C0.196667 17.0217 0.000666667 16.5507 0 16V2C0 1.45 0.196 0.979333 0.588 0.588C0.98 0.196667 1.45067 0.000666667 2 0H9V2H2V16H9V18H2ZM13 14L11.625 12.55L14.175 10H6V8H14.175L11.625 5.45L13 4L18 9L13 14Z" fill="#fff"/>
                                </svg>
                                </button>
                            </div>
                        </div>
                    <?php
                        }else {
                    ?>
                        <li><a href="../login/login.php">로그인</a>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</header>
<script src="../assets/js/modal.js"></script>
