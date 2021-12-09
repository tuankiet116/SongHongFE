@extends('layouts.site',[
'title'=>"Thanh Toán",
'description' => $config->first()->con_meta_description,
'image' => asset('assets/images/logo/logo.png'),
'config' => $config,
'shop' => $shop
])

@section('script-header')
    <script src="./assets/api/payment.js"></script>
    <script>
        let shopID = {{ $shop->id }};
    </script>
@endsection
@section('main')
    <x-header :categories="$productCate" :phone="$config->first()->con_hotline" :messenger="$config->first()->script_facebook" />

    <!-- breadcrumb -->
    <div class="container search-bar-mobile ">
        {{-- <div class="search-bar-top  " >
			<form class="search-bar">
				<input name="search" placeholder="Tìm kiếm" type="search" style="position: absolute;">
				<select >
					<option selected="selected" disabled >Tất cả danh mục</option>
					<option>watch</option>
					<option>mobile</option>
					<option>kid’s item</option>
				</select>
				<button class="btnn"><i class="ti-search"></i></button>
			</form>
		</div> --}}
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg ">
            <a href="{{ url('/') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ url('/gio-hang') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Giỏ hàng
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Thanh toán
            </span>
        </div>
    </div>

    <form class="bg0 p-t-30 p-b-85">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl bor15 checkout">
                        <div class="single-widget">
                            <h2>Nhập thông tin thanh toán</h2>
                        </div>
                        <form class="form" method="post" action="#">
                            <div class="row" style="padding:20px 20px ;">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Họ và tên<span>*</span></label>
                                        <input type="text" id="name" name="name" placeholder="" required="required"
                                            style="width:100%">
                                    </div>
                                    <small id="small-name" style="color: red; display:none;">Cần điền đầy đủ thông tin họ tên</small>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Số điện thoại<span>*</span></label>
                                        <input type='text' id="phone" name="phone" placeholder="" required="required"
                                            style="width:100%" >
                                    </div>
                                    <small id="small-phone" style="color: red; display:none;">Số điện thoại không hợp lệ</small>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Email<span>*</span></label>
                                        <input type='email' id="email" name="email" placeholder="" required="required"
                                            style="width:100%" >
                                    </div>
                                    <small id="small-email" style="color: red; display:none;">Email không hợp lệ</small>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Tỉnh / Thành phố<span>*</span></label>
                                        <select name="state-province" id="state-province">
                                            <option value="#">-- Chọn thành phố --</option>
                                        </select>
                                    </div>
                                    <small id="small-state-province" style="color: red; display:none;">Cần điền đầy đủ thông tin thành phố</small>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label value="#">Quận/ Huyện<span>*</span></label>
                                        <select name="district" id="district">
                                            <option>-- Chọn quận/huyện --</option>
                                        </select>
                                    </div>
                                    <small id="small-district" style="color: red; display:none;">Cần điền đầy đủ thông tin quận/huyện</small>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label value="#">Phường/ Xã<span>*</span></label>
                                        <select name="ward" id="ward">
                                            <option>-- Chọn phường/xã --</option>
                                        </select>
                                    </div>
                                    <small id="small-ward" style="color: red; display:none;">Cần điền đầy đủ thông tin phường/xã</small>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12" style="margin-top: 20px">
                                    <div class="form-group">
                                        <label>Địa chỉ nhận hàng<span>*</span></label>
                                        <input type="text" id="address" name="address" placeholder="" required="required"
                                            style="width:100%">
                                    </div>
                                    <small id="small-address" style="color: red; display:none;">Cần điền đầy đủ thông tin địa chỉ</small>
                                </div>

                            </div>
                        </form>
                        <div class="flex-w flex-sb-m bor18  p-b-15 p-lr-40 p-lr-15-sm">
                            <div class="single-widget" style="width:100%">
                                <h3>Phương thức thanh toán</h3>
                                <div class="payment-type content row">
                                    <div class="col-12 col-lg-4">
                                        <label class="container-xx ">COD
                                            <input type="radio" name="dd" id="cod" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label class="container-xx">Thanh toán VNPAY
                                            <input type="radio" name="dd" id="vnpay">
                                            <span class="checkmark"></span>
                                            <div class="single-widget payement">
                                                <div class="content dis-flex ">
                                                    <a href="#">
                                                        <img src="{{ asset('assets/images/logo/vnpay.png') }}" alt="#"
                                                            style="width:80px;height:40px">
                                                    </a>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label class="container-xx">Thanh toán MOMO
                                            <input type="radio" name="dd" id="momo">
                                            <span class="checkmark"></span>
                                            <div class="single-widget payement">
                                                <div class="content dis-flex">
                                                    <a href="#">
                                                        <img src="{{ asset('assets/images/logo/logo-momo.png') }}" alt="#"
                                                            style="width:40px;height:40px;margin-right: 5px;">
                                                    </a>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Order Widget -->
                            <!-- Payment Method Widget -->

                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm checkout ">
                        <div class="order-details">
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>Liên Hệ Mua Hàng</h2>
                                <div class="content">
                                    <div class="order-item-content">
										<ul>
										</ul>
									</div>
                                    <ul>

                                        <li style="display: flex;">
                                            <div style="width:30%;padding-right: 4px;">Tạm tính </div>
                                            <div class="total-price" style="width:68%;color: #FF4764;">0đ</div>
                                        </li>
                                        <li style="display: flex;">
                                            <div style="width:30%;padding-right: 4px;">Vận chuyển </div>
                                            <div style="width:68%">------------</div>
                                        </li>
                                        <li class="last" style="display: flex;">
                                            <div style="width:30%;padding-right: 4px;">Tổng tiền </div>
                                            <div class="total-price" style="width:68% ; font-size: 1.3em;font-weight: 700;color: #FF4764;">
                                                0đ</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="single-widget get-button p-b-10">
                                <div class="content">
                                    <div class="button-payment">
                                        <a href="#" class="btn">Liên Hệ Mua Hàng</a>
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
            <div class="loading"></div>
        </div>
    </form>

    <x-footer :categories="$productCate" :config="$config->first()" :postPolicy="$postPolicy"/>
@endsection
