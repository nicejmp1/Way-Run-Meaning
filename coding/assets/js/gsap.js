
gsap.registerPlugin(ScrollTrigger);

gsap.timeline({
    scrollTrigger: {
        trigger: ".main__crew__rank",
        start: "top top", // 시작 지점: .container가 뷰포트 상단에 닿을 때
        end: "+=1000", // 종료 지점: 시작점으로부터 3000px 아래에서
        scrub: true,
        pin: ".main__crew", // .main__crew 요소를 고정
        anticipatePin: 1,
        markers: true // 개발 시 위치 확인을 위한 마커 표시
    }
})
    .from(".crew__rank .crew1", { autoAlpha: 0, borderRadius: 200 }, 'a')
    .from(".crew__rank .crew2", { autoAlpha: 0, borderRadius: 200 }, '+=2')
    .from(".crew__rank .crew3", { autoAlpha: 0, borderRadius: 200 }, 'a')
    .from(".crew__rank .crew4", { autoAlpha: 0, borderRadius: 200 }, 'b');

