<header id="header" role="banner">
            <div class="container">
                <div class="header__inner">
                    <div class="logo">
                        <a href="main.html"><img src="../assets/ico/wrm_nav_rogo.svg" alt="로고"></a>
                    </div>
                    <nav class="nav">
                        <ul>
                            <li><a href="information.html">대회일정</a>
                                <ul class="submenu">
                                    <li><a href="information.html">전체</a></li>
                                    <li><a href="#">마라톤</a></li>
                                    <li><a href="#">플로깅</a></li>
                                </ul>
                            </li>
                            <li><a href="#">커뮤니티</a>
                                <ul class="submenu">
                                    <li><a href="#">커뮤</a></li>
                                    <li><a href="#">커뮤</a></li>
                                    <li><a href="#">커뮤</a></li>
                                </ul>
                            </li>
                            <li><a href="#">게시판</a></li>
                            <li><a href="#">마이페이지</a></li>
                        </ul>
                    </nav>
                    <div class="member">
                    <?php if(isset($_SESSION['memberID'])){ ?>
                            <ul>
                                <li class="active">
                                    <a href="../signin/signout.php">
                                        <?=$_SESSION['youNickName']?>님.
                                    </a>
                                </li>
                            </ul>
                    <?php } else { ?>
                        <ul>
                            <li><a href="../login/logsign.php">로그인</a></li>
                        </ul>
                    <?php } ?>
                    </div>
                </div>
                <!-- //header__inner -->
            </div>
        </header>
        <!-- //header -->