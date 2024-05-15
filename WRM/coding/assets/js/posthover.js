document.addEventListener('DOMContentLoaded', function () {
    function setTransitionDuration(elements, duration) {
        elements.forEach(function (element) {
            element.style.transitionDuration = duration;
        });
    }

    let leftLinks = document.querySelectorAll('.post__left');
    let rightLinks = document.querySelectorAll('.post__right');

    setTransitionDuration(leftLinks, '0.5s');
    setTransitionDuration(rightLinks, '0.5s')

    leftLinks.forEach(function (link) {
        link.addEventListener('mouseover', function () {
            this.style.backgroundColor = 'var(--mainColor)';
            this.querySelector('a').style.color = '#fff';
            this.querySelector('.svg-path').setAttribute('fill', '#fff'); // SVG 색상 변경
        });
        link.addEventListener('mouseout', function () {
            this.style.backgroundColor = '';
            this.querySelector('a').style.color = '';
            this.querySelector('.svg-path').setAttribute('fill', '#FF4409'); // SVG 색상 변경
        });
    });

    // 오른쪽 링크
    rightLinks.forEach(function (link) {

        link.addEventListener('mouseover', function () {
            this.style.backgroundColor = 'var(--mainColor)';
            this.querySelector('a').style.color = '#fff';
            this.querySelector('.svg-path').setAttribute('fill', '#fff'); // SVG 색상 변경
        });
        link.addEventListener('mouseout', function () {
            this.style.backgroundColor = '';
            this.querySelector('a').style.color = '';
            this.querySelector('.svg-path').setAttribute('fill', '#FF4409'); // SVG 색상 변경
        });
    });
});