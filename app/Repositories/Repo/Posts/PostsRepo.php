<?php
namespace App\Repositories\Repo\Posts;

use App\Models\PostModel;
use App\Repositories\Interfaces\PostsInterface;

class PostsRepo implements PostsInterface{

    public function getListingPostByPostTypeID(int $id, $paginate = null)
    {
        $list = PostModel::where([
            ['post_type_id', '=', $id],
            ['view', '=', 1]
        ])->orderBy('post_datetime_update', 'desc');
        if(isset($paginate) && $paginate != 0){
            return $list->paginate($paginate);
        }
        return $list->get();
    }

    public function getDetailByID(int $id)
    {
        return PostModel::where([
            ['id', '=', $id],
            ['view', '=', 1]
        ])->first();
    }

    public function getDetailByRW(string $rw)
    {
        return PostModel::where([
            ['post_rewrite_name', '=', $rw],
            ['view', '=', 1]
        ])->first()->PostDetail;
    }

    public function increaseViewByID(int $id, int $pt_id)
    {
        PostModel::where([
            ['id', '=', $id],
            ['post_type_id', '=', $pt_id],
            ['view', '=', 1]
        ])->increment('number_view', 1);
    }

    public function increaseViewByRW(string $rw, int $pt_id)
    {
        return PostModel::where([
            ['post_rewrite_name', '=', $rw],
            ['post_type_id', '=', $pt_id],
            ['view', '=', 1]
        ])->increment('number_view', 1);
    }

    public function getPostInformation($param, int $pt_id)
    {
        if(is_numeric($param)){
            return PostModel::where([
                ['id', '=', $param],
                ['post_type_id', '=', $pt_id],
                ['view', '=', 1]

            ])->first();
        }
        return PostModel::where([
            ['post_rewrite_name', '=', $param],
            ['post_type_id', '=', $pt_id],
            ['view', '=', 1]
        ])->first();
    }
}
