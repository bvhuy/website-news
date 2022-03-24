@extends('layout')
@section('content')
<div class="col-md-6 posts-hot">
    <div class="card posts-hot-content">
        <div class="posts-title">
            <h1>Tin hôm nay</h1>
        </div>
        <div class="card">
            <a href="{{URL::to('/'.$post_today_one->code.'-'.$post_today_one->id.'.html')}}" class="card-link">
                <div class="thum-posts thum-posts-hot">
                    <div class="thumb-layout">
                        <div class="thumb-container">
                            <img class="lazyload" data-src="{{URL::to('public/uploads/new/'.$post_today_one->thumbnail)}}" class="card-img-top " alt="{{$post_today_one->name}}">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$post_today_one->name}}</h5>
                    <p class="card-text" style="text-align: justify;">{{$post_today_one->shortdescription}}</p>
                </div>
            </a>
            <div class="row posts-hot-slide">
                <div class="owl-carousel owl-carousel-slider slider">
                    @foreach ($post_today_slide as $key => $result)
                    <div class="card">
                        <a href="{{URL::to('/'.$result->code.'-'.$result->id.'.html')}}" class="card-link-slider">
                            <div class="img-slider">
                                <img src="{{URL::to('public/uploads/new/'.$result->thumbnail)}}" alt="{{ $result->name }}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $result->name }}</h5>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-content')
<div class="new-type">
    <div class="row">
        <div class="col-md-12 new-type-main">
            <div class="card new-type-first">
                <div class="posts-title">
                    <h1><a href="">Thời Sự Tổng Hợp</a></h1>
                </div>
                <div class="row new-type-header">
                    <div class="col-md-6 new-type-header-left">
                        <div class="card">
                            <a href="{{URL::to('/'.$post_news_one->code.'-'.$post_news_one->id.'.html')}}" class="card-link">
                                <div class="thum-posts thumb-rep-synthetic-news">
                                    <div class="thumb-layout">
                                        <div class="thumb-container">
                                            <img class="lazyload" data-src="{{URL::to('public/uploads/new/'.$post_news_one->thumbnail)}}" class="card-img-top" alt="...">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{$post_news_one->name}}</h5>
                                    <p class="card-text" style="text-align: justify;">{{$post_news_one->shortdescription}}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 new-type-header-right">
                        <div class="card new-type-header-right-first">
                            @foreach ($post_news as $key => $result)
                            <div class="card">
                                <a href="{{URL::to('/'.$result->code.'-'.$result->id.'.html')}}" class="card-link">
                                    <div class="card-syn-related-news">
                                        <div class="row g-0">   
                                            <div class="col-md-5">
                                                <div class="thum-posts thumb-synthetic-news">
                                                    <div class="thumb-layout">
                                                        <div class="thumb-container">
                                                            <img class="lazyload" data-src="{{URL::to('public/uploads/new/'.$result->thumbnail)}}" class="card-img-top" alt="...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$result->name}}</h5>
                                                    <p class="card-text">{{$result->shortdescription}}</p>
                                                    <p class="card-text"><small class="text-muted"><?php echo date_format(date_create($result->created_at), "H:i d/m/Y"); ?></small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection