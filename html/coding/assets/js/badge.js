document.addEventListener('DOMContentLoaded', function () {
    const popup = document.querySelector('.badge__popup');
    const closeBtn = document.querySelector('.close__btn');

    // 팝업 열기 함수
    function openPopup() {
        popup.style.display = 'flex';
    }

    // 팝업 닫기 함수
    function closePopup() {
        popup.style.display = 'none';
    }

    // 닫기 버튼 클릭 이벤트 핸들러
    closeBtn.addEventListener('click', closePopup);

    // 임시로 팝업을 열기 위한 테스트 코드
    // 실제로는 특정 조건이나 이벤트에 따라 openPopup()을 호출하면 됩니다.
    // 예: 특정 버튼 클릭 시 팝업 열기
    // document.querySelector('.open-popup-btn').addEventListener('click', openPopup);
    openPopup();  // 초기 로드 시 팝업을 열기 위한 테스트 호출
});