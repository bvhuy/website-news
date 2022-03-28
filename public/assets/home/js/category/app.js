// Splite js
document.addEventListener("DOMContentLoaded", function() {
    var splide = new Splide("#category-tlb-news__slider", {
        type: 'loop',
        autoplay: true,
        interval: 2000,
        gap: 10,
        perPage: 3,
        pagination: false,
        cover: true,
        height: "10rem",
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
        },
    });

    splide.mount();
});

// End Splite js

//Siderbar
$(document).ready(function() {
    $('#news-rt__sidebar')
        .theiaStickySidebar({
            additionalMarginTop: 40
        });
});
//End sidebar