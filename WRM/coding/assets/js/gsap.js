const targets = gsap.utils.toArray(".split");

targets.forEach((target) => {
    let SplitClient = new SplitType(target, { type: "lines, words, chars" });
    let lines = SplitClient.lines;
    let words = SplitClient.words;
    let chars = SplitClient.chars;

    gsap.from(chars, {
        xPercent: -200,
        autoAlpha: 0,
        duration: 2,
        ease: "Elastic.easeInOut",
        stagger: {
            amount: 2,
            from: "chars"
        }
    })
})


gsap.from("#rank__post1",
    {
        duration: 1,
        autoAlpha: 0,
        y: 100,
        borderRadius: 100,

        scrollTrigger: {
            trigger: ".main__rank__post",
            markers: false,
            start: "top 50%",
        }
    })

gsap.from("#rank__post2",
    {
        duration: 2,
        autoAlpha: 0,
        y: 200,
        borderRadius: 100,

        scrollTrigger: {
            trigger: ".main__rank__post",
            markers: false,
            start: "top 50%"
        }
    })

gsap.from("#rank__post3",
    {
        duration: 3,
        autoAlpha: 0,
        y: 300,
        borderRadius: 100,

        scrollTrigger: {
            trigger: ".main__rank__post",
            markers: false,
            start: "top 50%"
        }
    })

gsap.from(".crew__rank1",
    {
        duration: 1,
        autoAlpha: 0,
        x: innerWidth * 1,
        y: -600,
        rotation: 360,

        scrollTrigger: {
            trigger: ".main__crew__rank",
            markers: true,
            start: "top 50%",
        }
    })


gsap.from(".crew__rank2",
    {
        duration: 2,
        autoAlpha: 0,
        x: innerWidth * 1,
        y: -600,
        rotation: 360,

        scrollTrigger: {
            trigger: ".main__crew__rank",
            markers: true,
            start: "top 50%",
        }
    })


gsap.from(".crew__rank3",
    {
        duration: 3,
        autoAlpha: 0,
        x: innerWidth * 1,
        y: -600,
        rotation: 360,

        scrollTrigger: {
            trigger: ".main__crew__rank",
            markers: true,
            start: "top 50%",
        }
    })


gsap.from(".crew__rank4",
    {
        duration: 4,
        autoAlpha: 0,
        x: innerWidth * 1,
        y: -600,
        rotation: 360,

        scrollTrigger: {
            trigger: ".main__crew__rank",
            markers: true,
            start: "top 50%",
        }
    })