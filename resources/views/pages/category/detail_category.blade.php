@extends('layout')
@section('content')
<div class="col-md-6 posts-hot">
    <div class="card posts-hot-content" style="height: auto;">
        <div class="posts-title">
            <h1><a href="{{URL::to('/'.$get_category_id->code)}}">{{$get_category_id->name}}</a></h1>
        </div>
        <div class="card hot-news">
            <a href="{{URL::to('/'.$article_represent_by_category->code.'-'.$article_represent_by_category->id.'.html')}}" class="card-link">
                <img data-src="{{URL::to('public/uploads/new/'.$article_represent_by_category->thumbnail)}}" class="lazyload card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$article_represent_by_category->name}}</h5>
                    <p class="card-text">{{$article_represent_by_category->shortdescription}}</p>
                </div>
            </a>
        </div>
    </div>
    @foreach ($article_by_category as $key => $result)
    <div class="card article-category">
        <a href="{{URL::to('/'.$result->code.'-'.$result->id.'.html')}}">
            <div class="row g-0">
                <div class="col-md-4">
                    <img data-src="{{URL::to('public/uploads/new/'.$result->thumbnail)}}" class="lazyload card-img-top" alt="...">
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
    <div class="pagination-block">
        {{$article_by_category->links('layouts.paginationlinks')}}
    </div>
</div>
@endsection