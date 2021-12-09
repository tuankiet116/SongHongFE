<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li>
                                <a href="{{ route('home') }}">Giới thiệu</a>
                            </li>

                            <li>
                                <a href="{{ route('search.get') }}">Sản phẩm</a>
                            </li>

                            <li>
                                <a href="{{ route('Promotion') }}">Khuyến mãi</a>
                            </li>

                            <li>
                                <a href="{{ route('news.tintuc') }}">Tin tức</a>
                            </li>

                            <li>
                                <a href="{{ route('contact') }}">Liên hệ</a>
                            </li>

                            <li>
                                <a href="{{ route('orderstatus') }}">Tra cứu</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="right-top-bar flex-w h-full">
                    <div class="welcome-user">
                        <a href="#" class="flex-c-m trans-04 p-lr-25" data-toggle="modal" data-target="#loginModal">
                            Đăng ký / Đăng nhập
                        </a>
                    </div>

                    <a href="tel:{{ $phone }}" class="flex-c-m trans-04 p-lr-25">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0)">
                                <path
                                    d="M22.1905 3.80586C17.113 -1.27018 8.88178 -1.26896 3.80574 3.80865C-1.27031 8.88627 -1.26909 17.1174 3.80853 22.1934C8.88615 27.2695 17.1173 27.2683 22.1933 22.1907C24.6311 19.7521 26.0003 16.445 25.9995 12.9969C25.9988 9.54932 24.6287 6.24326 22.1905 3.80586ZM19.6876 18.1085C19.687 18.1091 19.6865 18.1097 19.6858 18.1102V18.1059L19.0272 18.7602C18.1753 19.6228 16.9347 19.9778 15.7555 19.6962C14.5675 19.3782 13.4381 18.872 12.4102 18.1969C11.4552 17.5866 10.5702 16.8731 9.77116 16.0692C9.036 15.3394 8.37554 14.5381 7.79948 13.6772C7.16939 12.7509 6.67066 11.7418 6.31748 10.6785C5.9126 9.42953 6.24811 8.05899 7.18416 7.13823L7.95548 6.36691C8.16993 6.1515 8.51839 6.15073 8.73375 6.36518C8.73431 6.36574 8.73492 6.3663 8.73548 6.36691L11.1708 8.80223C11.3862 9.01668 11.387 9.36514 11.1725 9.5805C11.172 9.58106 11.1714 9.58162 11.1708 9.58223L9.7408 11.0122C9.33048 11.4181 9.27889 12.063 9.61948 12.5289C10.1367 13.2387 10.709 13.9067 11.3312 14.5266C12.0248 15.2232 12.7788 15.8569 13.5845 16.4203C14.05 16.745 14.6811 16.6902 15.0838 16.2903L16.4661 14.8863C16.6806 14.6709 17.029 14.6701 17.2444 14.8846C17.2449 14.8851 17.2455 14.8857 17.2461 14.8863L19.6858 17.3303C19.9013 17.5447 19.902 17.8931 19.6876 18.1085Z"
                                    fill="#FFABB8" />
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="26" height="26" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span style="font-weight: 800;color: #FF4764;margin-left: 4px;">{{ $phone }}</span>

                    </a>
                </div>
            </div>
        </div>
        <div class="wrap-menu-desktop how-shadow1 header shop">
            <nav class="limiter-menu-desktop container">
                <!-- Logo desktop -->
                <a href="{{ route('home') }}" class="logo" style="width: 25%; margin-left: 12px">
                    <img src="{{ asset('assets/images/logo/logo-new.png') }}" alt="IMG-LOGO">
                </a>
                <div class="search-bar-top hidden-search-c" style="width: 50%;">
                    <form class="search-bar" action="{{ route('search') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}
                        <input name="keyword" placeholder="Tìm kiếm sản phẩm....." type="search"
                            style="position: absolute;">
                        <select name="type">
                            <option selected="selected" disabled>Tất cả danh mục</option>
                            @if ($categories != '')
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <button class="btnn" type="submit"><i class="ti-search"></i></button>
                    </form>

                </div>
                <!-- Icon header -->
                <div class="header-icon-container wrap-icon-header flex-w flex-r-m" style="width: 25%">

                    <a href="{{ route('cart') }}" id="header-icon"
                        class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-cart">
                        <i id="icon_cart" class="zmdi zmdi-shopping-cart"></i>
                        <span id="counter"></span>
                    </a>
                </div>
            </nav>
        </div>
        <div style="width: 100%;height: 84px;">
        </div>
        <div
            style="height: 60px;background: #FFFFFF;box-shadow: 0px 1px 16px rgba(0, 0, 0, 0.08); z-index: 100 !important; position: relative">
            <ul class="main-menu container">
                @if ($categories != '')
                    @foreach ($categories as $item)
                        <li>
                            <a href="{{ route('product.listing', ['id' => $item->id]) }}">
                                <img src="{{ url_image($item->code) }}" alt="{{ $item->name }}"
                                    class="icon-c">
                                <span class="cato-na">{{ $item->name }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo/logo-new.png') }}"
                    alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">

            <a href="{{ route('cart') }}"
                class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </a>

            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
                data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li>
                <div class="welcome-user">
                    <a href="#" class="flex-c-m trans-04 p-lr-25" data-toggle="modal" data-target="#loginModal">
                        Đăng ký / Đăng nhập
                    </a>
                </div>
            </li>

            <li>
                <a href="{{ route('home') }}">Giới thiệu</a>
            </li>

            <li>
                <a href="{{ route('search.get') }}">Sản phẩm</a>
            </li>

            <li>
                <a href="{{ route('cart') }}" class="label1 rs1" data-label1="hot">Khuyến mãi</a>
            </li>

            <li>
                <a href="{{ route('news.tintuc') }}">Tin tức </a>
            </li>

            <li>
                <a href="{{ route('contact') }}">Liên hệ</a>
            </li>

        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{ asset('/assets/images/icons/icon-close2.png') }}" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0"
nonce="0ydKCaEn">
</script>

@if (isset($messenger) && $messenger !== "")
    {!! $messenger !!}
@endif
