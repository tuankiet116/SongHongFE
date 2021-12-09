@php
echo '<?xml version="1.0" encoding="UTF-8"?>'
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>
            {{ route('home') }}
        </loc>
        <lastmod>{{ formatDatetime('now') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{ route('search.get') }}</loc>
        <lastmod>{{ formatDatetime('now') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ route('contact') }}</loc>
        <lastmod>{{ formatDatetime('now') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.80</priority>
    </url>
    @foreach ($posts as $posttype)
        <url>
            <loc>
                {{ check_posttype($posttype->post_type_title) }}
            </loc>
            <lastmod>{{ formatDatetime('now') }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        @if (isset($posttype->getRelations()['Posts']) && sizeof($posttype->getRelations()['Posts']) > 0)
            @foreach ($posttype->getRelations()['Posts'] as $post)
                <url>
                    <loc>
                        {{ check_posttype($posttype->post_type_title, $post->post_rewrite_name, $post->id) }}
                    </loc>
                    <lastmod>{{ formatDatetime($post->post_datetime_update) }}</lastmod>
                    <changefreq>weekly</changefreq>
                    <priority>0.8</priority>
                </url>
            @endforeach
        @endif
    @endforeach

    @foreach ($products as $product)
        <url>
            <loc>
                {{ route('product-detail', ['id' => $product->id]) }}
            </loc>
            <lastmod>{{ formatDatetime('now') }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach ($productCate as $cate)
        <url>
            <loc>
                {{ route('product.listing', ['id' => $cate->id]) }}
            </loc>
            <lastmod>{{ formatDatetime($cate->modified_date) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        @if (isset($cate->getRelations()['ref_category_lv1']) && sizeof($cate->getRelations()['ref_category_lv1']) > 0)
            @foreach($cate->getRelations()['ref_category_lv1'] as $catelv1)

                <url>
                    <loc>
                        {{ route('product.lv1', ['id' => $catelv1->id]) }}
                    </loc>
                    <lastmod>{{ formatDatetime("now") }}</lastmod>
                    <changefreq>daily</changefreq>
                    <priority>0.8</priority>
                </url>
                @if (isset($catelv1->getRelations()['ref_category_lv2']) && sizeof($catelv1->getRelations()['ref_category_lv2']) > 0)
                    @foreach($catelv1->getRelations()['ref_category_lv2'] as $catelv2)
                        <url>
                            <loc>
                                {{ route('product.lv2', ['id' => $catelv2->id]) }}
                            </loc>
                            <lastmod>{{ formatDatetime("now") }}</lastmod>
                            <changefreq>daily</changefreq>
                            <priority>0.8</priority>
                        </url>
                    @endforeach
                @endif
            @endforeach
        @endif
    @endforeach
</urlset>
