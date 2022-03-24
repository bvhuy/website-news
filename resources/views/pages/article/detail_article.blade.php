@extends('layout')
@section('css')
<div id="fb-root"></div>
@endsection
@section('content')
<div class="col-md-6 posts-hot post-article">
    <div class="card posts-hot-content">
        <div class="posts-title-detail">
            <div class="category-article">
                <a href="{{URL::to('/'.$category_with_new_id->code)}}">{{$category_with_new_id->name}}</a>
            </div>
            <div class="social-and-view">
                <div class="zalo-share-button" data-href="{{$canonical}}" data-oaid="579745863508352884" data-layout="1" data-color="blue" data-customize="false"></div>
                <div class="fb-share-button" data-href="{{$canonical}}" data-layout="button" data-size="small">
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$canonical}}" class="fb-xfbml-parse-ignore">Chia sẻ</a>
                </div>
                <span class="article-view"><i class="fa fa-eye" aria-hidden="true"></i> {{$article->view_count}} lượt xem</span>
            </div>
        </div>
        <div class="card card-content-articles hot-news">
            <div class="card-body">
                <h5 class="card-title">{{$article->name}}</h5>
                {!!$article->content!!}
                <p class="card-text"><small class="text-muted"><?php echo date_format(date_create($article->created_at), "H:i d/m/Y"); ?></small></p>
                <p class="card-text text-capitalize" style="text-align: right"><b>{{$article->created_by}}</b></p>
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
                    <h1><a href="">Đọc thêm</a></h1>
                </div>
                <div class="row new-type-header">
                    <div class="col-md-6">
                        @foreach ($related_articles as $key => $result)
                            <div class="card article-category posts-related">
                                <a href="{{URL::to('/'.$result->code.'-'.$result->id.'.html')}}">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img class="lazyload card-img-top" data-src="{{URL::to('public/uploads/new/'.$result->thumbnail)}}" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title" style="text-align: justify;">{{$result->name}}</h5>
                                                <p class="card-text" style="text-align: justify;">{{$result->shortdescription}}</p>
                                                <p class="card-text"><small class="text-muted"><?php echo date_format(date_create($result->created_at), "H:i d/m/Y"); ?></small></p>
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
@endsection
@section('js')
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0" nonce="E0H92S1l"></script>
<script src="https://sp.zalo.me/plugins/sdk.js"></script>
@endsection