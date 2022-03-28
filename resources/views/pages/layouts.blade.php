<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">
    <link rel="icon" href="{{ $favicon }}" type="image/x-icon">
    @yield('seo')
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/home/css/stellarnav.min.css')}}" />
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/home/fontawesome-free-6.0.0/css/all.min.css')}}" />
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/home/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/home/splide-3.6.9/dist/css/splide.min.css')}}" />
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/home/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/home/css/responsive.css')}}" />
    @yield('css')
</head>

<body>
    <header>
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ $logo }}" class="img-fluid" />
            </a>
        </div>
        <div class="stellarnav stellarnav-custom" id="nav-area">
            <div class="menu-search">
                <form action="{{ route('search') }}" onsubmit="return formSearchMobile()" method="GET">
                    <input class="form-control me-2" type="search" id="search-news-mobile" name="q" placeholder="Nhập từ khoá tìm kiếm..." />
                    <button class="btn text-white" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
           
            <ul>
                <li>
                    <a href="{{ url('/') }}"><i class="fa-solid fa-house"></i></a>
                </li>
                @include('pages.components.menu-item', [
                    'menus' => $menus,
                ])
            </ul>
        </div>
        <!-- .stellarnav -->
    </header>
    <main>
        <div class="container">
            <div class="d-flex bd-highlight align-items-center">
                <div class="py-2 bd-highlight">
                    <h2 class="date-time">{{ $time }}</h2>
                </div>
                <div class="ms-auto py-2 bd-highlight social-header">
                    <a href="{{ $social_facebook }}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                            <linearGradient id="Ld6sqrtcxMyckEl6xeDdMa" x1="9.993" x2="40.615" y1="9.993" y2="40.615"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#2aa4f4" />
                                <stop offset="1" stop-color="#007ad9" />
                            </linearGradient>
                            <title>Theo dõi trên Facebook</title>
                            <path fill="url(#Ld6sqrtcxMyckEl6xeDdMa)"
                                d="M24,4C12.954,4,4,12.954,4,24s8.954,20,20,20s20-8.954,20-20S35.046,4,24,4z" />
                            <path fill="#fff"
                                d="M26.707,29.301h5.176l0.813-5.258h-5.989v-2.874c0-2.184,0.714-4.121,2.757-4.121h3.283V12.46 c-0.577-0.078-1.797-0.248-4.102-0.248c-4.814,0-7.636,2.542-7.636,8.334v3.498H16.06v5.258h4.948v14.452 C21.988,43.9,22.981,44,24,44c0.921,0,1.82-0.084,2.707-0.204V29.301z" />
                        </svg>
                    </a>
                    <a href="{{ $social_youtube }}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                            <linearGradient id="PgB_UHa29h0TpFV_moJI9a" x1="9.816" x2="41.246" y1="9.871" y2="41.301"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#f44f5a" />
                                <stop offset=".443" stop-color="#ee3d4a" />
                                <stop offset="1" stop-color="#e52030" />
                            </linearGradient>
                            <title>Theo dõi trên Youtube</title>
                            <path fill="url(#PgB_UHa29h0TpFV_moJI9a)"
                                d="M45.012,34.56c-0.439,2.24-2.304,3.947-4.608,4.267C36.783,39.36,30.748,40,23.945,40	c-6.693,0-12.728-0.64-16.459-1.173c-2.304-0.32-4.17-2.027-4.608-4.267C2.439,32.107,2,28.48,2,24s0.439-8.107,0.878-10.56	c0.439-2.24,2.304-3.947,4.608-4.267C11.107,8.64,17.142,8,23.945,8s12.728,0.64,16.459,1.173c2.304,0.32,4.17,2.027,4.608,4.267	C45.451,15.893,46,19.52,46,24C45.89,28.48,45.451,32.107,45.012,34.56z" />
                            <path
                                d="M32.352,22.44l-11.436-7.624c-0.577-0.385-1.314-0.421-1.925-0.093C18.38,15.05,18,15.683,18,16.376	v15.248c0,0.693,0.38,1.327,0.991,1.654c0.278,0.149,0.581,0.222,0.884,0.222c0.364,0,0.726-0.106,1.04-0.315l11.436-7.624	c0.523-0.349,0.835-0.932,0.835-1.56C33.187,23.372,32.874,22.789,32.352,22.44z"
                                opacity=".05" />
                            <path
                                d="M20.681,15.237l10.79,7.194c0.689,0.495,1.153,0.938,1.153,1.513c0,0.575-0.224,0.976-0.715,1.334	c-0.371,0.27-11.045,7.364-11.045,7.364c-0.901,0.604-2.364,0.476-2.364-1.499V16.744C18.5,14.739,20.084,14.839,20.681,15.237z"
                                opacity=".07" />
                            <path fill="#fff"
                                d="M19,31.568V16.433c0-0.743,0.828-1.187,1.447-0.774l11.352,7.568c0.553,0.368,0.553,1.18,0,1.549	l-11.352,7.568C19.828,32.755,19,32.312,19,31.568z" />
                        </svg>
                    </a>
                </div>
                <div class="p-2 bd-highlight search-article">
                    <form class="d-flex" action="{{ route('search') }}" onsubmit="return formSearch()" method="GET">
                        <input class="form-control me-2" type="search" id="search-news" name="q" placeholder="Nhập từ khoá tìm kiếm..." />
                        <button class="btn" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>
            @yield('content')
        </div>
    </main>

    <footer>
        <div class="footer__banner">
            <img src="{{ asset('assets/home/img/banner/baner-footer.jpg') }}" class="img-fluid">
        </div>
        <div class="footer">
            <div class="container">
                <div class="logo-footer">
                    <a href="{{ url('/') }}">
                        <img src="{{ $logo }}" class="img-fluid">
                    </a>
                </div>
                <div class="footer-center">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="card fl-news">
                                <div class="card-body fl-news__content">
                                    <p class="card-text fl-news__content__info">Địa chỉ: {{ $website_address }}</p>
                                    <p class="card-text fl-news__content__info">Cơ quan chủ quản: Bộ CHQS tỉnh Bà Rịa -
                                        Vũng Tàu</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="card fr-news">
                                <div class="card-body fr-news__content">
                                    <p class="card-text fr-news__content__info">Chỉ đạo nội dung: Đảng uỷ - Bộ CHQS tỉnh
                                        Bà Rịa - Vũng Tàu</p>
                                    <p class="card-text fr-news__content__info">Email: {{ $website_email }}</p>
                                    <p class="card-text fr-news__content__info">Website: {{ $website_url }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer__end">
                    <p class="card-text">Giấy phép số :…/…/….</p>
                    <p class="card-text">Chỉ được phát hành lại thông tin từ website này khi có sự đồng ý bằng văn bản
                        của cơ quan Bộ CHQS tỉnh Bà Rịa Vũng Tàu</p>
                    <p class="card-text">Ghi rõ nguồn: "LLVT tỉnh Bà Rịa – Vũng Tàu" khi phát hành lại thông tin từ
                        website này</p>
                    <p class="card-text">Copyright &copy; {{ date('Y') }} Bản quyền thuộc Báo Lực Lượng Vũ Trang Bà Rịa - Vũng Tàu</p>
                </div>
            </div>
        </div>
    </footer>
    <a class="back-to-top"></a>
    <div id='arcontactus'></div>
    <script type="text/javascript" src="{{ asset('assets/home/js/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/home/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/home/splide-3.6.9/dist/js/splide.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/home/js/stellarnav.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/home/js/main.js')}}"></script>
    <script>
        function arCuGetCookie(t) {
            return document.cookie.length > 0 && (c_start = document.cookie.indexOf(t + "="), -1 != c_start) ? (c_start = c_start + t.length + 1,
                c_end = document.cookie.indexOf(";",
                    c_start), -1 == c_end && (c_end = document.cookie.length),
                unescape(document.cookie.substring(c_start,
                    c_end))) : 0
        }

        function arCuCreateCookie(t,
            e,
            s) {
            var n;
            if (s) {
                var i = new Date;
                i.setTime(i.getTime() + 24 * s * 60 * 60 * 1e3),
                    n = "; expires=" + i.toGMTString()
            } else n = "";
            document.cookie = t + "=" + e + n + "; path=/"
        }

        function arCuShowMessage(t) {
            if (arCuPromptClosed) return !1;
            void 0 !== arCuMessages[
                t
            ] ? (jQuery("#arcontactus").contactUs("showPromptTyping"),
                _arCuTimeOut = setTimeout(function() {
                        if (arCuPromptClosed) return !1;
                        jQuery("#arcontactus").contactUs("showPrompt", {
                                content: arCuMessages[
                                    t
                                ]
                            }),
                            t++,
                            _arCuTimeOut = setTimeout(function() {
                                    if (arCuPromptClosed) return !1;
                                    arCuShowMessage(t)
                                },
                                arCuMessageTime)
                    },
                    arCuTypingTime)) : (arCuCloseLastMessage && jQuery("#arcontactus").contactUs("hidePrompt"),
                arCuLoop && arCuShowMessage(0))
        }

        function arCuShowMessages() {
            setTimeout(function() {
                    clearTimeout(_arCuTimeOut),
                        arCuShowMessage(0)
                },
                arCuDelayFirst)
        }! function(t) {
            function e(s,
                n) {
                this._initialized = !1,
                    this.settings = null,
                    this.options = t.extend({},
                        e.Defaults,
                        n),
                    this.$element = t(s),
                    this.init(),
                    this.x = 0,
                    this.y = 0,
                    this._interval,
                    this._menuOpened = !1,
                    this._callbackOpened = !1,
                    this.countdown = null
            }
            e.Defaults = {
                    align: "left",
                    countdown: 0,
                    drag: !1,
                    buttonText: "Liên hệ",
                    buttonSize: "large",
                    menuSize: "normal",
                    items: [],
                    iconsAnimationSpeed: 1200,
                    theme: "#3ea61e",
                    buttonIcon: '<svg width="20" height="20" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Canvas" transform="translate(-825 -308)"><g id="Vector"><use xlink:href="#path0_fill0123" transform="translate(825 308)" fill="#FFFFFF"/></g></g><defs><path id="path0_fill0123" d="M 19 4L 17 4L 17 13L 4 13L 4 15C 4 15.55 4.45 16 5 16L 16 16L 20 20L 20 5C 20 4.45 19.55 4 19 4ZM 15 10L 15 1C 15 0.45 14.55 0 14 0L 1 0C 0.45 0 0 0.45 0 1L 0 15L 4 11L 14 11C 14.55 11 15 10.55 15 10Z"/></defs></svg>',
                    closeIcon: '<svg width="12" height="13" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Canvas" transform="translate(-4087 108)"><g id="Vector"><use xlink:href="#path0_fill" transform="translate(4087 -108)" fill="currentColor"></use></g></g><defs><path id="path0_fill" d="M 14 1.41L 12.59 0L 7 5.59L 1.41 0L 0 1.41L 5.59 7L 0 12.59L 1.41 14L 7 8.41L 12.59 14L 14 12.59L 8.41 7L 14 1.41Z"></path></defs></svg>'
                },
                e.prototype.init = function() {
                    this.destroy(),
                        this.settings = t.extend({},
                            this.options),
                        this.$element.addClass("arcontactus-widget").addClass("arcontactus-message"),
                        "left" === this.settings.align ? this.$element.addClass("left") : this.$element.addClass("right"),
                        this.settings.items.length ? (this._initCallbackBlock(),
                            this._initMessengersBlock(),
                            this._initMessageButton(),
                            this._initPrompt(),
                            this._initEvents(),
                            this.startAnimation(),
                            this.$element.addClass("active")) : console.info("jquery.contactus:no items"),
                        this._initialized = !0,
                        this.$element.trigger("arcontactus.init")
                },
                e.prototype.destroy = function() {
                    if (!this._initialized) return !1;
                    this.$element.html(""),
                        this._initialized = !1,
                        this.$element.trigger("arcontactus.destroy")
                },
                e.prototype._initCallbackBlock = function() {},
                e.prototype._initMessengersBlock = function() {
                    var e = t("<div>", {
                        class: "messangers-block"
                    });
                    "normal" !== this.settings.menuSize && "large" !== this.settings.menuSize || e.addClass("lg"),
                        "small" === this.settings.menuSize && e.addClass("sm"),
                        this._appendMessengerIcons(e),
                        this.$element.append(e)
                },
                e.prototype._appendMessengerIcons = function(e) {
                    t.each(this.settings.items,
                        function(s) {
                            if ("callback" == this.href) var n = t("<div>", {
                                class: "messanger call-back " + (this.class ? this.class : "")
                            });
                            else if (n = t("<a>", {
                                    class: "messanger " + (this.class ? this.class : ""),
                                    id: this.id ? this.id : null,
                                    href: this.href,
                                    target: this.target ? this.target : "_blank"
                                }),
                                this.onClick) {
                                var i = this;
                                n.on("click",
                                    function(t) {
                                        i.onClick(t)
                                    })
                            }
                            var a = t("<span>", {
                                style: this.color ? "background-color:" + this.color : null
                            });
                            a.append(this.icon),
                                n.append(a),
                                n.append("<p>" + this.title + "</p>"),
                                e.append(n)
                        })
                },
                e.prototype._initMessageButton = function() {
                    var e = this,
                        s = t("<div>", {
                            class: "arcontactus-message-button",
                            style: this._backgroundStyle()
                        });
                    "large" === this.settings.buttonSize && this.$element.addClass("lg"),
                        "medium" === this.settings.buttonSize && this.$element.addClass("md"),
                        "small" === this.settings.buttonSize && this.$element.addClass("sm");
                    var n = t("<div>", {
                        class: "static"
                    });
                    n.append(this.settings.buttonIcon), !1 !== this.settings.buttonText ? n.append("<p>" + this.settings.buttonText + "</p>") : s.addClass("no-text");
                    var i = t("<div>", {
                        class: "callback-state",
                        style: e._colorStyle()
                    });
                    i.append(this.settings.callbackStateIcon);
                    var a = t("<div>", {
                            class: "icons hide"
                        }),
                        o = t("<div>", {
                            class: "icons-line"
                        });
                    t.each(this.settings.items,
                            function(s) {
                                var n = t("<span>", {
                                    style: e._colorStyle()
                                });
                                n.append(this.icon),
                                    o.append(n)
                            }),
                        a.append(o);
                    var r = t("<div>", {
                        class: "arcontactus-close"
                    });
                    r.append(this.settings.closeIcon);
                    var c = t("<div>", {
                            class: "pulsation",
                            style: e._backgroundStyle()
                        }),
                        l = t("<div>", {
                            class: "pulsation",
                            style: e._backgroundStyle()
                        });
                    s.append(n).append(i).append(a).append(r).append(c).append(l),
                        this.$element.append(s)
                },
                e.prototype._initPrompt = function() {
                    var e = t("<div>", {
                            class: "arcontactus-prompt"
                        }),
                        s = t("<div>", {
                            class: "arcontactus-prompt-close",
                            style: this._colorStyle()
                        });
                    s.append(this.settings.closeIcon);
                    var n = t("<div>", {
                        class: "arcontactus-prompt-inner"
                    });
                    e.append(s).append(n),
                        this.$element.append(e)
                },
                e.prototype._initEvents = function() {
                    var e = this.$element,
                        s = this;
                    e.find(".arcontactus-message-button").on("mousedown",
                            function(t) {
                                s.x = t.pageX,
                                    s.y = t.pageY
                            }).on("mouseup",
                            function(t) {
                                t.pageX === s.x && t.pageY === s.y && (s.toggleMenu(),
                                    t.preventDefault())
                            }),
                        this.settings.drag && (e.draggable(),
                            e.get(0).addEventListener("touchmove",
                                function(t) {
                                    var s = t.targetTouches[
                                        0
                                    ];
                                    e.get(0).style.left = s.pageX - 25 + "px",
                                        e.get(0).style.top = s.pageY - 25 + "px",
                                        t.preventDefault()
                                }, !1)),
                        t(document).on("click",
                            function(t) {
                                s.closeMenu()
                            }),
                        e.on("click",
                            function(t) {
                                t.stopPropagation()
                            }),
                        e.find(".call-back").on("click",
                            function() {
                                s.openCallbackPopup()
                            }),
                        e.find(".callback-countdown-block-close").on("click",
                            function() {
                                null != s.countdown && (clearInterval(s.countdown),
                                        s.countdown = null),
                                    s.closeCallbackPopup()
                            }),
                        e.find(".arcontactus-prompt-close").on("click",
                            function() {
                                s.hidePrompt()
                            })
                },
                e.prototype.show = function() {
                    this.$element.addClass("active"),
                        this.$element.trigger("arcontactus.show")
                },
                e.prototype.hide = function() {
                    this.$element.removeClass("active"),
                        this.$element.trigger("arcontactus.hide")
                },
                e.prototype.openMenu = function() {
                    var t = this.$element;
                    t.find(".messangers-block").hasClass("show-messageners-block") || (this.stopAnimation(),
                        t.find(".messangers-block, .arcontactus-close").addClass("show-messageners-block"),
                        t.find(".icons, .static").addClass("hide"),
                        t.find(".pulsation").addClass("stop"),
                        this._menuOpened = !0,
                        this.$element.trigger("arcontactus.openMenu"))
                },
                e.prototype.closeMenu = function() {
                    var t = this.$element;
                    t.find(".messangers-block").hasClass("show-messageners-block") && (t.find(".messangers-block, .arcontactus-close").removeClass("show-messageners-block"),
                        t.find(".icons, .static").removeClass("hide"),
                        t.find(".pulsation").removeClass("stop"),
                        this.startAnimation(),
                        this._menuOpened = !1,
                        this.$element.trigger("arcontactus.closeMenu"))
                },
                e.prototype.toggleMenu = function() {
                    var t = this.$element;
                    if (this.hidePrompt(),
                        t.find(".callback-countdown-block").hasClass("display-flex")) return !1;
                    t.find(".messangers-block").hasClass("show-messageners-block") ? this.closeMenu() : this.openMenu(),
                        this.$element.trigger("arcontactus.toggleMenu")
                },
                e.prototype.openCallbackPopup = function() {
                    var t = this.$element;
                    t.addClass("opened"),
                        this.closeMenu(),
                        this.stopAnimation(),
                        t.find(".icons, .static").addClass("hide"),
                        t.find(".pulsation").addClass("stop"),
                        t.find(".callback-countdown-block").addClass("display-flex"),
                        this._callbackOpened = !0,
                        this.$element.trigger("arcontactus.openCallbackPopup")
                },
                e.prototype.closeCallbackPopup = function() {
                    var t = this.$element;
                    t.removeClass("opened"),
                        t.find(".messangers-block").removeClass("show-messageners-block"),
                        t.find(".arcontactus-close").removeClass("show-messageners-block"),
                        t.find(".icons, .static").removeClass("hide"),
                        this.startAnimation(),
                        this._callbackOpened = !1,
                        this.$element.trigger("arcontactus.closeCallbackPopup")
                },
                e.prototype.startAnimation = function() {
                    var t = this.$element,
                        e = t.find(".icons-line"),
                        s = t.find(".static"),
                        n = t.find(".icons-line>span:first-child").width() + 40;
                    if ("large" === this.settings.buttonSize) var i = 2,
                        a = 0;
                    "medium" === this.settings.buttonSize && (i = 4,
                            a = -2),
                        "small" === this.settings.buttonSize && (i = 4,
                            a = -2);
                    var o = t.find(".icons-line>span").length,
                        r = 0;
                    if (this.stopAnimation(),
                        0 === this.settings.iconsAnimationSpeed) return !1;
                    this._interval = setInterval(function() {
                            0 === r && (e.parent().removeClass("hide"),
                                s.addClass("hide"));
                            var t = "translate(" + -(n * r + i) + "px, " + a + "px)";
                            e.css({
                                    "-webkit-transform": t,
                                    "-ms-transform": t,
                                    transform: t
                                }),
                                ++r > o && (r > o + 1 && (r = 0),
                                    e.parent().addClass("hide"),
                                    s.removeClass("hide"),
                                    t = "translate(" + -i + "px, " + a + "px)",
                                    e.css({
                                        "-webkit-transform": t,
                                        "-ms-transform": t,
                                        transform: t
                                    }))
                        },
                        this.settings.iconsAnimationSpeed)
                },
                e.prototype.stopAnimation = function() {
                    clearInterval(this._interval);
                    var t = this.$element,
                        e = t.find(".icons-line"),
                        s = t.find(".static");
                    e.parent().addClass("hide"),
                        s.removeClass("hide");
                    var n = "translate(-2px, 0px)";
                    e.css({
                        "-webkit-transform": n,
                        "-ms-transform": n,
                        transform: n
                    })
                },
                e.prototype.showPrompt = function(t) {
                    var e = this.$element.find(".arcontactus-prompt");
                    t && t.content && e.find(".arcontactus-prompt-inner").html(t.content),
                        e.addClass("active"),
                        this.$element.trigger("arcontactus.showPrompt")
                },
                e.prototype.hidePrompt = function() {
                    this.$element.find(".arcontactus-prompt").removeClass("active"),
                        this.$element.trigger("arcontactus.hidePrompt")
                },
                e.prototype.showPromptTyping = function() {
                    this.$element.find(".arcontactus-prompt").find(".arcontactus-prompt-inner").html(""),
                        this._insertPromptTyping(),
                        this.showPrompt({}),
                        this.$element.trigger("arcontactus.showPromptTyping")
                },
                e.prototype._insertPromptTyping = function() {
                    var e = this.$element.find(".arcontactus-prompt-inner"),
                        s = t("<div>", {
                            class: "arcontactus-prompt-typing"
                        }),
                        n = t("<div>");
                    s.append(n),
                        s.append(n.clone()),
                        s.append(n.clone()),
                        e.append(s)
                },
                e.prototype.hidePromptTyping = function() {
                    this.$element.find(".arcontactus-prompt").removeClass("active"),
                        this.$element.trigger("arcontactus.hidePromptTyping")
                },
                e.prototype._backgroundStyle = function() {
                    return "background-color: " + this.settings.theme
                },
                e.prototype._colorStyle = function() {
                    return "color: " + this.settings.theme
                },
                t.fn.contactUs = function(s) {
                    var n = Array.prototype.slice.call(arguments,
                        1);
                    return this.each(function() {
                        var i = t(this),
                            a = i.data("ar.contactus");
                        a || (a = new e(this,
                                    "object" == typeof s && s),
                                i.data("ar.contactus",
                                    a)),
                            "string" == typeof s && "_" !== s.charAt(0) && a[
                                s
                            ].apply(a,
                                n)
                    })
                },
                t.fn.contactUs.Constructor = e
        }(jQuery);

        var arCuMessages = ["Xin chào"];
        var arCuLoop = false;
        var arCuCloseLastMessage = false;
        var arCuPromptClosed = false;
        var _arCuTimeOut = null;
        var arCuDelayFirst = 2000;
        var arCuTypingTime = 2000;
        var arCuMessageTime = 4000;
        var arCuClosedCookie = 0;
        var arcItems = [];
        window.addEventListener('load', function() {
            arCuClosedCookie = arCuGetCookie('arcu-closed');
            jQuery('#arcontactus').on('arcontactus.init', function() {
                if (arCuClosedCookie) {
                    return false;
                }
                arCuShowMessages();
            });
            jQuery('#arcontactus').on('arcontactus.openMenu', function() {
                clearTimeout(_arCuTimeOut);
                arCuPromptClosed = true;
                jQuery('#contact').contactUs('hidePrompt');
                arCuCreateCookie('arcu-closed', 1, 30);
            });
            jQuery('#arcontactus').on('arcontactus.hidePrompt', function() {
                clearTimeout(_arCuTimeOut);
                arCuPromptClosed = true;
                arCuCreateCookie('arcu-closed', 1, 30);
            });

            var arcItem = {};
            arcItem.id = 'msg-item-9';
            arcItem.class = 'msg-item-youtube';
            arcItem.title = 'Youtube';
            arcItem.icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>';
            arcItem.href = '{{ $social_youtube }}';
            arcItem.color = '#f44336';
            arcItems.push(arcItem);

            var arcItem = {};
            arcItem.id = 'msg-item-10';
            arcItem.class = 'msg-item-facebook';
            arcItem.title = 'Facebook';
            arcItem.icon = '<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50"><path fill="currentColor" d="M25,3C12.85,3,3,12.85,3,25c0,11.03,8.125,20.137,18.712,21.728V30.831h-5.443v-5.783h5.443v-3.848c0-6.371,3.104-9.168,8.399-9.168c2.536,0,3.877,0.188,4.512,0.274v5.048h-3.612c-2.248,0-3.033,2.131-3.033,4.533v3.161h6.588l-0.894,5.783h-5.694v15.944C38.716,45.318,47,36.137,47,25C47,12.85,37.15,3,25,3z"/></svg>';
            arcItem.href = '{{ $social_facebook }}';
            arcItem.color = '#239def';
            arcItems.push(arcItem);

            jQuery('#arcontactus').contactUs({
                items: arcItems
            });
        });

    </script>
    @yield('js')
</body>

</html>