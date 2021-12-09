@extends('layouts.site',[
'title'=>$config->first()->con_site_title??"",
'description' => $config->first()->con_meta_description??"",
'image' => asset('assets/images/logo/logo.png'),
'config' => $config,
'shop' => $shop
])

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
    </div>

    @if (sizeof($config) > 0 && isset($config->first()->getRelations()['banner']))
        <div class=" single-item">
            @foreach ($config->first()->getRelations()['banner'] as $item)
                <div>
                    <a href="{{ url_image($item->banner_path) ?? '' }}">
                        <img src="{{ url_image($item->banner_url) }}" alt="{{ $item->banner_title }}" width="1900"
                            height="700">
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Danh mục cho mobile --}}
    <div class="list-category">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-12">
                    <div class="category-block">
                        <div class="category-title">
                            <p>DANH MỤC</p>
                        </div>
                        <div class="all-category">
                            @foreach ($productCate as $item)
                                <ul class="main-category">
                                    <li>
                                        <a href="{{ route('product.listing', ['id' => $item->id]) }}">
                                            <img style="height: 20px;width: 25px;" src="{{ url_image($item->code) }}" />
                                            &nbsp
                                            {{ $item->name }}
                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                        @if (isset($item->getRelations()['ref_category_lv1']))
                                            <ul class="sub-category">
                                                @foreach ($item->getRelations()['ref_category_lv1'] as $cat_lv)
                                                    <li><a
                                                            href="{{ route('product.lv1', ['id' => $item->id]) }}">{{ $cat_lv->name_sub_category }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End List Category-->

    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-wallet"></i>
                        <p class="text-service">Thanh toán đảm bảo</p>
                        <p class="subtext-service">An toàn thanh toán</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-comments"></i>
                        <p class="text-service">Hỗ trợ 24/7</p>
                        <p class="subtext-service">Chăm sóc khách hàng</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-shield"></i>
                        <p class="text-service">An toàn tuyệt đối</p>
                        <p class="subtext-service">Bảo mật thông tin</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>

    <section class="sec-relate-product most-popular bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-5">
                <p class="title-single-product">Sản phẩm <span>đang bán chạy</span></p>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick5">
                <div class="slick5">

                    @foreach ($bestSeller as $item)
                        <div class="item-slick5 p-l-15 p-r-15 p-t-15 p-b-15">
                            <div class="block2">
                                <div class="block2-pic hov-img0" style="height: auto !important">
                                    <a href="{{ route('product-detail', ['id' => $item->id]) }}">
                                        <img src="{{ url_image($item->avatar) ?? asset('/assets/images/product-default.png') }}"
                                            alt="IMG-PRODUCT" style="height: auto !important">
                                        @if ($item->avatar2 != '' && $item->avatar2 != null)
                                            <div class="product-alt-img">
                                                <img src=" {{ url_image($item->avatar2) }} " alt="ALT-IMG-PRODUCT" style="height: auto !important">
                                            </div>
                                        @endif
                                    </a>
                                    @if (percentSale($item->price, $item->saleprice) > 0)
                                        <span
                                            class="out-of-stock">-{{ percentSale($item->price, $item->saleprice) }}%</span>
                                    @endif

                                    <div class="product-btn-group">
                                        <div class="row">
                                            <div class="product-btn-more col-lg-6 col-md-6 col-sm-12 col-12">
                                                <a href="{{ route('product-detail', ['id' => $item->id]) }}"
                                                    class="block2-btn block2-btn-new js-show-modal1">
                                                    Xem ngay
                                                </a>
                                            </div>
                                            <div class="product-btn-add col-lg-6 col-md-6 col-sm-12 col-12">
                                                <a href="{{ route('product-detail', ['id' => $item->id]) }}"
                                                    class="block2-btn block2-btn-new js-show-modal1">
                                                    Thêm sản phẩm
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="product-content">
                                        <p class="product-title-1">
                                            @if (isset($item->getRelations()['product_categories']))
                                                {{ $item->getRelations()['product_categories']->first()->name ?? '' }}
                                            @else
                                                ""
                                            @endif
                                        </p>
                                        <h3>
                                            <a href="{{ route('product-detail', ['id' => $item->id]) }}">
                                                {{ $item->title }}
                                            </a>
                                        </h3>
                                        <div class="product-price">
                                            <span class="old">{{ number_format($item->price ?? 0) }}
                                                đ</span><br>
                                            @if (isset($item->saleprice) && $item->saleprice != 0)
                                                <span>{{ number_format($item->saleprice ?? 0) }} đ</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Banner --}}
    <section class="section free-version-banner">
        <div class="container">
            <div class="row align-items-center">
                @if (!is_null($productSample))
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <img src="{{url_image($productSample->avatar)}}" />
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="section-title mb-60">

                            <h2 class="text-black wow fadeInUp" data-wow-delay=".4s"
                                style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                {{$productSample->title ?? 'chăn nhung'}}
                            </h2>
                            <p class="text-black wow fadeInUp" data-wow-delay=".6s"
                                style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                                <span class="free-verison-saleprice">{{number_format($productSample->price ?? 0)}} đ</span> &nbsp&nbsp
                                <span class="free-verison-price">{{number_format($productSample->saleprice ?? 0)}} đ</span>
                            </p>

                            <div class="button">
                                <a href="{{route('product-detail', ['id'=>$productSample->id]) ?? ''}}" rel="nofollow" class="btn wow fadeInUp" data-wow-delay=".8s">Mua Ngay</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Danh sách sản phẩm cho mobile --}}
    <section class="list-product-mobile">
        <div class="container">
            @foreach ($productCate as $items)
                @if ($items->view_home == 0)
                    @php
                        continue;
                    @endphp
                @endif
                <div class="row">
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                        <p class="product-box-title">
                            <span class="product-bg">
                                <img style="width: 30px; height: 30px;"
                                    src="{{ url_image($items->code, '/assets/images/default-icon-product.png') }}" />&nbsp
                                {{ $items->name ?? '' }}
                            </span>

                            <a class="product-seemore" href="{{ route('product.listing', ['id' => $items->id]) }}">
                                Xem thêm</a>
                        </p>
                    </div>
                </div>
                @if (isset($items->getRelations()['product']))
                    <div class="row">
                        @foreach ($items->getRelations()['product'] as $product)
                            <div class="col-sm-6 col-6">
                                <a href="{{ route('product-detail', ['id' => $product->id]) }}">
                                    <div class="product-list-item">
                                        <img src={{ url_image($product->avatar, '/assets/images/product-default.png') }}
                                            alt="IMG-PRODUCT">
                                    </div>
                                </a>

                                <div class="product-content">
                                    <h3><a
                                            href="{{ route('product-detail', ['id' => $product->id]) }}">{{ $product->title }}</a>
                                    </h3>
                                    <div class="product-price">
                                        <span class="old">{{ number_format($product->price ?? 0) }}
                                            đ</span><br>
                                        @if (isset($item->saleprice) && $item->saleprice != 0)
                                            <span>{{ number_format($product->saleprice ?? 0) }} đ</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    {{-- Danh sách sản phẩm cho desktop --}}
    <section class="sec-relate-product most-popular bg0 p-t-45 p-b-105" id="most-popular-desktop">
        <div class="container">
            @foreach ($productCate as $items)
                @if ($items->view_home == 0)
                    @php
                        continue;
                    @endphp
                @endif
                <div class="p-b-5">
                    <p class="product-box-title">
                        <a class="product-bg" href="{{ route('product.listing', ['id' => $items->id]) }}" style="color: #ffffff">
                            <img style="width: 30px; height: 30px;"
                                src="{{ url_image($items->code, '/assets/images/default-icon-product.png') }}" />&nbsp
                            {{ $items->name ?? '' }}
                        </a>
                        <a class="product-seemore" href="{{ route('product.listing', ['id' => $items->id]) }}">Xem
                            thêm</a>
                    </p>
                </div>
                {{-- Danh Sách Sản Phẩm --}}
                <div class="wrap-slick2">
                    <div class="slick2">
                        @foreach ($items->getRelations()['product'] as $product)
                            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                <div class="block2">
                                    <div class="block2-pic hov-img0" style="height: auto !important">
                                        <a href="{{ route('product-detail', ['id' => $product->id]) }}">
                                            <img src="{{ url_image($product->avatar, '/assets/images/product-default.png') }}"
                                                alt="IMG-PRODUCT" style="height: auto !important">
                                            @if ($product->avatar2 != '' && $product->avatar2 != null)
                                                <div class="product-alt-img">
                                                    <img src=" {{ url_image($product->avatar2) }} "
                                                        alt="ALT-IMG-PRODUCT" style="height: auto !important">
                                                </div>
                                            @endif
                                        </a>
                                        @if (percentSale($product->price, $product->saleprice) > 0)
                                            <span
                                                class="out-of-stock">-{{ percentSale($product->price, $product->saleprice) }}%</span>
                                        @endif
                                        <div class="product-btn-group">
                                            <div class="row">
                                                <div class="product-btn-more col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <a href="{{ route('product-detail', ['id' => $product->id]) }}"
                                                        class="block2-btn block2-btn-new js-show-modal1">
                                                        Xem ngay
                                                    </a>
                                                </div>
                                                <div class="product-btn-add col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <a href="{{ route('product-detail', ['id' => $product->id]) }}"
                                                        class="block2-btn block2-btn-new js-show-modal1">
                                                        Thêm sản phẩm
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="product-content">
                                            <h3><a
                                                    href="{{ route('product-detail', ['id' => $product->id]) }}">{{ $product->title }}</a>
                                            </h3>
                                            <div class="product-price">
                                                <span class="old">{{ number_format($product->price ?? 0) }}
                                                    đ</span><br>
                                                @if (isset($product->saleprice) && $product->saleprice != 0)
                                                    <span>{{ number_format($product->saleprice ?? 0) }} đ</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </section>

    <!--Testimonial Area Desktop-->
    <div class="testimonial-area" id="testimonial-desktop">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 text-center ">
                    <p><img id="testimonial-headimg" src="{{ asset('assets/images/testimonial/head_img.png') }}" />
                    </p>
                    <p class="testimonial-slogan">Chúng tôi luôn nỗ lực mang tới giấc ngủ diu êm và niềm hạnh phúc tới
                        mọi người</p>
                    <p><img id="testimonial-familyimg" src="{{ asset('assets/images/testimonial/family.png') }}" />
                    </p>
                </div>
                <div class="col-md-8 col-lg-8 col-sm-12 ">
                    <h3 id="testimonial-title-1">Mang hạnh phúc cho khách hàng</h3>
                    <div class="single-testimonial">
                        <div class="testimonial">
                            <p class="description">
                                "Mình rất thích sử dụng sản phẩm chăn ga của Sông Hồng, nó mang lại cho mình cảm giác ấm áp,
                                mềm mại như được chìm đắm trong vòng tay của mẹ."
                            </p>
                            <div class="testimonial-content">
                                <div class="pic">
                                    <img src="{{ asset('assets/images/testimonial/testimonial-2.png') }}"
                                        alt="testimonial_img">
                                </div>
                                <div class="content">
                                    <h4 class="name">Nguyễn Hương Ly</h4>

                                    <span class="post">Hà Nội</span>

                                </div>
                            </div>
                        </div>
                        <div class="testimonial">
                            <p class="description">
                                "Sản phẩm chăn ga của Sông Hồng luôn là lựa chọn hàng đầu của gia đình tôi, với chất liệu hàng đầu và kiểu
                                dáng đẹp mắt trong từng sản phẩm, mẫu mã đã mang lại cho chúng tôi sự hài lòng và tin dùng."
                            </p>
                            <div class="testimonial-content">
                                <div class="pic">
                                    <img src="{{ asset('assets/images/testimonial/testimonial-1.png') }}"
                                        alt="testimonial_img">
                                </div>
                                <div class="content">
                                    <h4 class="name">Vũ Quang Long</h4>

                                    <span class="post">Hải Dương</span>

                                </div>
                            </div>
                        </div>
                        <div class="testimonial">
                            <p class="description">
                                " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget vehicula nibh.
                                Duis eu interdum dolor. Pellentesque mollis nisl vitae."
                            </p>
                            <div class="testimonial-content">
                                <div class="pic">
                                    <img src="{{ asset('assets/images/testimonial/testimonial-4.png') }}"
                                        alt="testimonial_img">
                                </div>
                                <div class="content">
                                    <h4 class="name">Đặng Thùy Linh</h4>

                                    <span class="post">Hà Nội</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Testimonial Area Desktop-->

    <!--Testimonial Area Mobile-->
    <div class="testimonial-area" id="testimonial-mobile">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center ">
                    <h3 id="testimonial-title-1">Mang hạnh phúc cho khách hàng</h3>
                    <p><img id="testimonial-headimg" src="{{ asset('assets/images/testimonial/head_img.png') }}" />
                    </p>
                    <p class="testimonial-slogan">Chúng tôi luôn nỗ lực mang tới giấc ngủ diu êm và niềm hạnh phúc tới
                        mọi người</p>
                    <br>
                    <div class="single-testimonial">
                        <div class="testimonial" style="border:none !important">
                            <img src="{{ asset('assets/images/testimonial/family.png') }}" alt="testimonial_img">
                        </div>
                        <div class="testimonial">
                            <p class="description">
                                " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget vehicula nibh.
                                Duis eu interdum dolor. Pellentesque mollis nisl vitae."
                            </p>
                            <div class="testimonial-content">
                                <div class="pic">
                                    <img src="{{ asset('assets/images/testimonial/testimonial-2.png') }}"
                                        alt="testimonial_img">
                                </div>
                                <div class="content">
                                    <h4 class="name">Nguyễn Hương Ly</h4>

                                    <span class="post">Hà Nội</span>

                                </div>
                            </div>
                        </div>
                        <div class="testimonial">
                            <p class="description">
                                " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget vehicula nibh.
                                Duis eu interdum dolor. Pellentesque mollis nisl vitae."
                            </p>
                            <div class="testimonial-content">
                                <div class="pic">
                                    <img src="{{ asset('assets/images/testimonial/testimonial-1.png') }}"
                                        alt="testimonial_img">
                                </div>
                                <div class="content">
                                    <h4 class="name">Vũ Quang Long</h4>

                                    <span class="post">Hải Dương</span>

                                </div>
                            </div>
                        </div>
                        <div class="testimonial">
                            <p class="description">
                                " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget vehicula nibh.
                                Duis eu interdum dolor. Pellentesque mollis nisl vitae."
                            </p>
                            <div class="testimonial-content">
                                <div class="pic">
                                    <img src="{{ asset('assets/images/testimonial/testimonial-4.png') }}"
                                        alt="testimonial_img">
                                </div>
                                <div class="content">
                                    <h4 class="name">Đặng Thùy Linh</h4>

                                    <span class="post">Hà Nội</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Testimonial Area Mobile-->
    <section class="shop-blog section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <p class="blog-title">Video</p>
                    <br>
                    <p><iframe width="100%" height="315" src="https://www.youtube.com/embed/vjalub3gnaM"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe></p>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 col-12">
                    <a href="{{ route('news.social.listing') }}" class="blog-title">Truyền thông nói về chúng
                        tôi</a>
                    <br>
                    @foreach ($post as $item)
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 col-5">
                                <a
                                    href="{{ route('news.social', ['rw' => $item->post_rewrite_name == '' || $item->post_rewrite_name == null ? $item->id : $item->post_rewrite_name]) }}">
                                    <p class="text-center"><img src="{{ url_image($item->post_avatar) }}" /></p>
                                </a>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 col-7">
                                <a
                                    href="{{ route('news.social', ['rw' => $item->post_rewrite_name == '' || $item->post_rewrite_name == null ? $item->id : $item->post_rewrite_name]) }}">
                                    <p class="blog-video-title-2">
                                        {{ $item->post_title }}
                                    </p>
                                </a>
                                <p class="blog-video-post-2">
                                    {{ date('m/d/y g:i A', strtotime($item->post_datetime_update)) }}
                                </p>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 " style="padding-top: 15px">
                    <p class="blog-title-2">Tin tức mới nhất</p>
                    <br>
                    @foreach ($postnew as $item)
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 text-center">
                                <a
                                    href="{{ route('news.detail', ['rw' => $item->post_rewrite_name == '' || $item->post_rewrite_name == null ? $item->id : $item->post_rewrite_name]) }}">
                                    <img style="height: 200px; width: 100%;" class="news2-img"
                                        src="{{ url_image($item->post_avatar) }}" /></a>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                                <a
                                    href="{{ route('news.detail', ['rw' => $item->post_rewrite_name == '' || $item->post_rewrite_name == null ? $item->id : $item->post_rewrite_name]) }}">
                                    <p class="blog-video-title-2">{{ $item->post_title }}
                                    </p>
                                </a>
                                <p class="blog-video-post-2">
                                    {{ date('m/d/y g:i A', strtotime($item->post_datetime_update)) }}</p>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <x-footer :categories="$productCate" :config="$config->first()" :postPolicy="$postPolicy"/>
@endsection

@section('script-footer')
    <script src="{{ asset('assets/js/slick-custom.js') }}"></script>
@endsection
