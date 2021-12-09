@extends('layouts.site', [
'title'=>"Đăng nhập",
'description' => $config->first()->con_meta_description??"",
'image' => asset('assets/images/logo/logo.png'),
'config' => $config,
'shop' => $shop
])
@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="login-left-container col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="login-left left-signin left-active">
                    <h1> Đăng nhập </h1>
                    <p>
                        Đăng nhập để theo dõi đơn hàng, lưu danh sách sản phẩm yêu thích,
                        nhận nhiều ưu đãi hấp dẫn.
                    </p>

                    <div class="login-image">
                        <img src="{{ asset('resources/images/login-image.png') }}" alt="login image">
                    </div>
                </div>

                <div class="login-left left-signup">
                    <h1> Tạo tài khoản </h1>
                    <p>
                        Tạo tài khoản để theo dõi đơn hàng, lưu danh sách sản phẩm yêu thích,
                        nhận nhiều ưu đãi hấp dẫn.
                    </p>

                    <div class="login-image">
                        <img src="{{ asset('resources/images/login-image.png') }}" alt="login image">
                    </div>
                </div>
            </div>

            <div class="login-right-container col-lg-7 col-md-7 col-sm-12 col-12">
                <div class="login-right">
                    <div class="login-tabs">
                        <ul id="tabs" class="list-login">
                            <li>
                                <a id="tab_login">
                                    Đăng nhập
                                </a>
                            </li>

                            <li>
                                <a id="tab_signup">
                                    Tạo tài khoản
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div id="tab_login_hide" class="login-container">
                        <form method="POST">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-12 col-12" style="padding-right: 0">
                                        <label for="cc-payment" class="control-label mb-1 login-text"> Email/Số điện thoại
                                        </label>
                                    </div>

                                    <div class="col-lg-10 col-md-9 col-sm-12 col-12">
                                        <input id="username_input" name="username_input" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false"
                                            placeholder="Nhập email/số điện thoại">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: -3px">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-12 col-12" style="padding-right: 0">
                                        <label for="cc-payment" class="control-label mb-1 login-text"> Mật khẩu </label>
                                    </div>

                                    <div class="col-lg-10 col-md-9 col-sm-12 col-12">
                                        <input id="password_input" name="password_input" type="password"
                                            class="form-control" aria-required="true" aria-invalid="false"
                                            placeholder="Nhập mật khẩu">
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-lg-10 col-md-10 col-sm-12 col-12" style="padding-left: 35px">
                                    <div class="row remember-check">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-check">
                                                <input id="remember_login" class="form-check-input" type="checkbox" value=""
                                                    id="rememberCheck">
                                                <label class="form-check-label" for="rememberCheck">
                                                    Ghi nhớ?
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <a id="forgot_password" href="javascript:void(0)" target="_self"
                                                style="float: right">
                                                Quên mật khẩu?
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-end" style="margin-top: 8px;">
                                <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                                    <button id="login_btn" class="login-btn"> Đăng nhập </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="tab_signup_hide" class="login-container">
                        <form method="POST">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-12 col-12" style="padding-right: 0">
                                        <label for="cc-payment" class="control-label mb-1 login-text">
                                            Tên đăng nhập
                                            <span class="red-text"> &#42; </span>
                                        </label>
                                    </div>

                                    <div class="modal-account-content col-lg-10 col-md-9 col-sm-12 col-12">
                                        <input id="name_input" name="name_input" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" placeholder="Nhập họ tên">
                                        <div id="modal-account-name">
                                            <small class="text-danger modal-alert-position"> Tên đăng nhập không được để
                                                trống </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: -3px">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-12 col-12" style="padding-right: 0">
                                        <label for="cc-payment" class="control-label mb-1 login-text">
                                            Mật khẩu
                                            <span class="red-text"> &#42; </span>
                                        </label>
                                    </div>

                                    <div class="modal-account-content col-lg-10 col-md-9 col-sm-12 col-12">
                                        <input id="pass_input" name="pass_input" type="password" class="form-control"
                                            aria-required="true" aria-invalid="false" placeholder="Nhập mật khẩu">
                                        <div id="modal-account-password">
                                            <small class="text-danger modal-alert-position"> Mật khẩu không được để trống
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: -3px">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-12 col-12" style="padding-right: 0">
                                        <label for="cc-payment" class="control-label mb-1 login-text">
                                            Xác nhận mật khẩu
                                            <span class="red-text"> &#42; </span>
                                        </label>
                                    </div>

                                    <div class="modal-account-content col-lg-10 col-md-9 col-sm-12 col-12">
                                        <input id="pass_verify_input" name="pass_verify_input" type="password"
                                            class="form-control" aria-required="true" aria-invalid="false"
                                            placeholder="Xác thực lại mật khẩu">
                                        <div id="modal-account-password-main">
                                            <small class="text-danger modal-alert-position"> Mật khẩu không trùng khớp
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: -3px">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-12 col-12" style="padding-right: 0">
                                        <label for="cc-payment" class="control-label mb-1 login-text">
                                            Số điện thoại
                                            <span class="red-text"> &#42; </span>
                                        </label>
                                    </div>

                                    <div class="modal-account-content col-lg-10 col-md-9 col-sm-12 col-12">
                                        <div class="input-btn-form">
                                            <input id="phone_input" name="phone_input" type="text" class="form-control"
                                                aria-required="true" aria-invalid="false" placeholder="Nhập số điện thoại">
                                        </div>
                                        <div id="modal-account-tele">
                                            <small class="text-danger modal-alert-position"> Số điện thoại không được để
                                                trống </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: -3px">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-12 col-12" style="padding-right: 0">
                                        <label for="cc-payment" class="control-label mb-1 login-text">
                                            E-mail
                                            <span class="red-text"> &#42; </span>
                                        </label>
                                    </div>

                                    <div class="modal-account-content col-lg-10 col-md-9 col-sm-12 col-12">
                                        <input id="mail_input" name="mail_input" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" placeholder="Nhập email">
                                        <div id="modal-account-email">
                                            <small class="text-danger modal-alert-position"> Email không được để trống
                                                </sma>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: -3px">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-12 col-12" style="padding-right: 0">
                                        <label for="cc-payment" class="control-label mb-1 login-text">
                                            Địa chỉ
                                            <span class="red-text"> &#42; </span>
                                        </label>
                                    </div>

                                    <div class="modal-account-content col-lg-10 col-md-9 col-sm-12 col-12">
                                        <input id="address_input" name="address_input" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" placeholder="Nhập họ tên">
                                        <div id="modal-account-address">
                                            <small class="text-danger modal-alert-position"> Địa chỉ không được để trống
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button id="signup_btn" class="login-btn"> Đăng ký </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
