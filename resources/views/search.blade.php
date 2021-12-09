@extends('layouts.site', [
'title'=> "Tìm kiếm",
'description' => $config->first()->con_meta_description,
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
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg ">
            <a href="{{ url('/') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ 
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Tìm Kiếm
            </span>
        </div>
    </div>

    <div class="category-area m-t-20">
        <div class="container">
            <div class="row">
                @foreach ($cate as $ct)
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12 m-t-40">
                        <div class="row">
                            <div class="col-md-12 col-lg-4 col-sm-12 col-12">
                                <a href="{{ route('product.listing', ['id' => $ct->id]) }}">
                                    <img src="{{ url_image($ct->code) }}" alt="{{ $ct->name }}"
                                        class="icon-c">
                                    <span class="cato-na head-cato">{{ $ct->name }}</span>
                                </a>
                            </div>
                        </div>

                        <div id="example">
                            <div class="row check">
                                @foreach ($product as $pro)
                                    @if ($ct->id == $pro->product_categories_id)
                                        <div class="col-md-4 col-md-4 col-sm-6 col-6 fix-item">
                                            <div class="block2-pic hov-img0" style="height: auto !important">
                                                <a href="{{ route('product-detail', ['id' => $pro->id]) }}">
                                                    <img style="width: 100%; height: auto !important" src="{{ url_image($pro->avatar) }}"
                                                        alt="IMG-PRODUCT">
                                                </a>
                                                @if ($pro->avatar2 != '' && $pro->avatar2 != null)
                                                    <div class="product-alt-img">
                                                        <a href="{{ route('product-detail', ['id' => $pro->id]) }}">
                                                            <img src=" {{ url_image($pro->avatar2) }} "
                                                                alt="ALT-IMG-PRODUCT">
                                                        </a>
                                                    </div>
                                                @endif
                                                @if (percentSale($pro->price, $pro->saleprice) > 0)
                                                    <span
                                                        class="out-of-stock">-{{ percentSale($pro->price, $pro->saleprice) }}%
                                                    </span>
                                                @endif
                                                <div class="product-btn-group">
                                                    <div class="row">
                                                        <div class="product-btn-more col-lg-6 col-md-6 col-sm-12 col-12">
                                                            <a href="{{ route('product-detail', ['id' => $pro->id]) }}"
                                                                class="block2-btn block2-btn-new js-show-modal1">
                                                                Xem ngay
                                                            </a>
                                                        </div>
                                                        <div class="product-btn-add col-lg-6 col-md-6 col-sm-12 col-12">
                                                            <a href="{{ route('product-detail', ['id' => $pro->id]) }}"
                                                                class="block2-btn block2-btn-new js-show-modal1">
                                                                Thêm sản phẩm
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="product-content">
                                                <p class="product-title-1">{{ $ct->name }}</p>
                                                <h3><a
                                                        href="{{ route('product-detail', ['id' => $pro->id]) }}">{{ $pro->title }}</a>
                                                </h3>
                                                <div class="product-price">
                                                    <span
                                                        class="old">{{ number_format($pro->price, 0, ',', '.') }}đ</span><br>
                                                    <span>{{ number_format($pro->saleprice, 0, ',', '.') }}đ</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <x-footer :categories="$productCate" :config="$config->first()" :postPolicy="$postPolicy"/>
@endsection

@section('script-footer')
    <script>
        $(document).ready(function() {
            let check = $('.check');
            check.each(function() {
                if ($(this).find('.fix-item').length == 0) {
                    let elementNone = $(this).parent().siblings('.row').parent();
                    elementNone.remove();
                }
            })
        });
    </script>
@endsection
