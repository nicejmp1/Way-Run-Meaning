<header id="header" class="line-bot" role="banner">
            <div class="container">
                <div class="header__inner">
                    <h1 class="logo">
                        <a href="../index.php"><img src="../assets/ico/logo/logo.svg" alt="logo"></a>
                    </h1>
                    <nav class="nav" role="navigation">
                        <ul>
                            <li><a href="main.html">대회일정</a></li>
                            <li><a href="../community-N/comm_notice.php">커뮤러닝</a></li>
                            <li><a href="#">런피드</a></li>
                            <li><a href="#">런뉴스</a></li>
                        </ul>
                    </nav>
                    <div class="member">
                        <ul>
                            <?
                                if(isset($_SESSION['memberID'])){
                            ?>
                                <li><a href="../login/logout.php"><?=$_SESSION['youNickName'];?></a></li>
                            <?
                                }else {
                            ?>
                                <li><a href="../login/login.php">로그인</a>
                                <li><a href="../signup/signupInsert.php">회원가입</a>
                            <?
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </header>