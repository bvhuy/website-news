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
            "@context" : "http://schema.org", 
            "@type" : "WebSite", 
            "name" : "{{ $website_name }}", 
            "alternateName" : "{{ $home_description }}", 
            "url": "{{ route('index') }}", 
            "potentialAction": { 
                "@type": "SearchAction", 
                "target": "{{ route('search') }}?q={q}", 
                "query-input": "required name=q" 
            } 
        } 
    </script>
    <script type="application/ld+json"> { 
        "@context": "https://schema.org", 
        "@type": "Organization", 
        "name": "{{ $website_name }}", 
        "url": "{{ route('index') }}", 
        "logo": "{{ $logo }}", 
        "foundingDate": "2020", 
        "founders": [ 
            { 
                "@type": "Person", 
                "name": "{{ $website_name }}" 
            } 
        ],
        "address": [ 
            {
             "@type": "PostalAddress", 
             "streetAddress": "{{ $website_address }}", 
             "addressLocality": "{{ $website_address }}", 
             "addressRegion": "Southeast",
              "postalCode": "78200", 
              "addressCountry": "VNM" 
            } 
        ], 
        "contactPoint": [ 
            { 
                "@type": "ContactPoint", 
                "telephone": "{{ $website_phone }}", 
                "contactType": "customer service" 
            }
        ], 
        "sameAs": [ 
            "{{ $social_facebook }}", 
            "{{ $social_youtube }}"
        ] } 
</script>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/home/splide-3.6.9/videos/splide-extension-video.min.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 col-xxl-6">
        <div class="card today-news">
            <div class="card-header today-news__topic">
                <h2><a href="">Tin hôm nay</a></h2>
            </div>
            @if (isset($news_today))
            <a title="{{ $news_today->title }}" href="{{ route('news', ['slug' => $news_today->slug, 'id' => $news_today->id]) }}">
                <div class="today-news__thumbnail">
                    <img alt="{{ $news_today->title }}" src="{{ isset($news_today->thumbnail) ? $news_today->thumbnail :  asset('assets/admin/images/70x70no-thumbnail.png')}}" />
                </div>
                <div class="card-body today-news__content">
                    <h2 class="card-title today-news__title">
                        {{ $news_today->title }}
                    </h2>
                    <p class="card-text today-news__des">
                       {{ $news_today->description }}
                    </p>
                </div>
            </a>
            @endif
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 col-xxl-3">
        <div class="card hotview-news">
            <div class="card-body hotview-news__top">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active hotnews__topic" id="nav-hotnews-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-hotnews" type="button" role="tab" aria-controls="nav-hotnews"
                        aria-selected="true">
                        <h2>Nổi bật</h2>
                    </button>
                    <button class="nav-link viewnews__topic" id="nav-viewnews-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-viewnews" type="button" role="tab" aria-controls="nav-viewnews"
                        aria-selected="false">
                        <h2>Xem nhiều</h2>
                    </button>
                </div>
            </div>
            <div class="tab-content hotview-news__content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-hotnews" role="tabpanel"
                    aria-labelledby="nav-hotnews-tab">
                    <ul class="list-group list-group-flush">
                        @if (count($news_hot))
                            @foreach ($news_hot as $new_hot)
                            <li class="list-group-item">
                                <div class="hotview-news__link">
                                    <h2 class="text-truncate-2-lines">
                                        <a title="{{ $new_hot->title }}" href="{{ route('news', ['slug' => $new_hot->slug, 'id' => $new_hot->id]) }}">{{ $new_hot->title }}</a>
                                    </h2>
                                </div>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="tab-pane fade" id="nav-viewnews" role="tabpanel"
                    aria-labelledby="nav-viewnews-tab">
                    <ul class="list-group list-group-flush">
                        @if (count($news_view_more))
                            @foreach ($news_view_more as $new_view_more)
                            <li class="list-group-item">
                                <div class="hotview-news__link">
                                    <h2 class="text-truncate-2-lines">
                                        <a title="{{ $new_view_more->title }}" href="{{ route('news', ['slug' => $new_view_more->slug, 'id' => $new_view_more->id]) }}">{{ $new_view_more->title }}</a>
                                    </h2>
                                </div>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
        @if (isset($category_video_top))
            <div class="card rt-news">
                <div class="card-header rt-news__topic">
                    <h2><a href="javascript:;">{{ $category_video_top->name }}</a></h2>
                </div>
                @if (count($videos))
                <div id="main-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">                           
                            @foreach ($videos as $video_main)
                            <li title="{{ $video_main->title }}" class="splide__slide" data-splide-youtube="{{ $video_main->url }}">
                                <div class="splide__slide__container">
                                    <img alt="{{ $video_main->title }}" src="{{ $video_main->thumbnail }}">
                                </div>
                                <div class="card-body rt-news__content">
                                    <h2 class="card-title rt-news__title text-truncate-2-lines">
                                        {{ $video_main->title }}
                                    </h2>
                                </div>
                            </li>
                            @endforeach                          
                        </ul>
                    </div>
                </div>
                <div class="site__rt__news__thumbnail">
                    <div id="thumbnail-slider" class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">                            
                                @foreach ($videos as $video_thumb)
                                <li title="{{ $video_thumb->title }}" class="splide__slide">
                                    <img alt="{{ $video_thumb->title }}" src="{{ $video_thumb->thumbnail }}">
                                </li>
                                @endforeach                          
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        @endif
        
        <div class="card rb-news">
            <div class="card-header rb-news__topic">
                <h2><a href="javascript:;">Sự kiện lịch sử</a></h2>
            </div>
            <div class="row">
                @if (count($news_event_history))
                    @foreach ($news_event_history as $new_event_history)
                    <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <a title="{{ $new_event_history->title }}" href="{{ route('news', ['slug' => $new_event_history->slug, 'id' => $new_event_history->id]) }}">
                            <div class="row g-0 d-flex align-items-center rb-news__link">
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="rb-news__thumbnail">
                                        <img alt="{{ $new_event_history->title }}" src="{{ $new_event_history->thumbnail }}" />
                                    </div>
                                </div>
                                <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                                    <div class="card-body rb-news__content">
                                        <h2 class="card-title rb-news__title text-truncate-2-lines">
                                            {{ $new_event_history->title }}
                                        </h2>
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

