<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // 댓글 가져오기
    $boardID = $_GET['boardID'];
    $commentSql = "SELECT c.* FROM boardReply c JOIN members m ON c.memberID = m.memberID WHERE c.boardID = {$boardID} ORDER BY c.commentTime DESC";
    $commentResult = $connect->query($commentSql);
    $comments = [];
    if ($commentResult->num_rows > 0) {
        while ($commentRow = $commentResult->fetch_array()) {
            $comments[] = [
                'commentID' => $commentRow['commentID'],
                'commentName' => $commentRow['commentName'],
                'commentText' => $commentRow['commentText'],
                'commentTime' => date('Y.m.d H:i', $commentRow['commentTime']),
                'memberID' => $commentRow['memberID']
            ];
        }
    }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>WayRunMeaning : 러닝 & 마라톤 - 공지사항</title>
    <?php include "../include/head.php"; ?>
</head>

<body>
<div id="wrap">
    <?php include "../include/header.php"; ?>

    <main id="main" role="main">
        <div class="container">
            <div class="main__comm">
                <p class="title02">
                    COMMU<br />
                    RUNNING
                </p>
                <h1 class="title01">마라톤 커뮤니티</h1>
            </div>
            <!-- //main__community -->

            <div class="comm__inner">
                <div class="comm__view">
                    <table>
                        <colgroup>
                            <col style="width: 20%" />
                            <col style="width: 80%" />
                        </colgroup>
                        <tbody>
<?php
    // 보드뷰 + 1
    $sql = "UPDATE board SET boardView = boardView + 1 WHERE boardID = {$boardID}";
    $connect->query($sql);

    // 데이터 가져오기
    $sql = "SELECT b.boardTitle, m.youNickName, b.regTime, b.boardView, b.boardContents FROM board b JOIN members m ON(b.memberID = m.memberID) WHERE b.boardID = {$boardID}";
    $result = $connect->query($sql);

    if ($result) {
        $info = $result->fetch_array(MYSQLI_ASSOC);

        echo "<tr><th>제목</th><td>" . $info['boardTitle'] . "</td></tr>";
        echo "<tr><th>등록자</th><td>" . $info['youNickName'] . "</td></tr>";
        echo "<tr><th>등록일</th><td>" . date('Y-m-d', $info['regTime']) . "</td></tr>";
        echo "<tr><th>조회수</th><td>" . $info['boardView'] . "</td></tr>";
        echo "<tr><th>내용</th><td>" . $info['boardContents'] . "</td></tr>";
    }
