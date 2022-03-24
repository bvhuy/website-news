<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>{{$title}}</title>
    <meta name="robots" content="index,follow,all">
    <meta name="description" content="{{$meta_description}}" />
    <meta name="keywords" content="{{$meta_keywords}}" />
    <meta name="title" content="{{$meta_title}}" />
    <link rel="canonical" href="{{$canonical}}" />

    <meta name="copyright" content="Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu" />
    <meta name="author" content="Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu" />

    <link href="/favicon.ico" type="image/x-icon" rel="shortcut icon" />
    
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{asset('public/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/responsive.css')}}">
    @yield('css')
</head>

<body>
    <div class="menu-desktop">
        <div class="top-bar">
            <nav class="navbar h-100">
                <div class="container">
                    <a class="navbar-brand" href="{{URL::to('/')}}">
                        <img src="{{URL::to('public/img/logo123.png')}}" alt="">
                    </a>
                </div>
            </nav>
        </div>
        <div class="menu-bg-color" id="menu-bg-color">
            <div class="container-fluid">
                <tr>
                    <td colspan="2">
                        <div class="menu-wrapper">
                            <ul class="menu">
                                <li><a href="{{URL::to('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                                @foreach ($category_nav as $key => $category) 
                                <li>
                                    <a href="{{URL::to('/'.$category->code)}}">{{$category->name}}</a>
                                    <ul>
                                        @foreach ($type_category_nav as $key => $type_category)
                                            @if ($category->id == $type_category->category_id)
                                                @foreach ($type_nav as $key => $type)
                                                    @if ($type->id == $type_category->type_id)
                                                    <li><a href="{{URL::to('/'.$category->code.'/'.$type->code)}}">{{$type->name}}</a></li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>        
                                @endforeach
                            </ul>
                        </div>
                    </td>
                </tr>
            </div>
        </div>
    </div>
    <div class="menu-mobile">
        <menu class="menubar">
            <menuitem>
            <button class="menu-trigger"> <i class="material-icons">menu</i> </button>
            </menuitem>
            <menuitem class="logo" title="Your Logo Goes Here">
            <a href="{{URL::to('/')}}"><img src="{{URL::to('public/img/logo123.png')}}" alt="jSide Menu" /> </a>
            </menuitem>
        </menu>
        <div class="menu-body visibility">
            <nav class="menu-container">
                <div class="aside-item">
                    <form action="{{route('web.search')}}" onsubmit="return checkNullMobi()" class="d-block position-relative">
                        <input class="d-inline-block form-control" type="search" name="query" value="{{old('query')}}" id="input_search_mobi" placeholder="Tìm kiếm..." aria-label="Tìm kiếm">
                        <button class="btn position-absolute top-0 end-0 bottom-0" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
                <ul class="menu-items">
                    @foreach ($category_nav as $key => $category) 
                    <li class="has-sub">
                       
                        
                        <span class="dropdown-heading" 
                        @foreach ($nav_category_mobi as $key => $nav_mobi)
                        @if($nav_mobi->id == $category->id ) onclick="location='{{URL::to('/'.$category->code)}}'" @endif
                        @endforeach
                        
                        
                        >{{$category->name}}</span>
                        
                        
                        <ul>
                            @foreach ($type_category_nav as $key => $type_category)
                            @if ($category->id == $type_category->category_id)
                            @foreach ($type_nav as $key => $type)
                            @if ($type->id == $type_category->type_id)
                            <li><a href="{{URL::to('/'.$category->code.'/'.$type->code)}}">{{$type->name}}</a></li>
                            @endif
                            @endforeach
                            @endif
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
    <main class="header-home">
        <div class="container">
            <div class="header-home-bg">
                <div class="row">
                    <div class="col-md-9">
                        <div class="header-home-left">
                            <div class="header-date">
                                <span>{{$time}} - Email: llvtbrvt@gmail.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-search-input">
                            <form action="{{route('web.search')}}" onsubmit="return checkNullDes()" class="d-block position-relative">
                                <input class="d-inline-block" type="search" name="query" value="{{old('query')}}" id="input_search_des" autocomplete="off" placeholder="Tìm kiếm..." aria-label="Tìm kiếm">
                                <button class="btn position-absolute top-0 end-0 bottom-0" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="new-top">
                <div class="row">
                    @yield('content')
                    <div class="col-md-3 posts-new-view">
                        <div class="card" >
                            <ul class="nav nav-pills" role="tablist">
                                <li class="btn-posts-new-view nav-item" role="presentation">
                                    <button class="btn-posts-new active" id="tab-posts-view-show" data-bs-target="#tab-posts-new" data-bs-toggle="pill" type="button" role="tab" aria-controls="tab-posts-new" aria-selected="true"><h6>Nổi bật</h6></button>
                                </li>
                                <li class="btn-posts-new-view nav-item" role="presentation">
                                    <button class="btn-posts-view" id="tab-posts-view-show" data-bs-target="#tab-posts-view" data-bs-toggle="pill" type="button" role="tab" aria-controls="tab-posts-view" aria-selected="false"><h6>Xem Nhiều</h6></button>
                                </li>
                            </ul>
                            <div class="card posts-content tab-content" id="posts-content">
                                <div class="tab-pane fade show active" id="tab-posts-new" role="tabpanel" aria-labelledby="tab-posts-view-show">
                                    @foreach ($post_featured as $key => $result)
                                    <div class="posts-content-link">
                                        <a href="{{URL::to('/'.$result->code.'-'.$result->id.'.html')}}">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{$result->name}}</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="tab-pane fade" id="tab-posts-view" role="tabpanel" aria-labelledby="tab-posts-view-show">
                                    @foreach ($post_viewed_more as $key => $result)
                                    <div class="posts-content-link">
                                        <a href="{{URL::to('/'.$result->code.'-'.$result->id.'.html')}}">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{$result->name}}</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 posts-today">  
                        <div class="card posts-today-content">
                            <div class="posts-title-right">
                                <h1>Lời bác dạy ngày này năm xưa</h1>
                            </div>
                            <div class="owl-carousel owl-theme slider-right-top">
                                @foreach ($video as $key => $result)
                                <div class="card" style="border: 1px solid #d0d8d8;">
                                    <div class="fixed-video-aspect">
                                        <div class="item-video" data-merge="1">
                                            <a class="owl-video" href="https://www.youtube.com/watch?v={{ $result->code }}"></a>   
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $result->name }}</h5>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="posts-title-right">
                                <h1>Sự kiện lịch sử</h1>
                            </div>
                            <div class="owl-carousel owl-carousel-slider slider-right-second">
                                @foreach ($post_historic_events as $key => $result)
                                    <div class="card">
                                        <a href="{{URL::to('/'.$result->code.'-'.$result->id.'.html')}}" class="card-link-slider">
                                            <div class="img-slider">
                                                <img src="{{URL::to('public/uploads/new/'.$result->thumbnail)}}" alt="{{ $result->name }}">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $result->name }}</h5>
                                                <p class="card-text">{{ $result->shortdescription }}</p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('custom-content')
        </div>
    </main>
    <div class="banner-image">
        <img src="{{URL::to('public/img/baner-footer.jpg')}}" class="" alt="">
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <a href="{{URL::to('/')}}">
                    <img src="{{URL::to('public/img/logo123.png')}}" class="w-100" alt="...">
                </a>
                <div class="col-md-6 footer-left">
                    <div class="card">
                        
                        <div class="card-body">
                            <p class="card-text">Lực lượng vũ trang tỉnh Bà Rịa - Vũng Tàu.</p>
                            <p class="card-text">Địa chỉ: 1279A, Hùng Vương, ấp Bắc 3, xã Hoà Long, TP.Bà Rịa, tỉnh Bà Rịa - Vũng Tàu.</p>
                            <p class="card-text">Cơ quan chủ quản: Bộ CHQS tỉnh Bà Rịa - Vũng Tàu</p>
                            <p class="card-text">Giấy phép số :…/…/….</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 footer-right">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Chỉ đạo nội dung: Đảng uỷ - Bộ CHQS tỉnh Bà Rịa - Vũng Tàu</p>
                            <p class="card-text">Email: llvtbrvt@gmail.com</p>
                            <p class="card-text">Website: www.lucluongvutrangbrvt.vn</p>
                            <p class="card-text">Chỉ được phát hành lại thông tin từ website này khi có sự đồng ý bằng văn bản của cơ quan Bộ CHQS tỉnh Bà Rịa Vũng Tàu.Ghi rõ nguồn: "LLVT tỉnh Bà Rịa – Vũng Tàu" khi phát hành lại thông tin từ website này.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div id='arcontactus'></div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{asset('public/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/js/main.js')}}"></script>
    <script src="{{asset('public/js/owl.carousel.custom.js')}}"></script>
    <script src="{{asset('public/js/lazyload.js')}}"></script>
    @yield('js')
    <script>
        // slider-right-top
        $(".slider-right-top").owlCarousel({
            items: 1,
            merge: true,
            margin: 1,
            video: false,
            center: true,
            nav: true,
            dots: false,
            navText: ["<img src='{{ URL::to('public/img/icon/left-arrow.png') }}'>","<img src='{{ URL::to('public/img/icon/right-arrow.png') }}'>"],
            onTranslate: function() {
                $('.owl-item.active').find('iframe').each(function() {
                    $('.owl-item.active .owl-video-play-icon').remove();
                });
            }
        });
        // End slider-right-top
    </script>
</body>

</html>