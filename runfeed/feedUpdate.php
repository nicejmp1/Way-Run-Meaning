<?php 
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    if(isset($_GET['feedID'])){
        $feedID = intval($_GET['feedID']);
        $memberID = $_SESSION['memberID']; // 세션에서 회원 ID 가져오기

        // 게시글 조회 및 작성자 확인
        $sql = "SELECT * FROM feed WHERE feedID = ?";
        $stmt = $connect -> prepare($sql);
        $stmt -> bind_param("i", $feedID);
        $stmt -> execute();
        $result = $stmt -> get_result();

        if($result -> num_rows > 0){
            $row = $result -> fetch_assoc();
            
            // 현재 로그인한 사용자가 게시글 작성자인지 확인
            if($memberID == $row['memberID']){
                // 여기서 게시글 수정 작업을 진행하면 됩니다.
                // 예를 들어, 게시글 내용을 출력하여 수정할 수 있게 합니다.
            } else {
                echo "<script>alert('권한이 없습니다. 자신의 게시글만 수정할 수 있습니다.'); history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('존재하지 않는 게시글입니다. 관리자에게 문의하세요.'); history.back();</script>";
            exit;
        }

        $stmt -> close();
        $connect -> close();
    } else {
        echo "<script>alert('잘못된 접근입니다. 관리자에게 문의하세요'); history.back();</script>";
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
                    <h1 class="title01">런피드 글작성</h1>
                </div>
                <!-- //feed__title -->

                <div class="left">
                    <div class="feed__write">
                        <form action="feedUpdateSave.php" name="run_writeSave" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <legend class="blind">게시글 작성하기</legend>
                                <input type="hidden" name="feedID" value="<?php echo $row['feedID'] ?>">
                                <div>
                                    <label for="feedCate" class="blind">카테고리</label>
                                    <select name="feedCate" id="feedCate">
                                        <option value="popular" <?php if ($row['feedCate'] == '일상') echo 'selected'; ?>>일상</option>
                                        <option value="new" <?php if ($row['feedCate'] == '추천&공유') echo 'selected'; ?>>추천&공유</option>
                                        <option value="my" <?php if ($row['feedCate'] == '자랑') echo 'selected'; ?>>자랑</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="feedTitle" class="blind">제목</label>
                                    <input type="text" id="feedTitle" name="feedTitle" placeholder="제목을 적어주세요!"
                                        class="input-style" value="<?php echo $row['feedTitle'] ?>" required>
                                </div>
                                <div>
                                    <label for="feedCont" class="blind">내용</label>
                                    <textarea name="feedCont" id="feedCont" placeholder="내용을 적어주세요!"><?php echo $row['feedCont'] ?></textarea>
                                </div>
                                <div class="file">
                                    <label for="feedFile" class="blind">파일</label>
                                    <input type="file" id="feedFile" name="feedFile">
                                    <p>* jpg, gif, png, webp 파일만 넣을 수 있습니다. 이미지 용량은 1MB를 넘길 수 없습니다.</p>
                                </div>
                                <div class="btn">
                                    <button type="submit" class="btn-style">저장하기</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <!-- //feed__write -->
                </div>

            </div>
            <!-- //container -->
        </main>
        <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/translations/ko.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#feedCont'), {
                language: 'ko'
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>