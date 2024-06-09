document.addEventListener('DOMContentLoaded', function () {
    // 팝업창 엘리먼트를 가져옵니다.
    const popup = document.querySelector('.badge__popup');

    // 모든 .openPopup 요소들을 가져옵니다.
    const openPopupElements = document.querySelectorAll('.openPopup');

    // 각각의 .openPopup 요소에 클릭 이벤트 리스너를 추가합니다.
    openPopupElements.forEach(element => {
        element.addEventListener('click', function (event) {
            event.preventDefault();
            popup.style.display = 'flex'; // 팝업창을 표시합니다.
        });
    });

    // .close__btn 요소를 가져옵니다.
    const closeBtn = document.querySelector('.close__btn');

    // .close__btn 요소에 클릭 이벤트 리스너를 추가합니다.
    closeBtn.addEventListener('click', function () {
        popup.style.display = 'none'; // 팝업창을 숨깁니다.
    });
});