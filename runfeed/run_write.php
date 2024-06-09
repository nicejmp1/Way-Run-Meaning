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
                        <form action="run_writeSave.php" name="run_writeSave" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <legend class="blind">게시글 작성하기</legend>
                                <div>
                                    <label for="feedCate" class="blind">카테고리</label>
                                    <select name="feedCate" id="feedCate">
                                        <option value="popular">일상</option>
                                        <option value="new">추천&공유</option>
                                        <option value="my">자랑</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="feedTitle" class="blind">제목</label>
                                    <input type="text" id="feedTitle" name="feedTitle" placeholder="제목을 적어주세요!"
                                        class="input-style" required>
                                </div>
                                <div>
                                    <label for="feedCont" class="blind">내용</label>
                                    <textarea name="feedCont" id="feedCont" placeholder="내용을 적어주세요!"></textarea>
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
    </div>
    <!-- //wrap -->

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