?>
                        </tbody>
                    </table>
                    <div class="btn_03">
                        <a href="comm_modify.php?boardID=<?=$_GET['boardID']?>" class="btn__01">수정하기</a>
                        <a href="comm_delete.php?boardID=<?=$_GET['boardID']?>" class="btn__02" onclick="return confirm('정말 삭제하시겠습니까?')">삭제하기</a>
                        <a href="comm_notice.php" class="btn__03">목록보기</a>
                    </div>
                </div>
            </div>
            <!-- //board__inner -->

            <section class="board__reply">
                <h4>댓글 달기</h4>
                <div class="comment">
                    <?php if (count($comments) > 0) { ?>
                        <?php foreach ($comments as $comment) { ?>
                            <div class="comment__view">
                                <div class="text">
                                    <span>
                                        <span class="author"><?php echo $comment['commentName']; ?></span> /
                                        <span class="date"><?php echo $comment['commentTime']; ?></span>
                                        <!-- 댓글 쓴 사람의 memberID와 세션의 memberID -->
                                        <?php if ($_SESSION['memberID'] == $comment['memberID']) { ?>
                                            <span class="upde">
                                                <a href="#" class="update" data-commentID="<?php echo $comment['commentID']; ?>">[수정]</a>
                                                <a href="#" class="delete" data-commentID="<?php echo $comment['commentID']; ?>">[삭제]</a>
                                            </span>
                                        <?php } ?>
                                    </span>
                                    <div class="reple"><?php echo $comment['commentText']; ?></div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="comment__view no-comment">
                            <div class="text">
                                <p>아직 등록된 댓글이 없습니다.</p>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="comment__input">
                        <form id="commentForm">
                            <input type="hidden" name="boardID" value="<?php echo $boardID; ?>">
                            <div>
                                <label for="commentText" class="blind">댓글</label>
                                <input type="text" id="commentText" name="commentText" placeholder="댓글을 입력해주세요!" required>
                            </div>
                            <div class="btn">
                                <button type="submit" class="btn-style">댓글 쓰기</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <!-- //blog__comments -->
        </div>
    </main>
    <!-- //main -->
    <?php include "../include/footer.php"; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        // 댓글 쓰기
        document.querySelector("#commentForm").addEventListener('submit', function(e){
            e.preventDefault();

            let formData = new FormData(this);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../boardReply-N/commentSave.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    try {
                        let response = JSON.parse(xhr.responseText);

                        if (response.status === 'success') {
                            alert(response.message);
                            location.reload();  // 페이지 새로고침하여 댓글 목록 업데이트
                        } else {
                            alert(response.message);
                        }
                    } catch (e) {
                        alert('로그인 후 작성이 가능합니다.');
                    }
                } else {
                    alert('서버와의 통신에 실패했습니다. 관리자에게 문의하세요!');
                }
            };
            xhr.send(formData);
        });

        // 삭제 버튼 처리
        document.querySelectorAll('.comment__view .delete').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                if (confirm('정말 삭제하시겠습니까?')) {
                    let commentID = this.getAttribute('data-commentID');
                    let formData = new FormData();
                    formData.append('commentID', commentID);

                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', '../boardReply-N/commentDelete.php', true);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            try {
                                let response = JSON.parse(xhr.responseText);

                                if (response.status === 'success') {
                                    alert(response.message);
                                    location.reload();
                                } else {
                                    alert(response.message);
                                }
                            } catch (e) {
                                alert('로그인 후 삭제가 가능합니다.');
                            }
                        } else {
                            alert('서버와의 통신에 실패했습니다.');
                        }
                    };
                    xhr.send(formData);
                }
            });
        });

        // 댓글 수정
        document.querySelectorAll('.comment__view .update').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                let commentID = this.getAttribute('data-commentID');
                let commentDiv = this.closest('.comment__view');
                let commentText = commentDiv.querySelector('.reple');
                let originalText = commentText.textContent.trim();
                let updeSpan = commentDiv.querySelector('.upde');

                // 이미 수정 모드인지 확인
                if (commentDiv.querySelector('.edit')) {
                    return; // 이미 수정 모드일 때는 아무 동작도 하지 않음
                }

                // 수정, 삭제 버튼을 포함한 span 숨기기
                updeSpan.style.display = 'none';

                commentText.innerHTML = `<input type="text" class="edit" value="${originalText}" required><button class="save">저장</button><button class="cancel">취소</button>`;

                // 저장 기능
                commentDiv.querySelector(".save").addEventListener("click", function() {
                    let updateText = commentDiv.querySelector(".edit").value.trim();

                    if (updateText) {
                        let formData = new FormData();
                        formData.append('commentID', commentID);
                        formData.append('commentText', updateText);

                        let xhr = new XMLHttpRequest();
                        xhr.open('POST', '../boardReply-N/commentUpdate.php', true);
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                try {
                                    let response = JSON.parse(xhr.responseText);

                                    if (response.status === 'success') {
                                        alert(response.message);
                                        location.reload();
                                    } else {
                                        alert(response.message);
                                    }
                                } catch (e) {
                                    alert('로그인 후 수정이 가능합니다.');
                                }
                            } else {
                                alert('서버와의 통신에 실패했습니다.');
                            }
                        };
                        xhr.send(formData);

                    } else {
                        alert("댓글을 입력해주세요.");
                    }
                });

                // 취소 기능
                commentDiv.querySelector(".cancel").addEventListener("click", function() {
                    commentText.innerHTML = originalText;

                    // 수정, 삭제 버튼을 포함한 span 다시 표시
                    updeSpan.style.display = 'inline';
                });
            });
        });
    });
</script>
</body>
</html>
