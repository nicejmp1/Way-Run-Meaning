
document.addEventListener('DOMContentLoaded', function () {
    const modalBtn = document.querySelector('.modal_btn');
    const modal__inner = document.querySelector('.modal__inner');
    const modal = document.querySelector('.modal');
    const logoutBtn = document.querySelector('.logout_btn');

    // 버튼과 모달 요소의 존재 여부를 확인
    if (modalBtn && modal && modal__inner && logoutBtn) {
        modalBtn.addEventListener('click', function () {
            modal.style.display = 'block';
        });

        // 모달 배경 클릭 시 모달 닫기 이벤트를 추가
        window.addEventListener('click', function (event) {
            if (event.target === modal && !modal__inner.contains(event.target)) {
                modal.style.display = 'none';
            }
        });

        logoutBtn.addEventListener('click', function () {
            fetch('../login/logout.php')
                .then(response => {
                    if (response.ok) {
                        window.location.href = '../index.php';
                    } else {
                        alert('로그아웃에 실패했습니다.');
                    }
                })
                .catch(error => console.error('Error logging out:', error));
        });
    } else {
        console.log('필요한 요소 중 하나가 존재하지 않습니다. 이벤트 핸들러를 추가하지 않습니다.');
    }
});
