//StellarNav
jQuery(document).ready(function($) {
    jQuery(".stellarnav").stellarNav({
        theme: "custom",
        breakpoint: 1024,
        position: "left",
        menuLabel: false,
        closeBtn: false,
        closeLabel: false,
    });
});
//End StellarNav

//Menu fixed
window.addEventListener("scroll", function() {
    var nav = document.getElementById("nav-area");
    if (window.pageYOffset > 50) {
        nav.classList.add("is-fixed");
    } else {
        nav.classList.remove("is-fixed");
    }
});
//End Menu fixed

// Back to top
var btn = $('.back-to-top');
$(window).scroll(function() {
    if ($(window).scrollTop() > 100) {
        btn.addClass('show');
    } else {
        btn.removeClass('show');
    }
});

btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({
        scrollTop: 0
    }, '100');
});
// End back to top

function formSearch() {
    if (document.getElementById("search-news").value.trim() == '') {
        document.getElementById("search-news").focus();
        return !1
    }
}

function formSearchPage() {
    if (document.getElementById("search-news-page").value.trim() == '') {
        document.getElementById("search-news-page").focus();
        return !1
    }
}

function formSearchMobile() {
    if (document.getElementById("search-news-mobile").value.trim() == '') {
        document.getElementById("search-news-mobile").focus();
        return !1
    }
}