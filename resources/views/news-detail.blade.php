@extends('layouts.site', [
'title'=>$title??"",
'description' => $post->post_description??"",
'image' => url_image($post->post_avatar),
'config' => $config,
'shop' => $shop
])
@section('script-header')
    <script type="application/ld+json" class="rank-math-schema">
        {
            "@context": "https://schema.org",
            "@graph": [{
                "@type": ["FurnitureStore", "Organization"],
                "@id": "{{ check_posttype($post_type_title) . '/#oganization' }}",
                "name": "{{ $shop->title }}",
                "url": "{{ check_posttype($post_type_title) }}",
                "logo": {
                    "@type": "ImageObject",
                    "@id": "{{ check_posttype($post_type_title) . '/#logo' }}",
                    "url": "{{ url_image($post->post_avatar) }}",
                    "caption": "{{ $title }}",
                    "inLanguage": "en-US",
                    "width": "120",
                    "height": "57"
                },
                "openingHours": ["Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday 09:00-17:00"],
                "image": {
                    "@id": "{{ check_posttype($post_type_title) . '/#logo' }}"
                }
            }, {
                "@type": "WebSite",
                "@id": "{{ check_posttype($post_type_title) . '/#website' }}",
                "url": "{{ check_posttype($post_type_title) }}",
                "name": "{{ $shop->title }}",
                "publisher": {
                    "@id": "{{ check_posttype($post_type_title) . '/#oganization' }}"
                },
                "inLanguage": "en-US"
            }, {
                "@type": "ImageObject",
                "@id": "{{ url_image($post->post_avatar) }}",
                "url": "{{ url_image($post->post_avatar) }}",
                "width": "750",
                "height": "500",
                "caption": "{{ $title }}",
                "inLanguage": "en-US"
            }, {
                "@type": "BlogPosting",
                "headline": "{{ $title }}",
                "datePublished": "{{ formatDatetime($post->post_datetime_create) }}",
                "dateModified": "{{ formatDatetime($post->post_datetime_update) }}",
                "publisher": {
                    "@id": "{{ check_posttype($post_type_title) . '/#oganization' }}"
                },
                "description": "{{ $post->post_description }}",
                "name": "{{ $title }}",
                "inLanguage": "en-US",
            }]
        }
    </script>

@endsection
@section('main')
    <x-header :categories="$productCate" :phone="$config->first()->con_hotline" :messenger="$config->first()->script_facebook" />
    <x-cart />
    <!-- breadcrumb -->
    <div class="container search-bar-mobile ">
        <div class="search-bar-top  ">
            <form class="search-bar" action="{{ route('search') }}" method="POST">
                @csrf
                {{ method_field('post') }}
                <input name="keyword" placeholder="Tìm kiếm" type="search" style="position: absolute; left: 0; width: 60%">
                <select name="type">
                    <option selected="selected" disabled>Tất cả danh mục</option>
                    @if ($productCate != '')
                        @foreach ($productCate as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    @endif
                </select>
                <button class="btnn" type="submit"><i class="ti-search"></i></button>
            </form>
        </div>
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg ">
            <a href="{{ url('/') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ check_posttype($post_type_title) }}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ namePosttype($post_type_title, 'Tin tức') }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ $title }}
            </span>
        </div>
    </div>

    <div class="container posts m-t-30 m-b-30">
        <div class="post-list row m-t-30">
            <div class="col-12 col-lg-8 detail-posts">
                <h2>{{ $title }}</h2>
                <div>
                    {!! $postDetail->content ?? '' !!}
                </div>
                <div style="padding: 20px;">
                    <div class="fb-like" data-href="{{ url()->current() }}" data-width="" data-layout="standard"
                        data-action="like" data-size="large" data-share="true"></div>
                </div>
            </div>
            <div class="featured-news col-12 col-lg-4 ">
                <x-featured-news :postsTop="$PostsTop" :post_type_title="$post_type_title" />
            </div>

        </div>
    </div>

    <!-- Facebook comments -->

    <div class="container" style="margin-bottom: 30px">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%" data-numposts="10"></div>
            </div>
        </div>
    </div>

    <!--  New post related -->
    <div class="new-post-related container">
        <h3>Tin tức liên quan</h3>
        <div class="row m-t-30 m-b-30">
            @foreach ($PostRela as $item)
                <div class="col-12 col-lg-4  post-related-items">
                    <a href="{{ check_posttype($post_type_title, $item->post_rewrite_name, $item->id) }}">
                        <img src="{{ url_image($item->post_avatar) }}" alt="ảnh">
                    </a>
                    <a href="{{ check_posttype($post_type_title, $item->post_rewrite_name, $item->id) }}">
                        <p class="title">{{ $item->post_title }}</p>
                    </a>
                    <p class="date">{{ date('d/m/Y', strtotime($item->post_datetime_update)) }}</p>
                </div>
            @endforeach

        </div>
    </div>

    <x-footer :categories="$productCate" :config="$config->first()" :postPolicy="$postPolicy"/>
@endsection
