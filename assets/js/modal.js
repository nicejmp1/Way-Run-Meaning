document.addEventListener('DOMContentLoaded', function () {
    const modalBtn = document.querySelector('.modal_btn');
    const modal__inner = document.querySelector('.modal__inner');
    const modal = document.querySelector('.modal');
    const logoutBtn = document.querySelector('.logout_btn');

    console.log(modalBtn, modal, logoutBtn); // 각 변수가 제대로 참조되었는지 확인

    if (modalBtn && modal && logoutBtn) {
        modalBtn.addEventListener('click', function () {
            console.log('모달 버튼 클릭'); // 클릭 이벤트 확인
            modal.style.display = 'block';
        });


        // 모달 배경 클릭 시 모달 닫기
        window.onclick = function (event) {
            if (!modal__inner.contains(event.target)) { // 클릭된 요소가 modal__inner의 자식이 아닐 때
                console.log('모달 밖 클릭'); // 외부 클릭 이벤트 확인
                modal.style.display = 'none';
            }
        };

        logoutBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            console.log('로그아웃 버튼 클릭'); // 로그아웃 버튼 클릭 이벤트 확인
        });
    } else {
        console.log('필요한 요소 중 하나가 존재하지 않습니다.'); // 요소 선택 실패 시 로깅
    }
});

document.querySelector('.logout_btn').addEventListener('click', function () {
    fetch('../login/logout.php') // 로그아웃 처리 스크립트 경로
        .then(response => {
            if (response.ok) {
                window.location.href = '../index.php'; // 로그아웃 성공 시 메인 페이지로 리다이렉트
            } else {
                alert('로그아웃에 실패했습니다.');
            }
        })
        .catch(error => console.error('Error logging out:', error));
});

