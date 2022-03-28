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
<script type="application/ld+json">
    { 
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
<style>
    .error {
        text-align: center;
        margin: auto;
        padding: 40px 15px;
    }

    .error h1 {
        color: #3ea61e;
        font-size: 10em;
    }

    .error__content p {
        margin: 30px 0 !important;
        font-size: 17px
    }

    .error__actions {
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .error__actions .btn-green {
        background: #3ea61e;
        color: #fff;
    }
    .error__actions .btn-green:hover {
        color: #fff;
    }

    .search-error {
        margin: auto;
    }

    .search-error button {
        background: transparent;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        border: 1px solid #ced4da;
        border-left: 0;
    }

    .search-error input {
        border-right: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }


</style>
@section('css')

@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8 error">
        <h1>404</h1>
        <h2>không tìm thấy đường dẫn này</h2>
        <div class="error__actions">
            <a href="{{URL::to('/')}}" class="btn btn-green">
                <i class="fa fa-home" aria-hidden="true"></i> Trang chủ
            </a>
        </div>
        <div class="row">
            <div class="col-12 col-sm-9 col-md-9 col-lg-9 col-xl-9 col-xxl-9 search-error">
                <form class="d-flex py-2" action="{{ route('search') }}" onsubmit="return formSearchPage()" method="GET">
                    <input class="form-control" type="search" id="search-news-page" name="q"
                        value="{{ request()->query('q') }}" placeholder="Nhập từ khoá tìm kiếm...">
                    <button class="btn" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="error__content">
            <p><strong>Một số tin tức nổi bật trong ngày bạn có thể đọc thêm.</strong></p>
        </div>
    </div>
</div>
@endsection


@section('js')

@endsection