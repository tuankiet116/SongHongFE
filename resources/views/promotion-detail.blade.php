@extends('layouts.site',[
'title'=> $title??"",
'description' => $description??"",
'image' => url_image($image, asset('assets/images/logo/logo.png')),
'config' => $config,
'shop' => $shop
])
@section('script-header')
    <script type="application/ld+json" class="rank-math-schema">
        {
            "@context": "https://schema.org",
            "@graph": [{
                "@type": ["FurnitureStore", "Organization"],
                "@id": "{{ route('Promotion') . '/#oganization' }}",
                "name": "{{ $shop->title }}",
                "url": "{{ route('Promotion') }}",
                "logo": {
                    "@type": "ImageObject",
                    "@id": "{{ route('Promotion') . '/#logo' }}",
                    "url": "{{ url_image($image) }}",
                    "caption": "{{ $title }}",
                    "inLanguage": "en-US",
                    "width": "120",
                    "height": "57"
                },
                "openingHours": ["Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday 09:00-17:00"],
                "image": {
                    "@id": "{{ route('Promotion') . '/#logo' }}"
                }
            }, {
                "@type": "WebSite",
                "@id": "{{ route('Promotion') . '/#website' }}",
                "url": "{{ route('Promotion') }}",
                "name": "{{ $shop->title }}",
                "publisher": {
                    "@id": "{{ route('Promotion') . '/#oganization' }}"
                },
                "inLanguage": "en-US"
            }, {
                "@type": "ImageObject",
                "@id": "{{ url_image($image) }}",
                "url": "{{ url_image($image) }}",
                "width": "750",
                "height": "500",
                "caption": "{{ $title }}",
                "inLanguage": "en-US"
            }, {
                "@type": "BlogPosting",
                "headline": "{{ $title }}",
                "datePublished": "{{ formatDatetime($post_datetime_create) }}",
                "dateModified": "{{ formatDatetime($post_datetime_update) }}",
                "publisher": {
                    "@id": "{{ route('Promotion') . '/#oganization' }}"
                },
                "description": "{{ $description }}",
                "name": "{{ $title }}",
                "inLanguage": "en-US",
            }]
        }
    </script>

@endsection
@section('main')
    <x-header :categories="$productCate" :phone="$config->first()->con_hotline" :messenger="$config->first()->script_facebook" />
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

            <a href="{{ route('Promotion') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Khuyến mãi
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
                    {!! $postDetail->content !!}
                </div>
                <!-- Facebook comments -->
                <div style="padding: 20px; margin-left: 0">
                    <div class="fb-like" data-href="{{ url()->current() }}" data-width="" data-layout="standard"
                        data-action="like" data-size="large" data-share="true"></div>
                </div>
                <div class="container" style="margin-bottom: 30px">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%"
                                data-numposts="10"></div>
                        </div>
                    </div>
                </div>

                <section id="contact-us" class="contact-us section" style="margin-top: 70px">
                    <div class="title container" style="padding-left: 0; padding-right: 0">
                        <h3> đăng kí nhận khuyến mãi hấp dẫn ngay </h3>
                        <h4 style="margin-top: 10px">120 dánh giá</h4>
                        <hr style="background: #FF4764;" />
                    </div>
                    <div class="container">
                        <div class="contact-head">
                            <div class="row">
                                <div class="col-lg-10 col-12" style="padding-left: 0; padding-right: 0">
                                    <div class="form-main">
                                        <form class="form" method="post" action="mail/mail.php">
                                            <p style="margin-bottom: 20px">Thông tin đăng ký</p>
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <input name="contact_signup_name" type="text"
                                                            placeholder="Họ và tên">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <input name="contact_signup_phone" type="text"
                                                            placeholder="Số diện thoại">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group button" style="margin-top: 12px">
                                                        <button type="submit" name="contact_signup_btn"
                                                            class="btn "
                                                            style="width: 100%; height: 50px; font-weight: bold">Ðăng ký
                                                            ngay</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="featured-news col-12 col-lg-4 col-md-12 col-sm-12">
                <div class="featured-news-wrap p-t-34 p-b-46 p-l-20  p-r-20">
                    <h4>KHUYẾN MÃI NỔI BẬT KHÁC</h4>
                    <div class="row">
                        <div class="featured-main featured-item m-t-10 col-lg-12 col-md-6 col-sm-12 col-12">
                            <div class="row" style="width: 100%">
                                @foreach ($postFeatured as $item)
                                    @php
                                        if ($item->post_rewrite_name == null || $item->post_rewrite_name == '') {
                                            $param = $item->id;
                                        } else {
                                            $param = $item->post_rewrite_name;
                                        }
                                    @endphp
                                    <div class="col-12" style="margin-bottom: 20px">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12"
                                            style="padding-right: 0; height: 170px">
                                            <img src="{{ url_image($item->post_avatar) }}" alt="postTop">
                                        </div>

                                        <div class="featured-detail-item col-lg-12 col-md-12 col-sm-12 col-12"
                                            style="width:100%">
                                            <a href="{{ route('Promotion.detail', ['rw' => $param]) }}">
                                                <p class="title">{{ $item->post_title }} </p>
                                            </a>
                                            <p class="date">
                                                {{ date('d/m/Y', strtotime($item->post_datetime_create)) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="promote-more col-12 m-l-10">
                                    <a href="{{ route('Promotion') }}"> Xem thêm </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <x-footer :categories="$productCate" :config="$config->first()" :postPolicy="$postPolicy"/>
@endsection