<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 col-xxl-6">
        <div class="card ol-news">
            @if (isset($category_general))
                <div class="card-header ol-news__topic">
                    <h2><a title="{{ $category_general->name }}" href="{{ $category_general->slug }}">{{ $category_general->name }}</a></h2>
                </div>
                <a title="{{ $news_general_first->title }}" href="{{ route('news', ['slug' => $news_general_first->slug, 'id' => $news_general_first->id]) }}">
                    <div class="ol-news__thumbnail">
                        <img alt="{{ $news_general_first->title }}" src="{{ $news_general_first->thumbnail }}" />
                    </div>
                    <div class="card-body ol-news__content">
                        <h2 class="card-title ol-news__title">
                            {{ $news_general_first->title }}
                        </h2>
                        <p class="card-text ol-news__des">
                            {{ $news_general_first->description }}
                        </p>
                    </div>
                </a>
            @endif
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-6 col-xxl-6">
        <div class="card ort-news">
            <div class="card-header ort-news__topic">
                @if (isset($category_general))
                    @if (count($category_general->descendants))
                        @foreach ($category_general->descendants as $subcategory_item)
                        <h4><a title="{{ $subcategory_item->name }}" href="{{ $subcategory_item->ancestorsAndSelf($subcategory_item->id)->pluck('slug')->implode('/') }}">{{ $subcategory_item->name }}</a></h4>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
        <div class="card orc-news">
            <div class="row">
                @if (count($news_general))
                    @foreach ($news_general as $new_general)
                    <div class="col-12 col-sm-12 col-md-6 col-lg-12 col-xl-12 col-xxl-12">
                        <a title="{{ $new_general->title }}" href="{{ route('news', ['slug' => $new_general->slug, 'id' => $new_general->id]) }}" class="orc-news__link">
                            <div class="card-header orc-news__topic">
                                <h4 class="text-truncate">
                                    {{ $new_general->title }}
                                </h4>
                            </div>
                            <div class="row g-0 align-items-center">
                                <div class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
                                    <div class="orc-news__thumbnail">
                                        <img alt="{{ $new_general->title }}" src="{{ $new_general->thumbnail }}" />
                                    </div>
                                </div>
                                <div class="col-8 col-sm-8 col-md-8 col-lg-9 col-xl-9 col-xxl-9">
                                    <div class="card-body orc-news__content">
                                        <p class="card-text orc-news__des text-truncate-3-lines">
                                            {{ $new_general->description }}
                                        </p>
                                        <p class="card-text orc-news__time">
                                            <small class="text-muted"> {{ $new_general->created_at->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="card orb-news">
            <div class="splide-wrapper site__orb__news">
                <div id="image-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @if (count($news_general_slider))
                                @foreach ($news_general_slider as $new_general_slider)
                                <li title="{{ $new_general_slider->title }}" class="splide__slide">
                                    <div class="splide__slide__container">
                                        <img alt="{{ $new_general_slider->title }}" src="{{ $new_general_slider->thumbnail }}" />
                                    </div>
                                    <div class="splide__slide__content">
                                        <a href="{{ route('news', ['slug' => $new_general_slider->slug, 'id' => $new_general_slider->id]) }}">
                                            <div class="card-body orb-news__content">
                                                <h3 class="card-title orb-news__title text-truncate-3-lines">
                                                    {{ $new_general_slider->title }}
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
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('assets/home/splide-3.6.9/videos/splide-extension-video.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/home/js/home/app.js')}}"></script>
@endsection