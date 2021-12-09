@extends('layouts.site',[
'title'=>$productInfor->title,
'description' => $productInfor->title,
'image' => url_image($productInfor->avatar),
'config' => $config,
'shop' => $shop
])
@section('script-header')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "speakable": {
                "@type": "SpeakableSpecification",
                "cssSelector": [".description"],
                "xpath": ["/html/head/title"]
            }
        }
    </script>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Product",
            "name": "{{ $productInfor->title }}",
            "sku": "{{ $productInfor->sku }}",
            "offers": {
                "@type": "http://schema.org/Offer",
                "price": {{ $productInfor->saleprice }},
                "priceCurrency": "VND",
                "availability": "http://schema.org/InStock",
                "url": "{{ url()->current() }}",
                "itemCondition": "https://schema.org/NewCondition",
                "seller": {
                    "name": "{{ $shop->title }}",
                    "type": "Organization"
                },
                "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": 0,
                    "reviewCount": 0
                },
                "review": [],
                "additionalProperty": [
                    @foreach ($list_properties as $key => $value)
                        @foreach ($value as $property)
                            {
                            "@type":"PropertyValue",
                            "name":"{{ $key }}",
                            "value":"{{ $property }}"
                            },
                        @endforeach
                    @endforeach
                ]
            },
            "image": "{{ url_image($productInfor->avatar, asset('/assets/images/product-default.png')) }}",
            @if (strlen($productInfor->content) > 255)
                @php
                    echo substr($productInfor->content, 0, 255) . '...';
                @endphp
            @endif "
        }
    </script>
    
