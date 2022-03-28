@extends('pages.layouts')
@section('seo')
    {!! SEOMeta::generate() !!}

    <!-- Facebook -->
    {!! OpenGraph::generate() !!}

    <!-- Twitter -->
    {!! Twitter::generate() !!}
@endsection
@section('css')

@endsection
@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
        <div class="search-article-page">
            <form class="d-flex py-2" action="{{ route('search') }}" onsubmit="return formSearchPage()" method="GET">
                <input class="form-control" type="search" id="search-news-page" name="q" value="{{ request()->query('q') }}" placeholder="Nhập từ khoá tìm kiếm...">
                <button class="btn" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>
    @if (count($news))
        @foreach ($news as $new)
        <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
            <div class="card search-news">
                <a href="{{ route('news', ['slug' => $new->slug, 'id' => $new->id]) }}">
                    <div class="card-header search-news__title">
                        <h4 class="text-truncate-2-lines">
                            {{ $new->title }}
                        </h4>
                    </div>
                    <div class="row g-0">
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="search-news__thumbnail">
                                <img src="{{ $new->thumbnail }}">
                            </div>
                        </div>
                        <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                            <div class="card-body search-news__content">
                                <p class="card-text search-news__des text-truncate-3-lines">
                                    {{ $new->description }}
                                </p>
                                <p class="card-text search-news__time">
                                    <small class="text-muted">{{ $new->created_at->diffForHumans() }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>    
        @endforeach
        <div class="fn__detail">
            <div class="d-flex align-items-center bd-highlight">
                <div class="py-2 bd-highlight">
                    <div class="fn__detail__pagination">
                        {{ $news->appends(['q' => request()->query('q')])->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    @else
        <p class="card-text"><strong>Không tìm thấy kết quả chứa từ khóa của bạn</strong></p>
    @endif
</div>
@endsection

@section('js')

@endsection