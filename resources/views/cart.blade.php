@extends('layouts.site', [
'title'=>'Giỏ hàng',
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
        <div class="search-bar-top  " >
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
                Giỏ hàng
            </span>
        </div>
    </div>

    <form class="bg0 p-t-30 p-b-85" method="POST" action="{{ route('payment') }}">
        @csrf
        {{ method_field('POST') }}
        <div class="container">
            <div class="row" id="main-cart">
                <div class="col-12 col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="cart-container m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <thead>
                                    <tr class="table_head">
                                        <th></th>
                                        <th class="column-1">Sản phẩm</th>
                                        <th class="column-2" style="padding-right: 20px"></th>
                                        <th class="column-2">thuộc tính</th>
                                        <th class="column-3">Số lượng</th>
                                        <th class="column-4 text-center">Giá</th>
                                        <th class="column-5">Tổng tiền</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50" >
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm checkout">
                        <div class="order-details">
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>Thanh toán</h2>
                                <div class="content">
                                    <ul>

                                        <li style="display: flex;">
                                            <div style="width:30%;padding-right: 4px;">Tạm tính </div>
                                            <div style="width:68%;color: #FF4764;" class="total-cart"></div>
                                        </li>
                                        <li style="display: flex;">
                                            <div style="width:30%;padding-right: 4px;">Vận chuyển </div>
                                            <div style="width:68%">------------</div>
                                        </li>
                                        <li class="last" style="display: flex;">
                                            <div style="width:30%;padding-right: 4px;">Tổng tiền </div>
                                            <div style="width:68% ; font-size: 1.3em;font-weight: 700;color: #FF4764;" class="total-cart">
                                                </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/ End Order Widget -->


                            <!-- Button Widget -->
                            <div class="single-widget get-button">
                                <div class="content">
                                    <div class="button">
                                        <button id="payment-redirect" type="submit" class="btn">Mua Hàng</button>
                                    </div>
                                </div>
                            </div>
                            <div class="p-b-20">

                            </div>
                            <!--/ End Button Widget -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

    <x-footer :categories="$productCate" :config="$config->first()" :postPolicy="$postPolicy"/>
@endsection


