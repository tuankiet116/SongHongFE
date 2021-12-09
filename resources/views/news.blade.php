@extends('layouts.site',[
'title'=>namePosttype($post_type_title, $config->first()->con_site_title),
'description' => $post_type_description??"",
'image' => asset('assets/images/logo/logo.png'),
'config' => $config,
'shop' => $shop
])
@section('script-header')
    <link rel="stylesheet" href="{{ asset('/assets/css/tree-category.css') }}">
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [{
                "@type": "ListItem",
                "item": {
                    "@id": "{{ route('home') }}",
                    "name": "Trang chủ"
                },
                "position": 0
            }, {
                "@type": "ListItem",
                "item": {
                    "@id": "{{ url()->current() }}",
                    "name": "{{ namePosttype($post_type_title, 'Tin tức') }}"
                },
                "position": 1
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
            <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                @switch($post_type_title)
                    @case('tin-tuc')
                        Tin tức
                    @break
                    @case('truyen-thong-noi-gi-ve-chung-toi')
                        Truyền thông nói về chúng tôi
                    @break
                    @default Tin tức
                @endswitch
            </span>
        </div>
    </div>

<div class="container posts m-t-30 m-b-30">
    <div class="post-news row">
        @if (isset($post1))
        <div class="post-new-item col-12 col-lg-7">
            <a href="{{ check_posttype($post_type_title, $post1->post_rewrite_name, $post1->id) }}">
                <img src="{{ url_image($post1->post_avatar ?? '') }}" alt="">
            </a>
            <a href="{{ check_posttype($post_type_title, $post1->post_rewrite_name, $post1->id) }}">
                <h4 class="title m-b-5">{{ namePosttype($post_type_title, 'Tin tức') }}</h4>
            </a>
            <p class="date">{{ date('d/m/Y', strtotime($post1->post_datetime_update)) }}</p>
        </div>
        @endif

            @if (sizeof($config) > 0)
                <div class="post-new-video col-12 col-lg-5">
                    <iframe src="{{ $config[0]->descript_video }}" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                    <h4 class="title" style="margin-bottom: 8px">Video Giúp bạn nhận biết được sản phẩm chính hãng
                        của chăn ga gối đệm Sông Hồng</h4>
                    <p class="date">05/09/2021</p>
                </div>
            @endif
        </div>
        <div class="post-list row m-t-30">
            <div class="post-new-item col-12 col-lg-8 flex-w">
                @foreach ($listPost as $post)
                    <div class="col-12 col-lg-6" style="margin-bottom: 50px">
                        <a href="{{ check_posttype($post_type_title, $post->post_rewrite_name, $post->id) }}">
                            <img src="{{ url_image($post->post_avatar ?? '') }}" alt="post">
                        </a>
                        <a href="{{ check_posttype($post_type_title, $post->post_rewrite_name, $post->id) }}">
                            <h4 class="title">{{ $post->post_title }}</h4>
                        </a>
                        <div style="display: flex">
                            <p class="date" style="margin-right: 10px">
                                {{ date('d/m/Y', strtotime($post->post_datetime_create)) }}</p>
                            <div style="display: flex; align-items:center"><i class="ti-eye"></i>
                                <p style="margin-left: 3px">{{ $post->number_view }} lượt xem</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="container-pagi" style="width:100%; padding-left: 20px;">
                    {{ $listPost->links() }}
                </div>
            </div>
            <div class="featured-news col-12 col-lg-4 ">
                <x-featured-news :postsTop="$PostsTop" :postTypeTitle="$post_type_title" />
            </div>

        </div>
    </div>

    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-55">
        <div class="container">
            <div class="title flex-w ">
                <h5 class="mtext-105 text-center" style="width:100%">Đề xuất theo danh mục</h5>
                <ul class="main-menu flex-c flex-w" style="width:100%">
                    @foreach ($productCate as $item)
                        <li style="cursor: pointer" class="tab-product-cate" id-get-produt="{{ $item->id }}">
                            <a href="#">
                                <img src="{{ asset('/assets/icon/icon1.png') }}" alt="{{ $item->name }}"
                                    class="icon-c">
                                <span class="cato-na1 ">{{ $item->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
            <!-- Slide2 -->
            <div class="wrap-slick4 ">
                <div class="main-slick">

                </div>
                <div class="loading"></div>
            </div>
        </div>
    </section>

    <x-footer :categories="$productCate" :config="$config->first()" :postPolicy="$postPolicy"/>
@endsection

@section('script-footer')
    <script>
        $(document).ready(function() {
            let data = $('.tab-product-cate').first().attr('id-get-produt');
            $('span.cato-na1').first().addClass('active-cato');

            callAjax(data);

            function slickCarousel() {
                $('.slick4').slick({
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    infinite: false,
                    autoplay: false,
                    autoplaySpeed: 6000,
                    arrows: true,
                    prevArrow: '<button class="arrow-slick4 prev-slick4"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                    nextArrow: '<button class="arrow-slick4 next-slick4"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
                    responsive: [{
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 4
                            }
                        },
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        }
                    ]
                });
            }

            $('.tab-product-cate').unbind().click(function(e) {
                e.preventDefault();
                $('span.cato-na1').removeClass('active-cato');
                $(this).find('a > span.cato-na1').addClass('active-cato');

                let id = $(this).attr('id-get-produt');
                // $('.loading').css('display', 'block');
                callAjax(id);
            });

            function percentSale(oldPrice, salePrice) {
                oldPrice = parseFloat(oldPrice);
                salePrice = parseFloat(salePrice);
                var sale = 100 - salePrice / (oldPrice / 100);
                return parseInt(sale);
            }

            function callAjax(id) {
                $.ajax({
                    type: "GET",
                    url: `{{ url('/api/getProdutByCate/${id}') }}`,
                    async: false,
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        $('.loading').css('display', 'none');
                        let html = res.map(function(item) {
                            var sale = percentSale(item.price, item.saleprice);
                            var str = `
                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <a href="{{ url('chi-tiet-san-pham/${item.id}') }}">
                                <img src="{{ env('BASE_URL') }}${item.avatar}" alt="IMG-PRODUCT">
                            </a>`;
                            if (item.avatar2 != "" && item.avatar2 != null) {
                                str += `<div class="product-alt-img">
                                    <a href="{{ url('chi-tiet-san-pham/${item.id}') }}">
                                        <img src="{{ env('BASE_URL') }}${item.avatar2}" alt="ALT-IMG-PRODUCT">
                                    </a>
                                </div>`;
                            }
                            if (sale > 0) {
                                str += `<span class="out-of-stock">-${sale}% </span>`;
                            }

                            str += `
                            <div class="product-btn-group">
                                <div class="row">
                                    <div class="product-btn-more col-lg-6 col-md-6 col-sm-12 col-12">
                                        <a href="{{ url('chi-tiet-san-pham/${item.id}') }}"
                                            class="block2-btn block2-btn-new js-show-modal1">
                                            Xem ngay
                                        </a>
                                    </div>
                                    <div class="product-btn-add col-lg-6 col-md-6 col-sm-12 col-12">
                                        <a href="{{ url('chi-tiet-san-pham/${item.id}') }}"
                                            class="block2-btn block2-btn-new js-show-modal1">
                                            Thêm sản phẩm
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" flex-w flex-c ">
                        <span class=" text-center  related-products-text-1 " style="width:100%">
                            ${item.name_cate}
                        </span>
                        <span class=" cl10 text-center stext-103  " style="width:100% ; ">
                            ${item.title}
                        </span>

                        <span class=" cl10 text-center stext-103 related-products-text-3 " style="width:100% ; ">
                            ${new Intl.NumberFormat('de-DE').format(item.price)}đ
                        </span>

                        <span class=" cl10 text-center stext-103 related-products-text-4 " style="width:100% ; ">
                            ${new Intl.NumberFormat('de-DE').format(item.saleprice)}đ
                        </span>
                        </div>
                    </div>
                    </div>`;
                            return str;
                        });

                        let rs = `
                        <div class="slick4" id="tab-content">
                            ${html}
                        </div>
                `;

                        $('.main-slick').html(rs.replace(/,/g, '')).ready(function() {
                            slickCarousel();
                        });
                    },
                    error: function(res) {
                        $('.loading').css('display', 'none');
                        console.log(res);
                    }
                });
            }
        });
    </script>
@endsection
