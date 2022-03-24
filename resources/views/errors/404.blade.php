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
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/responsive.css')}}">
    <style>
        .error-template {
            padding: 40px 15px;
            text-align: center;
        }
        .error-template h1 {
            color: #3ea61e;
            font-size: 10em;
        }
        .error-details p {
            margin: 30px 0 !important;
            font-size: 17px
        }
        .error-actions {
            margin-top:15px;
            margin-bottom:15px;
        }
        .error-actions .btn-green { 
            background: #3ea61e; color: #fff; 
        }
    </style>
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
                            @endforeach>{{$category->name}}
                        </span>        
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
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-template">
                        <h1>404</h1>
                        <h2>không tìm thấy đường dẫn này</h2>
                        <div class="error-details">
                        <p>Xin lỗi, đã xảy ra lỗi, không tìm thấy trang được yêu cầu!</p>
                        </div>
                        <div class="error-actions">
                            <a href="{{URL::to('/')}}" class="btn btn-green btn-lg">
                                <i class="fa fa-home" aria-hidden="true"></i> Trang chủ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/js/main.js')}}"></script>
</body>
</html>