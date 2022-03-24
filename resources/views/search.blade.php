@extends('layout')
@section('content')
<div class="col-md-6 posts-hot">
    <div class="card  posts-hot-content" style="height: auto;">
        @if (isset($article_search_represent))
        <div class="posts-title">
            <h1>Kết quả tìm kiếm bài viết: {{$key_word}}</h1>
        </div>
        <div class="card hot-news">
            <a href="{{URL::to('/'.$article_search_represent->code.'-'.$article_search_represent->id.'.html')}}" class="card-link">
                <img data-src="{{URL::to('public/uploads/new/'.$article_search_represent->thumbnail)}}" class="lazyload card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title" style="text-align: justify;">{{$article_search_represent->name}}</h5>
                    <p class="card-text" style="text-align: justify;">{{$article_search_represent->shortdescription}}</p>
                </div>
            </a>
        </div>
        @else
        <div class="posts-title">
            <h1>Kết quả tìm kiếm bài viết: {{$key_word}}</h1>
        </div>
            Không tìm thấy bài viết: {{$key_word}}
        @endif
        
        
    </div>
    @if (isset($article_search))
    @foreach ($article_search as $key => $result)
    <div class="card article-category">
        <a href="{{URL::to('/'.$result->code.'-'.$result->id.'.html')}}">
            <div class="row g-0">
                <div class="col-md-4">
                    <img data-src="{{URL::to('public/uploads/new/'.$result->thumbnail)}}" class="lazyload card-img-top" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$result->name}}</h5>
                        <p class="card-text" style="text-align: justify;">{{$result->shortdescription}}</p>
                        <p class="card-text"><small class="text-muted"><?php echo date_format(date_create($result->created_at), "H:i d/m/Y"); ?></small></p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
    <div class="pagination-block">
        {{$article_search->links('layouts.paginationlinks')}}
    </div>
    @endif
</div>
@endsection