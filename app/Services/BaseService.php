<?php

namespace App\Services;

use App\Repositories\Interfaces\ShopsRepoInterface;
use App\Repositories\Interfaces\WebsiteRepoInterface;
use Exception;

class BaseService
{
    protected $web;
    protected $webID;
    protected $webInfor;

    protected $shop;
    protected $shopInfor;
    protected $shopID;

    public function __construct(WebsiteRepoInterface $web, ShopsRepoInterface $shop)
    {
        try {
            $this->web = $web;
            $this->shop = $shop;

            $this->webInfor = $web->getWebsiteInformation(request()->getHost());
            $this->webID = $this->webInfor->id;

            $this->shopID = $this->webInfor->shop_info_id;
            $this->shopInfor = $shop->getShopInfor($this->shopID);
        } catch (Exception $e) {
            abort(500);
        }
    }
}
