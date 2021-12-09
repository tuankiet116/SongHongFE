<?php
namespace App\Services;

use App\Repositories\Interfaces\ProductsInterface;
use App\Repositories\Interfaces\ShopsRepoInterface;
use App\Repositories\Interfaces\WebsiteRepoInterface;
use Illuminate\Support\Facades\DB;

class ProductsService extends BaseService{
    private $products;

    public function __construct(WebsiteRepoInterface $website, ShopsRepoInterface $shop, ProductsInterface $products)
    {
        parent::__construct($website, $shop);
        $this->products = $products;
    }

    public function getBestSellerProducts(int $paginate = 0){
        return $this->products->getListingProductsWithChildrents($this->shopID, 'product_categories', ['isbest_sale', '=', 1], $paginate);
    }

    public function getProductDetail(int $id){
        $childrents = array('variations.product_properties','ref_product_images');
        return $this->products->getListingProductsWithChildrents($this->shopID, $childrents, ['id', '=', $id]);
    }

    public function getProductsByCategories(int $id, string $level ,int $paginate = null){
        return $this->products->getProductsByCategories($id, $this->shopID, $level,$paginate);
    }

    public function getProductsSearching($request, $categoriesColumnID, $id, $paginate = null)
    {
        //Query dùng cho tìm kiếm theo thuộc tính
        //Được convert từ câu sql sau:
        // select DISTINCT(product_id)
        // from product_variations
        // INNER JOIN (select product_variation_id as id
        // 		       from product_properties
        // 			   INNER JOIN (select id
        // 		             		from `properties`
        // 							where (`keyname` = 'Màu' and `value` = 'Đỏ')) as tb ON product_properties.properties_id = tb.id) as atb
        // On product_variations.id = atb.id
        $properties_query = DB::table('properties');
        foreach ($request->query() as $key => $value) {
            $keyname = preg_replace('/\_+/', ' ', $key);
            $keyvalue = preg_replace('/\_+/', ' ', $value);

            if ($keyvalue == "all" || $keyname == "price" || $keyname == "order") {
                continue;
            }
            $properties_query->orWhere(
                [
                    ['keyname', '=', $keyname],
                    ['value', '=', $keyvalue]
                ]
            );
        }
        $properties_query->select('id');

        $product_properties_query = DB::table('product_properties')
            ->joinSub($properties_query, 'atb', function ($join) {
                $join->on('product_properties.properties_id', '=', 'atb.id');
            })
            ->select('product_variation_id as id');

        $product_variations_query = DB::table('product_variations')
            ->joinSub($product_properties_query, 'tb', function ($join) {
                $join->on('product_variations.id', '=', 'tb.id');
            })
            ->distinct('product_id')
            ->select('product_id');
        $id_product = $product_variations_query->get();
        $arr_id = array();
        foreach ($id_product as $value) {
            array_push($arr_id, $value->product_id);
        }

        $products = $this->products->getProductsInListID($arr_id, $this->shopID, [$categoriesColumnID, '=', $id]);

        if ($request->query('price') && $request->query('price') != 'all') {
            $price = $request->query('price');
            if (str_contains($price, 'to')) {
                $price = explode('to', $price);
                $products->whereBetween('saleprice', [intVal($price[0]), intVal($price[1])]);
            } else {
                $products->where('saleprice', '>', intVal($price));
            }
        }

        if ($request->query('order') && $request->query('order') == "orderLowHight") {
            $products->orderBy('saleprice', 'ASC');
        }

        if(intVal($paginate) >0){
            return $products->paginate($paginate);
        }
        return $products->get();
    }

    public function getProductSampleHome(){
        return $this->products->getProductSample($this->shopID, ['sample_product', '=', 1]);
    }
}
