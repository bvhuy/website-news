// Splite js
document.addEventListener("DOMContentLoaded", function() {
    var main = new Splide('#main-slider', {
        heightRatio: 0.5625,
        cover: true,
        pagination: false,
        video: {
            loop: true,
        },
    });
    // var main = new Splide("#main-slider", {
    //     type: "fade",
    //     rewind: true,
    //     pagination: false,
    //     arrows: false,
    // });

    var thumbnails = new Splide("#thumbnail-slider", {
        // type: 'loop',
        // autoplay: true,
        fixedWidth: 100,
        fixedHeight: 60,
        gap: 10,
        rewind: true,
        pagination: false,
        cover: true,
        focus: "center",
        isNavigation: true,
        dragMinThreshold: {
            mouse: 4,
            touch: 10,
        },
        breakpoints: {
            600: {
                fixedWidth: 60,
                fixedHeight: 44,
            },
        },
    });

    main.sync(thumbnails);
    main.mount(window.splide.Extensions);
    thumbnails.mount();

    var splide = new Splide("#image-slider", {
        type: 'loop',
        autoplay: true,
        interval: 2000,
        gap: 10,
        perPage: 3,
        pagination: false,
        cover: true,
        height: "7rem",
        lazyLoad: "nearby",
        breakpoints: {
            280: {
                perPage: 2,
                height: "6rem",
            },
            320: {
                perPage: 2,
                height: "7rem",
            },
            414: {
                perPage: 2,
                height: "8rem",
            },
            540: {
                perPage: 3,
                height: "8rem",
            },
            768: {
                perPage: 3,
                height: "10rem",
            },
            1280: {
                perPage: 3,
                height: "8rem",
            },
        },
    });

    splide.mount();
});
// End Splite js