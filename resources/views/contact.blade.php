@extends('layouts.site',[
'title'=>"Liên hệ",
'description' => $config->first()->con_info_company,
'image' => asset('assets/images/logo/logo.png'),
'config' => $config,
'shop' => $shop
])

@section('script-header')
    <script src="{{ asset('/assets/api/contact.js') }}"></script>
@endsection
@section('main')
    <x-header :categories="$productCate" :phone="$config->first()->con_hotline"
        :messenger="$config->first()->script_facebook" />
    <x-cart />

    <!-- breadcrumb -->
    <div class="container search-bar-mobile ">
        <div class="search-bar-top  ">
            <form class="search-bar" action="{{ route('search') }}" method="POST">
                @csrf
                {{ method_field('post') }}
                <input name="keyword" placeholder="Tìm kiếm" type="search" style="position: absolute;">
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
        <div class="container m-t-30 m-b-30">
            <div class="contact">
                <h2> Công ty TNHH Sông Hồng beddings </h2>

                <div class="contact-container row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <h5>Công ty TNHH Sông Hồng beddings</h5>
                        <p>
                            <i class="ti-location-pin"></i>
                            SHOWROOM 1: 84 LÒ ĐÚC - PHẠM ĐÌNH HỔ - HAI BÀ TRƯNG - HN
                        </p>
                        <p>
                            <i class="ti-mobile"></i>
                            <a href="tel:024.62942535">024.62942535</a>
                        </p>
                        <p>
                            <i class="ti-email"></i>
                            songhong@gmail.com
                        </p>
                        <p>
                            <span>
                                <i class="ti-world"></i>
                                <a href="{{route('home')}}">songhonghn.com</a>
                            </span>
                        </p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <h5>Công ty TNHH Sông Hồng beddings</h5>
                        <p>
                            <i class="ti-location-pin"></i>
                            SHOWROOM 2: 84 VŨ PHẠM HÀM - TRUNG HOÀ - CẦU GIẤY - HN
                        </p>
                        <p>
                            <i class="ti-mobile"></i>
                            <a href="tel:024.38398967">024.38398967</a>
                        </p>
                    </div>
                </div>

                <h5 style="margin-top: 35px">Ðể lại thông tin liên hệ với chúng tôi</h5>

                <div method="" action="">
                    <div class="row contact-form">
                        <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                            <div class="wrap-input-contact">
                                <input type="text" name="contact_name" placeholder="Họ và tên" id="name-cus" style="margin-bottom: 0">
                                <small id="small-name-cus" style="color: red; display:none;">Cần điền đầy đủ thông tin họ tên</small>
                            </div>

                            <div class="wrap-input-contact">
                                <input type="text" name="contact_phone" placeholder="Số điện thoại" id="phone-cus" style="margin-bottom: 0">
                                <small id="small-phone-cus" style="color: red; display:none;"></small>
                            </div>

                            <div class="wrap-input-contact">
                                <input type="text" name="contact_email" placeholder="Email" id="email-cus" style="margin-bottom: 0">
                                <small id="small-email-cus" style="color: red; display:none;"></small>
                            </div>

                            <div class="wrap-input-contact">
                                <input type="text" name="contact_address" placeholder="Ðịa chỉ" id="address-cus" style="margin-bottom: 0">
                            </div>

                            <div class="wrap-input-contact">
                                <input type="text" name="contact_title" placeholder="Tiêu đề" id="title-cus" style="margin-bottom: 0">
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                            <textarea name="contact_right" id="content-cus"></textarea>
                            <button type="button" name="contact_send_btn" id="submit-contact"> Gửi đi </button>
                        </div>
                    </div>
                </div>

                {!! $config->first()->con_map !!}
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
            })
        });
    </script>
@endsection
