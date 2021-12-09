<?php
namespace App\Repositories\Repo\PostTypes;

use App\Models\PostTypeModel;
use App\Repositories\Interfaces\PostTypesInterface;

class PostTypesRepo implements PostTypesInterface{
    public function getPostTypeInfor($param, $webID)
    {
        if(is_numeric($param)){
            return PostTypeModel::where([
                ['id', '=', $param],
                ['website_user_id', '=', $webID]
            ])->first();
        }
        return PostTypeModel::where([
            ['post_type_title', '=', $param],
            ['website_user_id', '=', $webID]
        ])->first();
    }
}