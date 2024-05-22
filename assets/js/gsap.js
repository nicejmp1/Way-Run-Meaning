const targets = gsap.utils.toArray(".split");

targets.forEach((target) => {
    let SplitClient = new SplitType(target, { type: "lines, words, chars" });
    let lines = SplitClient.lines;
    let words = SplitClient.words;
    let chars = SplitClient.chars;

    gsap.from(words, {
        xPercent: -200,
        autoAlpha: 0,
        duration: 2,
        ease: "Elastic.easeInOut",
        stagger: {
            amount: 2,
            from: "words"
        }
    })
})


gsap.from(".post.rank1",
    {
        duration: 1,
        autoAlpha: 0,
        y: 100,
        borderRadius: 100,

        scrollTrigger: {
            trigger: ".main__info__post.rank",
            markers: false,
            start: "top 50%",
        }
    })

gsap.from(".post.rank2",
    {
        duration: 2,
        autoAlpha: 0,
        y: 200,
        borderRadius: 100,

        scrollTrigger: {
            trigger: ".main__info__post.rank",
            markers: false,
            start: "top 50%"
        }
    })

gsap.from(".post.rank3",
    {
        duration: 3,
        autoAlpha: 0,
        y: 300,
        borderRadius: 100,

        scrollTrigger: {
            trigger: ".main__info__post.rank",
            markers: false,
            start: "top 50%"
        }
    })

gsap.from(".crew__rank1",
    {
        duration: 1,
        autoAlpha: 0,
        y: 100,

        scrollTrigger: {
            trigger: ".main__crew__rank",
            markers: false,
            start: "top 80%",
        }
    })


gsap.from(".crew__rank2",
    {
        duration: 1,
        autoAlpha: 0,
        y: 200,

        scrollTrigger: {
            trigger: ".main__crew__rank",
            markers: false,
            start: "top 80%",
        }
    })


gsap.from(".crew__rank3",
    {
        duration: 1,
        autoAlpha: 0,
        y: 300,

        scrollTrigger: {
            trigger: ".main__crew__rank",
            markers: false,
            start: "top 80%",
        }
    })


gsap.from(".crew__rank4",
    {
        duration: 1,
        autoAlpha: 0,
        y: 400,
        scrollTrigger: {
            trigger: ".main__crew__rank",
            markers: false,
            start: "top 80%",
        }
    })