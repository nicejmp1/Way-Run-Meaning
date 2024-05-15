// 양쪽 링크가 바뀌는 스크립트

document.addEventListener('DOMContentLoaded', function () {
    function setTransitionDuration(elements, duration) {
        elements.forEach(function (element) {
            element.style.transitionDuration = duration;
        });
    }

    let leftLinks = document.querySelectorAll('.post__left');
    let rightLinks = document.querySelectorAll('.post__right');

    setTransitionDuration(leftLinks, '0.3s');
    setTransitionDuration(rightLinks, '0.3s');

    leftLinks.forEach(function (leftLink, index) {
        let rightLink = rightLinks[index]; // 같은 인덱스의 오른쪽 링크

        leftLink.addEventListener('mouseover', function () {
            // 왼쪽 링크 호버 시
            this.style.backgroundColor = 'var(--mainColor)';
            this.querySelector('a').style.color = '#fff';
            this.querySelector('.svg-path').setAttribute('fill', '#fff'); // 왼쪽 SVG 색상 변경

            // 오른쪽 링크 반대 색상
            rightLink.style.backgroundColor = '#FF4409';
            rightLink.querySelector('a').style.color = '#fff';
            rightLink.querySelector('.svg-path').setAttribute('fill', '#fff'); // 오른쪽 SVG 색상 변경
        });

        leftLink.addEventListener('mouseout', function () {
            // 왼쪽 링크 마우스 아웃 시 원래대로 복원
            this.style.backgroundColor = '';
            this.querySelector('a').style.color = '';
            this.querySelector('.svg-path').setAttribute('fill', '#FF4409'); // 왼쪽 SVG 원래 색상

            // 오른쪽 링크 원래대로 복원
            rightLink.style.backgroundColor = '';
            rightLink.querySelector('a').style.color = '';
            rightLink.querySelector('.svg-path').setAttribute('fill', '#FAF1E7'); // 오른쪽 SVG 원래 색상
        });
    });

    rightLinks.forEach(function (rightLink, index) {
        let leftLink = leftLinks[index]; // 같은 인덱스의 왼쪽 링크

        rightLink.addEventListener('mouseover', function () {
            // 오른쪽 링크 호버 시
            this.style.backgroundColor = 'var(--mainColor)';
            this.querySelector('a').style.color = '#fff';
            this.querySelector('.svg-path').setAttribute('fill', '#fff'); // 오른쪽 SVG 색상 변경

            // 왼쪽 링크 반대 색상
            leftLink.style.backgroundColor = 'var(--pointColor)';
            leftLink.querySelector('a').style.color = '#fff';
            leftLink.querySelector('.svg-path').setAttribute('fill', '#fff'); // 왼쪽 SVG 색상 변경
        });

        rightLink.addEventListener('mouseout', function () {
            // 오른쪽 링크 마우스 아웃 시 원래대로 복원
            this.style.backgroundColor = '';
            this.querySelector('a').style.color = '';
            this.querySelector('.svg-path').setAttribute('fill', '#FAF1E7'); // 오른쪽 SVG 원래 색상

            // 왼쪽 링크 원래대로 복원
            leftLink.style.backgroundColor = '';
            leftLink.querySelector('a').style.color = '';
            leftLink.querySelector('.svg-path').setAttribute('fill', '#FF4409'); // 왼쪽 SVG 원래 색상
        });
    });
});