@endsection
@section('main')
    <x-header :categories="$productCategories" :phone="$config->first()->con_hotline" :messenger="$config->first()->script_facebook" />
    <x-cart />
    <div class="container search-bar-mobile">
        <div class="search-bar-top  ">
            <form class="search-bar" action="{{ route('search') }}" method="POST">
                @csrf
                {{ method_field('post') }}
                <input name="keyword" placeholder="Tìm kiếm" type="search" style="position: absolute; left: 0; width: 60%">
                <select name="type">
                    <option selected="selected" disabled>Tất cả danh mục</option>
                    @if ($productCategories != '')
                        @foreach ($productCategories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    @endif
                </select>
                <button class="btnn" type="submit"><i class="ti-search"></i></button>
            </form>
        </div>
    </div>

    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-24 p-b-60">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-lg-7" style="height: auto !important">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="slick-product wrap-slick3">
                            <div class="slick3 gallery-lb ">
                                @if (isset($productInfor->getRelations()['ref_product_images']) && sizeof($productInfor->getRelations()['ref_product_images']) > 0)
                                    @foreach ($productInfor->getRelations()['ref_product_images'] as $item)
                                        <div class="item-slick3"
                                            data-thumb="{{ url_image($item->images, '/assets/images/product-default.png') }}">
                                            <div class="wrap-pic-w pos-relative">
                                                <img src="{{ url_image($item->images, asset('/assets/images/product-default.png')) }}"
                                                    alt="IMG-PRODUCT" style="height: auto !important">
                                                @if (percentSale($productInfor->price, $productInfor->saleprice) > 0)
                                                    <span
                                                        class="out-of-stock">-{{ percentSale($productInfor->price, $productInfor->saleprice) }}%</span>
                                                @endif
                                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                    href="{{ url_image($item->images, '/assets/images/product-default.png') }}">
                                                    <i class="fa fa-expand"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else

                                    <div class="item-slick3"
                                        data-thumb="{{ asset('/assets/images/product-default.png') }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ asset('/assets/images/product-default.png') }}"
                                                alt="IMG-PRODUCT" style="height: auto !important">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="{{ asset('/assets/images/product-default.png') }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                @if (isset($productInfor->description_video) && $productInfor->description_video != '')
                                    <div class="item-slick3"
                                        data-thumb="{{ url_image($productInfor->video_images) }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <iframe width="100%" src="{{ $productInfor->description_video }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="./images/product/product6.jpg">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="wrap-slick3-dots  wrap-slick2">
                            </div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $productInfor->title }}
                        </h4>

                        @if (isset($productInfor->price) && $productInfor->price != 0)
                            <span class="mtext-106 cl2 cost-prices">
                                {{ number_format($productInfor->price ?? 0) }} đ
                            </span>
                        @endif

                        <br>
                        <span class="mtext-106 cl2 sale-prices">
                            {{ number_format($productInfor->saleprice) }} đ
                        </span>

                        <div class="p-t-33">
                            <div class="flex-w  p-b-10">
                                <div class="size-204 flex-w flex respon6-next" style="width: 45%;">
                                    <div>Số lượng</div>
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>
                                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product"
                                            value="1" id="num-product">
                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>
                                </div>
                                @if (isset($list_properties['Màu']))
                                    <div class="size-204 flex-w flex-m respon6-next" style="width: 55%;">
                                        <div>Màu</div>
                                        <div class="flex-w m-r-20 m-tb-10 wrap-color">

                                            @foreach ($list_properties['Màu'] as $key => $items)
                                                @if ($items == 'Xanh dương')
                                                    <div namevar={!! convert_name('Màu') !!} 
                                                        class="sh-color sh-color-blue 
                                                        @if($key == 0)
                                                        select-color
                                                        @endif"
                                                        propertiesValue="{{ $items }}"></div>
                                                @endif
                                                @if ($items == 'Xanh lam')
                                                    <div namevar={!! convert_name('Màu') !!} 
                                                        class="sh-color sh-color-cyan
                                                        @if($key == 0)
                                                        select-color
                                                        @endif"
                                                        propertiesValue="{{ $items }}"></div>
                                                @endif
                                                @if ($items == 'Xanh lá')
                                                    <div namevar={!! convert_name('Màu') !!} 
                                                        class="sh-color sh-color-green
                                                        @if($key == 0)
                                                        select-color
                                                        @endif"
                                                        propertiesValue="{{ $items }}"></div>
                                                @endif
                                                @if ($items == 'Vàng')
                                                    <div namevar={!! convert_name('Màu') !!} 
                                                        class="sh-color sh-color-yellow
                                                        @if($key == 0)
                                                        select-color
                                                        @endif"
                                                        propertiesValue="{{ $items }}"></div>
                                                @endif
                                                @if ($items == 'Đỏ')
                                                    <div namevar={!! convert_name('Màu') !!} 
                                                        class="sh-color sh-color-red
                                                        @if($key == 0)
                                                        select-color
                                                        @endif"
                                                        propertiesValue="{{ $items }}"></div>
                                                @endif
                                                @if ($items == 'Hồng đậm')
                                                    <div namevar={!! convert_name('Màu') !!} 
                                                        class="sh-color sh-color-magenta
                                                        @if($key == 0)
                                                        select-color
                                                        @endif"
                                                        propertiesValue="{{ $items }}"></div>
                                                @endif
                                                @if ($items == 'Tím')
                                                    <div namevar={!! convert_name('Màu') !!} 
                                                        class="sh-color sh-color-purple
                                                        @if($key == 0)
                                                        select-color
                                                        @endif"
                                                        propertiesValue="{{ $items }}"></div>
                                                @endif
                                                @if ($items == 'Cam')
                                                    <div namevar={!! convert_name('Màu') !!} 
                                                        class="sh-color sh-color-orange
                                                        @if($key == 0)
                                                        select-color
                                                        @endif"
                                                        propertiesValue="{{ $items }}"></div>
                                                @endif
                                                @if ($items == 'Đen')
                                                    <div namevar={!! convert_name('Màu') !!} 
                                                        class="sh-color sh-color-black
                                                        @if($key == 0)
                                                        select-color
                                                        @endif"
                                                        propertiesValue="{{ $items }}"></div>
                                                @endif
                                                @if ($items == 'Trắng')
                                                    <div namevar={!! convert_name('Màu') !!} 
                                                        class="sh-color sh-color-white
                                                        @if($key == 0)
                                                        select-color
                                                        @endif"
                                                        propertiesValue="{{ $items }}"></div>
                                                @endif
                                                @if ($items == 'Hồng')
                                                    <div namevar={!! convert_name('Màu') !!} 
                                                        class="sh-color sh-color-pink
                                                        @if($key == 0)
                                                        select-color
                                                        @endif"
                                                        propertiesValue="{{ $items }}"></div>
                                                @endif
                                                @if ($items == 'Nâu')
                                                    <div namevar={!! convert_name('Màu') !!} 
                                                        class="sh-color sh-color-brown
                                                        @if($key == 0)
                                                        select-color
                                                        @endif"
                                                        propertiesValue="{{ $items }}"></div>
                                                @endif
                                            @endforeach


                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-w  p-b-10">
                                <div class="size-204 respon6-next" style="width: 100%;">
                                    @foreach ($list_properties as $key => $value)
                                        @if ($key == 'Màu')
                                            @php
                                                continue;
                                            @endphp
                                        @endif
                                        <div><b>{{ $key }}</b> </div>
                                        <div id="{!! convert_name($key) !!}" namevar={!! convert_name($key) !!}
                                            keyname="{{ $key }}" class="flex-w m-r-20 m-tb-10 wrap-pro">
                                            @foreach ($value as $keys => $items)
                                                <div class="sh-pro {!! convert_name($key) !!} 
                                                    @if($keys == 0)
                                                    select-color
                                                    @endif" 
                                                    value="{{ $items }}">
                                                    {{ $items }}
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex dis-flex m-t-40">
                                <button product_id="{{ $productInfor->id }}"
                                    class="add-cart flex-c-m stext-101 cl8 size-101 bg0  hov-btn1 p-lr-15 trans-04  m-r-20"
                                    style="width:45% ; border: 1px solid #FF0080;" id="add-cart">
                                    Thêm vào giỏ hàng
                                </button>
                                <button product_id="{{ $productInfor->id }}"
                                    class="add-cart flex-c-m stext-101 cl0 size-101 bg1  hov-btn1 p-lr-15 trans-04 redirect"
                                    style="width:45%" id="buy-now">
                                    Mua ngay
                                </button>
                            </div>
                            <div class="flex dis-flex m-t-40">
                                <div class="fb-like" data-href="{{ url()->current() }}" data-width=""
                                    data-layout="standard" data-action="like" data-size="large" data-share="true"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12 col-lg-8">
                    <div class="flex-w flex-m  " style="justify-content: center;">
                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                            data-tooltip="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                            data-tooltip="Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                            data-tooltip="Google Plus">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                </div>
            </div>
        </div>
    </section>
    <section class="sec-product-detail bg0 p-t-24 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4 related-products">
                    <h5 class="mtext-105 " style="padding: 20px 0px;">Sản phẩm cùng danh mục</h5>
                    <div class="row related-products-suggest">
                        @foreach ($productCate as $items)
                            <a href="{{ route('product-detail', ['id' => $items->id]) }}" class="row">
                                <img class="col-6 col-lg-6 "
                                    src="{{ url_image($items->avatar, asset('/assets/images/product-default.png')) }}"
                                    alt="al">
                                {{-- @if (percentSale($items->price, $items->saleprice) > 0)
                                    <span class="out-of-stock">-{{ percentSale($items->price, $items->saleprice) }}%
                                    </span>
                                @endif --}}
                                <div class="col-6 col-lg-6 related-products-text">
                                    <p class="related-products-text-1">{{ $cateName ?? '' }}</p>
                                    <p class="related-products-text-2">{{ $items->title }}</p>
                                    <p class="related-products-text-3">{{ number_format($items->price) }} đ</p>
                                    <p class="related-products-text-4">{{ number_format($items->saleprice) }} đ</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="pagination">
                        {{-- Customize Pagination --}}
                        @if ($productCate->hasPages())
                            <ul class="pagination" role="navigation">
                                {{-- Previous Page Link --}}
                                @if ($productCate->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true"
                                        aria-label="@lang('pagination.previous')">
                                        <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $productCate->previousPageUrl() }}" rel="prev"
                                            aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                    </li>
                                @endif

                                <?php
                                $start = $productCate->currentPage() - 1; // show 2 pagination links before current
                                $end = $productCate->currentPage() + 1; // show 2 pagination links after current
                                if ($start < 1) {
                                    $start = 1; // reset start to 1
                                    $end += 1;
                                }
                                if ($end >= $productCate->lastPage()) {
                                    $end = $productCate->lastPage();
                                } // reset end to last page
                                ?>

                                @if ($start > 1)
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="{{ $productCate->url(1) }}">{{ 1 }}</a>
                                    </li>
                                    @if ($productCate->currentPage() != 3)
                                        {{-- "Three Dots" Separator --}}
                                        <li class="page-item disabled" aria-disabled="true"><span
                                                class="page-link">...</span></li>
                                    @endif
                                @endif
                                @for ($i = $start; $i <= $end; $i++)
                                    <li class="page-item {{ $productCate->currentPage() == $i ? ' active' : '' }}">
                                        <a class="page-link"
                                            href="{{ $productCate->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                @if ($end < $productCate->lastPage())
                                    @if ($productCate->currentPage() + 3 != $productCate->lastPage())
                                        {{-- "Three Dots" Separator --}}
                                        <li class="page-item disabled" aria-disabled="true"><span
                                                class="page-link">...</span></li>
                                    @endif
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="{{ $productCate->url($productCate->lastPage()) }}">{{ $productCate->lastPage() }}</a>
                                    </li>
                                @endif

                                {{-- Next Page Link --}}
                                @if ($productCate->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $productCate->nextPageUrl() }}" rel="next"
                                            aria-label="@lang('pagination.next')">&rsaquo;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled" aria-disabled="true"
                                        aria-label="@lang('pagination.next')">
                                        <span class="page-link" aria-hidden="true">&rsaquo;</span>
                                    </li>
                                @endif
                            </ul>
                        @endif
                        {{-- {{ $productCate->onEachSide(1)->links() }} --}}
                    </div>
                </div>
                <div class="col-12 col-lg-8 detail-product" style="padding: 0px 20px;">
                    <h5 class="mtext-105 " style="padding: 20px 20px;">Chi tiết sản phẩm</h5>
                    <div>
                        {!! $productInfor->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Facebook comments -->

    <div class="container" style="margin-bottom: 30px">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%" data-numposts="10"></div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="title flex-w ">
                <h5 class="mtext-105 text-center" style="width:100%">Đề xuất theo danh mục</h5>
                <ul class="main-menu flex-c flex-w" style="width:100%">
                    @foreach ($productCategories as $item)
                        <li style="cursor: pointer" class="tab-product-cate" id-get-product="{{ $item->id }}">
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
    <!-- Footer -->
    <x-footer :categories="$productCategories" :config="$config->first()" :postPolicy="$postPolicy"/>
@endsection

@section('script-footer')
    <script src="{{ asset('assets/js/slick-custom2.js') }}"></script>
    <script>
        @foreach ($list_properties as $key => $items)
            let {!! convert_name($key) !!} = '{{ $items[0] }}';
        @endforeach
        let properties = {!! $properties !!};
        let variations = {!! $variations !!};
        let variationID = null;
        getVariations();

        if(!checkProperties()){
            variationID = variations[Object.keys(variations)[0]]["id"];
        }
        
        $(document).ready(function() {
            let data = $('.tab-product-cate').first().attr('id-get-product');
            $('span.cato-na1').first().addClass('active-cato');
            callAjax(data);

            $('.tab-product-cate').unbind().click(function(e) {
                e.preventDefault();
                $('span.cato-na1').removeClass('active-cato');
                $(this).find('a > span.cato-na1').addClass('active-cato');

                let id = $(this).attr('id-get-product');
                $('.loading').css('display', 'block');
                callAjax(id);
            });

            $('.sh-color').on('click', function() {
                var item = $('.wrap-color').find('.select-color')
                for (var i = 0; i < item.length; i++) {
                    item[i].classList.remove("select-color");
                }
                this.classList.add("select-color");
                Mau = $('.select-color').attr('propertiesvalue');
                getVariations();
            });

            @foreach ($list_properties as $key => $items)
                @if ($key == 'Màu')
                    @php
                        continue;
                    @endphp
                @endif

                $('.{!! convert_name($key) !!}').on('click', function() {
                var item = $(this).parent('.wrap-pro').find('.select-color')
                for (var i = 0; i < item.length; i++) { item[i].classList.remove("select-color"); }
                    this.classList.add("select-color"); {!! convert_name($key) !!}=$(this).attr('value'); getVariations(); });
                    @endforeach
        });

        function getVariations() {
            @foreach ($list_properties as $key => $items)
                if ({!! convert_name($key) !!} == null || {!! convert_name($key) !!} == "") {
                return false;
                }
            @endforeach
            $.each(properties, function(key, item) {
                @foreach ($list_properties as $key => $items)
                    if (!item.hasOwnProperty("{!! convert_name($key) !!}")){
                    return;
                    }
                @endforeach
                @foreach ($list_properties as $key => $items)
                    if (item.{!! convert_name($key) !!} != {!! convert_name($key) !!}){
                    return;
                    }
                @endforeach
                variationID = key;
               
                getVariationsInfor();
            });
        }

        function checkProperties(){
            var check = false;
            Object.keys(properties).map(function(item){
                if(properties[item].length > 0){
                    check = true;
                    return;
                } 
            });
            return check;
        }

        function getVariationsInfor() {
            $('.cost-prices').text(variations[variationID].price + " đ");
            $('.sale-prices').text(variations[variationID].saleprice + " đ");
        }

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

        // add cart
       
    </script>
@endsection
