@extends('layouts.site',[
'title'=>$current_name,
'description' => $config->first()->con_meta_description,
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
                    "name": "{{ $current_name }}"
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
        <div class="bread-crumb flex-w  p-r-15 p-t-30 p-lr-0-lg bread-mb ">
            <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ 
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="#" class="stext-109 cl8 hov-cl1 trans-04">
                {{ $current_name }}
            </a>
        </div>
    </div>

    <div class="category-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-md-3 col-sm-12 col-3">
                    <p id="category-title">DANH MỤC</p>
                    <div class="tree ">
                        <ul>
                            @if (isset($categoryInfo) && isset($categoryInfo->getRelations()['ref_category_lv1']))
                                @foreach ($categoryInfo->getRelations()['ref_category_lv1'] as $key => $value)
                                    <li>
                                        <a href="{{ route('product.lv1', ['id' => $value->id]) }}">
                                            <span @if ($type == 'lv1' && $current_id == $value->id) class="active-cato" @endif>
                                                {{ $value->name_sub_category }}
                                                @if (isset($value->getRelations()['ref_category_lv2']) && sizeof($value->getRelations()['ref_category_lv2']) > 0)
                                                    <i class="fa fa-minus" style="margin-left:20px"></i>
                                                @endif
                                            </span>
                                        </a>
                                        @if (isset($value->getRelations()['ref_category_lv2']))
                                            <ul>
                                                @foreach ($value->getRelations()['ref_category_lv2'] as $keylv2 => $valuelv2)
                                                    <li>
                                                        <a href="{{ route('product.lv2', ['id' => $valuelv2->id]) }}">
                                                            <span @if ($type == 'lv2' && $current_id == $valuelv2->id) class="active-cato" @endif>
                                                                {{ $valuelv2->name_sub_category }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <form id="formFilter" method="GET">
                        <input type="hidden" id="order" name="order" value="{{ $oldValue['order'] ?? '' }}">
                        <p id="category-title">KHOẢNG GIÁ</p>
                        <div class="checkbox-list">
                            @php
                                $arr_price = [
                                    'all' => 'Tất cả',
                                    '200000to300000' => '200.000 đến 300.000',
                                    '300000to500000' => '300.000 đến 500.000',
                                    '500000to1000000' => '500.000 đến 1.000.000',
                                    '1000000to1500000' => '1.000.000 đến 1.500.000',
                                    '1500000' => 'Trên 1.500.000',
                                ];
                            @endphp
                            @foreach ($arr_price as $key => $value)
                                <input class="checkbox" type="checkbox" class="checkbox-price" name="price"
                                    value="{{ $key }}" @if (isset($oldValue['price']) && $oldValue['price'] == $key)
                                checked
                            @endif>
                            <label for="alls">&nbsp {{ $value }}</label><br>
                            @endforeach
                            <input type="submit" style="display: none" />

                        </div>

                        @foreach ($properties as $key => $value)
                            <p id="category-title">{!! $key !!}</p>
                            <div class="checkbox-list">
                                <input type="checkbox" class="{{ convert_name($key) }} checkbox"
                                    name="{{ $key }}" value="all" @if (isset($oldValue[preg_replace('/\s+/', '_', $key)]) && is_array($oldValue) && sizeof($oldValue) > 0 && $oldValue[preg_replace('/\s+/', '_', $key)] == 'all')
                                checked
                        @endif>
                        <label for="alls">&nbsp Tất cả</label><br>
                        @foreach ($value as $property)
                            <input type="checkbox" class="{{ convert_name($key) }} checkbox" name="{{ $key }}"
                                value="{{ $property }}" @if (isset($oldValue[preg_replace('/\s+/', '_', $key)]) && is_array($oldValue) && sizeof($oldValue) > 0 && $oldValue[preg_replace('/\s+/', '_', $key)] == trim(preg_replace('/\s+/', ' ', $property)))
                            checked
                        @endif>
                        <label for="alls">&nbsp {{ $property }}</label><br>
                        @endforeach
                        <input type="submit" style="display: none" />
                </div>

                @endforeach
                </form>
            </div>
            <div class="col-md-12 col-lg-9 col-sm-12 col-12">
                <div class="row">
                    <div class="col-md-12 col-lg-8 col-sm-12 col-12" style="padding-top: 35px !important">
                        <a href="{{ route('product.listing', ['id' => $categoryInfo->id]) }}">
                            <img src="{{ url_image($categoryInfo->code) }}" alt="" class="icon-c">
                            <span class="cato-na head-cato">{{ $categoryInfo->name }}</span>
                            @if ($type != 'lv0')
                                <p class="subject-name">{{ $current_name }}</p>
                            @endif
                        </a>
                    </div>

                    <div class="col-md-12 col-lg-4 col-sm-12 col-12">
                        <div class="row">

                            <div class="col-lg-12 col-sm-8 col-md-6 col-8">
                                <div class="form-group checkout product-cate-sel">
                                    <select name="order" id="orderForm">
                                        <option value="all" selected>
                                            Sắp xếp: &nbsp<b>Tất cả</b>
                                        </option>
                                        <option value="orderLowHight" @if (isset($oldValue['order']) && $oldValue['order'] == 'orderLowHight')
                                            selected
                                            @endif>Giá từ thấp đến cao</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="example">
                    <div class="row">
                        @if (isset($products))
                            @foreach ($products as $key => $value)
                                <div class="col-md-4 col-md-4 col-sm-6 col-6 fix-item ">
                                    <div class="block2-pic hov-img0" style="height: auto !important">
                                        <a href="{{ route('product-detail', ['id' => $value->id]) }}">
                                            <img style="height: auto !important; width: 100%;"
                                                src="{{ url_image($value->avatar) }}" alt="IMG-PRODUCT">
                                            @if ($value->avatar2 != '' && $value->avatar2 != null)
                                                <div class="product-alt-img">
                                                    <img src=" {{ url_image($value->avatar2) }} " alt="ALT-IMG-PRODUCT" style="height: auto !important">
                                                </div>
                                            @endif
                                        </a>
                                        @if (percentSale($value->price, $value->saleprice) > 0)
                                            <span
                                                class="out-of-stock">-{{ percentSale($value->price, $value->saleprice) }}%
                                            </span>
                                        @endif
                                        <div class="product-btn-group">
                                            <div class="row">
                                                <div class="product-btn-more col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <a href="{{ route('product-detail', ['id' => $value->id]) }}"
                                                        class="block2-btn block2-btn-new js-show-modal1">
                                                        Xem ngay
                                                    </a>
                                                </div>
                                                <div class="product-btn-add col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <a href="{{ route('product-detail', ['id' => $value->id]) }}"
                                                        class="block2-btn block2-btn-new js-show-modal1">
                                                        Thêm sản phẩm
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="product-content">
                                        <p class="product-title-1">{{ $categoryInfo->name }}</p>
                                        <a href="{{ route('product-detail', ['id' => $value->id]) }}">
                                            <h3 style="font-size: 1.4em;">{{ $value->title }}</h3>
                                        </a>
                                        <div class="product-price">
                                            <span class="old">{{ number_format($value->price) }} đ</span><br>
                                            <span>{{ number_format($value->saleprice) }} đ</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{ $products->appends(request()->input())->links() }}
                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>
    <x-footer :categories="$productCate" :config="$config->first()" :postPolicy="$postPolicy"/>
@endsection

@section('script-footer')
    <script src="{{ asset('/assets/js/tree-category.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.checkbox').on('change', function() {
                if ($(this).attr('checked') == 'checked') {
                    $(this).siblings('input[type=checkbox]').prop('checked', false);
                    $(this).siblings('input[type=submit]').click();
                    return;
                }
                $(this).siblings('input[type=checkbox]').prop('checked', false);
                $(this).prop('checked', true);
                $(this).siblings('input[type=submit]').click();
            });

            $('#orderForm').on('change', function() {
                $('#order').val($('#orderForm').val())
                $('#formFilter').submit();
            })
        });
    </script>
@endsection
