<div class="featured-news-wrap  p-t-34  p-b-32  p-l-24  p-r-23">
    <h4>TIN TỨC NỔI BẬT</h3>

        @foreach ($postsTop as $postTop)
            <div class="featured-item dis-flex m-t-10">
                <img class="image_post_redirect" src="{{ url_image($postTop->post_avatar) }}" alt="postTop">
                <div class="featured-detail-item">
                    <a href="{{ check_posttype($postTypeTitle, $postTop->post_rewrite_name, $postTop->id) }}">
                        <p class="title">{{ $postTop->post_title }}</p>
                    </a>
                    <p class="date">{{ date('d/m/Y', strtotime($postTop->post_datetime_update)) }}</p>
                </div>
            </div>
        @endforeach
</div>
