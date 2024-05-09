const ani2 = gsap.timeline();

ani2.from(".main__sub__post .post1", { y: -100, autoAlpha: 0, borderRadius: 200 }, 'a')
    .from(".main__sub__post .post2", { y: 100, autoAlpha: 0, borderRadius: 200 }, '+=2')
    .from(".main__sub__post .post3", { y: -100, autoAlpha: 0, borderRadius: 200 }, 'a')
    .from(".main__sub__post .i4", { y: 100, autoAlpha: 0, borderRadius: 200 }, 'b')

ScrollTrigger.create({
    animation: ani2,
    trigger: ".main__sub__post",
    start: "top top",
    end: "+=700",
    scrub: true,
    pin: true,
    anticipatePin: 1,
    markers: false
});