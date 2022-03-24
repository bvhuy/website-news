@extends('layout')
@section('content')
<div class="col-md-6 posts-hot">
    <div class="card posts-hot-content">
        <div class="posts-title">
            <h1><a href="{{URL::to('/'.$get_category_id->code.'/'.$get_type_id->code)}}">{{$get_type_id->name}}</a></h1>
        </div>
        <div class="card hot-news">
            <a href="{{URL::to('/'.$article_by_type_belong_to_category_represent->code.'-'.$article_by_type_belong_to_category_represent->id.'.html')}}" class="card-link">
                <img data-src="{{URL::to('public/uploads/new/'.$article_by_type_belong_to_category_represent->thumbnail)}}" class="lazyload card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$article_by_type_belong_to_category_represent->name}}</h5>
                    <p class="card-text">{{$article_by_type_belong_to_category_represent->shortdescription}}</p>
                </div>
            </a>
        </div>
        @foreach ($article_by_type_belong_to_category as $key => $result)
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
            {{$article_by_type_belong_to_category->links('layouts.paginationlinks')}}
        </div>
    </div>
</div>
@endsection