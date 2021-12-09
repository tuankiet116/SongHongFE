<?php

namespace App\Repositories\Repo\Shops;
use App\Models\ShopModel;
use App\Repositories\Interfaces\ShopsRepoInterface;

class ShopsRepo implements ShopsRepoInterface{
    public function getShopInfor(int $id)
    {
        return ShopModel::find($id);
    }
}