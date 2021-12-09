<?php
namespace App\Services;
use App\Repositories\Interfaces\ShopsRepoInterface;
use App\Repositories\Interfaces\WebsiteRepoInterface;

class ShopsService extends BaseService{

    public function __construct(ShopsRepoInterface $shop, WebsiteRepoInterface $web)
    {
        parent::__construct($web, $shop);
    }

    public function getShopInfor(){;
        return $this->shop->getShopInfor($this->shopID);
    }
}