@extends('layouts.site',[
'title'=>"Tra cứu tình trạng đơn hàng",
'description' => $config->first()->con_meta_description,
'image' => asset('assets/images/logo/logo.png'),
'config' => $config,
'shop' => $shop
])
@section('script-header')
    <script src="/assets/api/orderSearch.js"></script>
@endsection
@section('main')
    <x-header :categories="$productCate" :phone="$config->first()->con_hotline"
        :messenger="$config->first()->script_facebook" />

    <div class="container">
        <p class="order-status-title">Tra cứu tình trạng đơn hàng</p>
        <p class="order-status-note">(Dành cho đơn hàng Online!)</p>
        <p class="order-status-sub">Điền các thông tin bên dưới để tra cứu tình trạng đơn hàng</p>

        <form method="" action="">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-12 col-12">
                    <div class="form-group order-form">
                        <label>Địa chỉ email</label>
                        <input id="email-order" type="text" name="order_email">
                    </div>
                </div>

                <div class="or-content col-lg-1 col-md-1 col-sm-12 col-12">
                    <p class="order-or"> Hoặc </p>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-12 col-12">
                    <div class="form-group order-form">
                        <label>Số điện thoại</label>
                        <input id="phone-order" type="text" name="order_phone">
                    </div>
                </div>

                <div class="or-content col-lg-1 col-md-1 col-sm-12 col-12">
                    <p class="order-or"> Hoặc </p>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-12 col-12">
                    <div class="form-group order-form">
                        <label>Mã đơn hàng</label>
                        <input id="code-order" type="text" name="order_code">
                    </div>
                </div>

                <div class="btn-content col-lg-1 col-md-1 col-sm-12 col-12">
                    <button type="button" class="order-check-btn" name="order_check_btn">
                        Kiểm tra
                    </button>
                </div>
            </div>
        </form>

        <p class="order-status-suggest">
            Bật mí: khi bạn <span class="span-login">Đăng nhập</span>, tính năng kiểm tra đơn hàng sẽ tự động tra cứu thông tin đơn hàng gần
            nhất
        </p>
        <div class="main">

        </div>
    </div>

    <x-footer :categories="$productCate" :config="$config->first()" :postPolicy="$postPolicy" />
@endsection
