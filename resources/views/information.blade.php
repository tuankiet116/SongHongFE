@extends('layouts.site',[
'title'=>"Thông tin tài khoản",
'description' => $config->first()->con_meta_description,
'image' => asset('assets/images/logo/logo.png'),
'config' => $config,
'shop' => $shop
])
@section('script-header')
    <script src="{{ asset('/assets/api/orderHistory.js') }}"></script>
    <script src="assets/api/userInformation.js"></script>
@endsection
@section('main')
    <x-header :categories="$productCate" :phone="$config->first()->con_hotline"
        :messenger="$config->first()->script_facebook" />

    <form class="bg0 p-t-30 p-b-85">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-3 col-lg-3 col-md-3 col-sm-12 m-lr-auto m-b-50">
                    <div class="bor10 checkout ">
                        <div class="order-details">
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>Cài đặt</h2>
                                <div class="content">
                                    <ul id="tabs">
                                        <li>
                                            <p id="tab_profile">
                                                <i class="ti-id-badge"></i>
                                                Thông tin cá nhân
                                            </p>
                                        </li>

                                        <li>
                                            <p id="tab_edit">
                                                <i class="ti-pencil-alt"></i>
                                                Chỉnh sửa
                                            </p>
                                        </li>

                                        <li>
                                            <p id="tab_status">
                                                <i class="ti-shopping-cart-full"></i>
                                                Lịch sử đơn hàng
                                            </p>
                                        </li>

                                        <li>
                                            <p id="tab_pass">
                                                <i class="ti-unlock"></i>
                                                Đổi mật khẩu
                                            </p>
                                        </li>

                                        <li>
                                            <p id="tab_logout">
                                                <i class="ti-back-right"></i>
                                                Đăng xuất
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="p-b-20">

                            </div>
                            <!--/ End Button Widget -->
                        </div>

                    </div>
                </div>

                <div class="col-12 col-sm-12 col-lg-9 col-xl-9 col-md-9 m-lr-auto m-b-50">
                    <div id="tab_profile_hide" class="bor15 checkout profile-container">
                        <div class="single-widget">
                            <h2> Thông tin cá nhân </h2>
                        </div>

                        <div class="row profile-content">
                            <div class="profile-box col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="profile-info">
                                    <p class="profile-title">
                                        <i class="ti-user"></i>
                                        Tài khoản:
                                    </p>

                                    <p id="username" class="profile-text"></p>
                                </div>
                            </div>

                            <div class="profile-box col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="profile-info">
                                    <p class="profile-title">
                                        <i class="ti-email"></i>
                                        Email:
                                    </p>

                                    <p id="useremail" class="profile-text"></p>
                                </div>
                            </div>

                            <div class="profile-box col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="profile-info">
                                    <p class="profile-title">
                                        <i class="ti-mobile"></i>
                                        Số điện thoại:
                                    </p>

                                    <p id="userphone" class="profile-text"></p>
                                </div>
                            </div>

                            <div class="profile-box col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="profile-info">
                                    <p class="profile-title">
                                        <i class="ti-map-alt"></i>
                                        Địa chỉ:
                                    </p>

                                    <p id="useraddress" class="profile-text"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab_edit_hide" class="bor15 checkout profile-container">
                        <div class="single-widget">
                            <h2> Chỉnh sửa thông tin </h2>
                        </div>

                        <div class="profile-content">
                            <form class="form" method="post" action="#">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group profile-edit">
                                            <label>
                                                <i class="ti-email"></i>
                                                Email:
                                            </label>
                                            <input type="text" id="profile_email" name="profile_email" placeholder=""
                                                required="required" style="width:100%">
                                            <small id="small-email" style="color: red; display:none;">
                                                Email không hợp lệ.
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group profile-edit">
                                            <label>
                                                <i class="ti-mobile"></i>
                                                Số điện thoại:
                                            </label>
                                            <input type='text' id="profile_phone" name="profile_phone" placeholder=""
                                                required="required" style="width:100%">
                                            <small id="small-phone" style="color: red; display:none;">Số điện thoại không
                                                hợp lệ</small>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group profile-edit">
                                            <label>
                                                <i class="ti-map-alt"></i>
                                                Địa chỉ:
                                            </label>
                                            <input type='text' id="profile_address" name="profile_address" placeholder=""
                                                required="required" style="width:100%">
                                            <small id="small-address" style="color: red; display:none;">Cần điền đầy đủ địa
                                                chỉ</small>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="single-widget get-button" style="margin-top: 20px; margin-bottom: 55px">
                                            <div class="content">
                                                <div class="button">
                                                    <button type="submit" id="edit-profile-btn" class="btn profile-btn">
                                                        <i class="ti-pencil-alt" style="margin-right: 8px"></i>
                                                        Cập nhật
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="tab_status_hide" class="bor15 checkout profile-container">
                        <div class="single-widget">
                            <h2> Lịch sử đơn hàng </h2>
                        </div>

                        <div class="profile-status-container">
                            <div id="tabs_status" class="row profile-list-status">
                                <div id="tab_status_wait_check" class="col-lg-3 col-md-3 col-sm-6 col-6 get-order" status="unpaid">
                                    <p>Chờ xác nhận</p>
                                </div>

                                <div id="tab_status_wait_get" class="col-lg-3 col-md-3 col-sm-6 col-6 get-order" status="shipwait">
                                    <p>Chờ lấy hàng</p>
                                </div>

                                <div id="tab_status_delivered" class="col-lg-3 col-md-3 col-sm-6 col-6 get-order" status="paid">
                                    <p>Đã giao hàng</p>
                                </div>

                                <div id="tab_status_wait_cancel" class="col-lg-3 col-md-3 col-sm-6 col-6 get-order" status="cancel">
                                    <p>Hủy</p>
                                </div>
                            </div>

                            <div id="tab_status_wait_check_hide" class="profile-status-tab-content">
                               {{-- unpaid --}}
                            </div>

                            <div id="tab_status_wait_get_hide" class="profile-status-tab-content">
                                {{-- shipwait --}}
                            </div>

                            <div id="tab_status_delivered_hide" class="profile-status-tab-content">
                                {{-- paid --}}
                            </div>

                            <div id="tab_status_wait_cancel_hide" class="profile-status-tab-content">
                                {{-- cancel --}}
                            </div>

                        </div>
                    </div>

                    <div id="tab_pass_hide" class="bor15 checkout profile-container">
                        <div class="single-widget">
                            <h2> Đổi mật khẩu </h2>
                        </div>

                        <div class="profile-content">
                            <form class="form" method="post" action="#">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group profile-edit">
                                            <label>
                                                <i class="ti-unlock"></i>
                                                Mật khẩu cũ:
                                            </label>
                                            <input type="password" id="profile_old_pass" name="profile_old_pass" placeholder=""
                                                required="required" style="width:100%">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group profile-edit">
                                            <label>
                                                <i class="ti-lock"></i>
                                                Mật khẩu mới:
                                            </label>
                                            <input type='password' id="profile_new_pass" name="profile_new_pass" placeholder=""
                                                required="required" style="width:100%">
                                            <small id="small-new-password" style="color: red; display:none;">
                                                Mật khẩu phải lớn hơn 8 kí tự.
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group profile-edit">
                                            <label>
                                                <i class="ti-lock"></i>
                                                Nhập lại mật khẩu mới:
                                            </label>
                                            <input type='password' id="profile_repeat_pass" name="profile_repeat_pass"
                                                placeholder="" required="required" style="width:100%">
                                            <small id="small-password" style="color: red; display:none;">
                                                Mật khẩu không khớp.
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="single-widget get-button"
                                            style="margin-top: 20px; margin-bottom: 55px">
                                            <div class="content">
                                                <div class="button">
                                                    <button id="btn-change-password" type="button" class="btn profile-btn">
                                                        <i class="ti-pencil-alt" style="margin-right: 8px"></i>
                                                        Thay đổi
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <x-footer :categories="$productCate" :config="$config->first()" :postPolicy="$postPolicy" />
@endsection
