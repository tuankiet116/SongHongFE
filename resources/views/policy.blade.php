@extends('layouts.site', [
'title'=>"Chính sách",
'description' => $post_type_description,
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
                    "name": "Chính sách"
                },
                "position": 1
            }]
        }
    </script>
@endsection
@section('main')
    <x-header :categories="$productCate" :phone="$config->first()->con_hotline" :messenger="$config->first()->script_facebook" />
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
                Chính sách
            </span>
        </div>
    </div>

    <div class="container posts m-t-30 m-b-30">
        <div class="single-item" style="overflow: hidden">
            @foreach ($config->first()->getRelations()['banner'] as $item)
                <div>
                    <a href="{{ $item->banner_path }}">
                        <img src="{{ url_image($item->banner_url) }}" alt="banner image" width="1900" height="500">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="post-list row m-t-30">
            @foreach ($listPost as $item)
                @php
                    if ($item->post_rewrite_name == null || $item->post_rewrite_name == '') {
                        $param = $item->id;
                    } else {
                        $param = $item->post_rewrite_name;
                    }
                @endphp

                <div class="col-12 col-lg-4" style="margin-bottom: 50px">
                    <a href="{{ route('news.policy', ['rw' => $param]) }}">
                        <img style="height: 250px; width: 100%;" src="{{ url_image($item->post_avatar) }}" alt="post">
                    </a>
                    <a href="{{ route('news.policy', ['rw' => $param]) }}">
                        <h5 class="title" style="margin: 28px 0 16px 0"> {{ $item->post_title }} </h5>
                    </a>
                    <div style="display: flex">
                        <p class="date" style="margin-right: 10px">
                            {{ date('d/m/Y', strtotime($item->post_datetime_create)) }}</p>
                        <div style="display: flex; align-items:center"><i class="ti-eye"></i>
                            <p style="margin-left: 3px">{{ $item->view }} lượt xem</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="container-pagi" style="width:100%; padding-left: 20px;">
                {{ $listPost->links() }}
            </div>
        </div>
    </div>

    <x-footer :categories="$productCate" :config="$config->first()" :postPolicy="$postPolicy"/>
@endsection
