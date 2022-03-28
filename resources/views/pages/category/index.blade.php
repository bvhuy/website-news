@extends('pages.layouts')

@section('seo')
    {!! SEOMeta::generate() !!}

    <!-- Facebook -->
    {!! OpenGraph::generate() !!}

    <!-- Twitter -->
    {!! Twitter::generate() !!}

    {!! JsonLdMulti::generate() !!}
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [{
                "@type": "ListItem",
                 "position": 1,
                "item":{
                    "@id": "{{ url($categories->pluck('slug')->implode('/')) }}",
                    "name": "{{ $categories->pluck('name')->implode('/') }}"
                }
             }]
        }
    </script>
@endsection

@section('css')
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
        @if (isset($category))
        <div class="card category-tl-news">
            <div class="card-header category-tl-news__topic">
                <h2><a title="{{  $category->name }}" href="{{ $category->slug }}">{{  $category->name }}</a></h2>
                <div class="category-tl-news__other">
                    @if (count($category->descendants))
                        @foreach ($category->descendants as $subcategory_item)
                        <h4><a title="{{ $subcategory_item->name }}" href="{{ $subcategory_item->ancestorsAndSelf($subcategory_item->id)->pluck('slug')->implode('/') }}">{{ $subcategory_item->name }}</a></h4>
                        @endforeach
                    @endif
                </div>
              
            </div>
            @if (isset($news_first))
            <a title="{{ $news_first->title }}" href="{{ route('news', ['slug' => $news_first->slug, 'id' => $news_first->id]) }}" class="category-tl-news__link">
                <div class="row g-0">
                    <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                        <div class="category-tl-news__thumbnail">
                            <img alt="{{ $news_first->title }}" src="{{ $news_first->thumbnail }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="card-body category-tl-news__content">
                            <h2 class="card-title category-tl-news__title text-truncate-3-lines">{{ $news_first->title }}</h2>
                            <p class="card-text category-tl-news__des text-truncate-5-lines">{{ $news_first->description }}</p>
                            <p class="card-text category-tl-news__time">
                                <small class="text-muted"> {{ $news_first->created_at->diffForHumans() }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            @endif
        </div>
        @endif
        <div class="card category-tlb-news">
            <div class="splide-wrapper site__category__tlb__news">
                <div id="category-tlb-news__slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @if (count($news_slider))
                                @foreach ($news_slider as $new_slider)
                                <li title="{{ $new_slider->title }}" class="splide__slide">
                                    <div class="splide__slide__container">
                                        <img alt="{{ $new_slider->title }}" src="{{ $new_slider->thumbnail }}" />
                                    </div>
                                    <div class="splide__slide__content">
                                        <a title="{{ $new_slider->title }}" href="{{ route('news', ['slug' => $new_slider->slug, 'id' => $new_slider->id]) }}">
                                            <div class="card-body category-tlb-news__content">
                                                <h3 class="card-title category-tlb-news__title text-truncate-3-lines">
                                                    {{ $new_slider->title }}
                                                </h3>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if (count($news_left))
                @foreach ($news_left as $new_left)
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="card category-cl-news">
                        <a title="{{ $new_left->title }}" href="{{ route('news', ['slug' => $new_left->slug, 'id' => $new_left->id]) }}" class="category-cl-news__link">
                            <div class="card-header category-cl-news__title">
                                <h4 class="text-truncate-2-lines">
                                    {{ $new_left->title }}
                                </h4>
                            </div>
                            <div class="row g-0 d-flex align-items-center">
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="category-cl-news__thumbnail">
                                        <img alt="{{ $new_left->title }}" src="{{ $new_left->thumbnail }}">
                                    </div>
                                </div>
                                <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                                    <div class="card-body category-cl-news__content">
                                        <p class="card-text category-cl-news__des text-truncate-3-lines">
                                            {{ $new_left->description }}
                                        </p>
                                        <p class="card-text category-cl-news__time">
                                            <small class="text-muted">{{ $new_left->created_at->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            @endif
           
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4" id="news-rt__sidebar">
        <div class="card category-tr-news">
            <div class="row">
                @if (count($news_right))
                    @foreach ($news_right as $new_right)
                    <div class="col-12 col-sm-12 col-md-6 col-lg-12 col-xl-12 col-xxl-12">
                        <a title="{{ $new_right->title }}" href="{{ route('news', ['slug' => $new_right->slug, 'id' => $new_right->id]) }}" class="category-tr-news__link">
                            <div class="card-header category-tr-news__title">
                                <h4 class="text-truncate">{{ $new_right->title }}</h4>
                            </div>
                            <div class="row g-0 d-flex align-items-center">
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="category-tr-news__thumbnail">
                                        <img alt="{{ $new_right->title }}" src="{{ $new_right->thumbnail }}">
                                    </div>
                                </div>
                                <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                                    <div class="card-body category-tr-news__content">
                                        <p class="card-text category-tr-news__des text-truncate-3-lines">{{ $new_right->description }}</p>
                                        <p class="card-text category-tr-news__time"><small class="text-muted">{{ $new_right->created_at->diffForHumans() }}</small></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('assets/home/js/ResizeSensor.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/home/js/theia-sticky-sidebar.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/home/js/category/app.js')}}"></script>
@endsection