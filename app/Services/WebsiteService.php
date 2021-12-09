<?php
namespace App\Services;

use App\Repositories\Interfaces\WebsiteRepoInterface;

class WebsiteService {

    private $websiteRepo;
    public function __construct(WebsiteRepoInterface $websiteRepoInterface)
    {
        $this->websiteRepo = $websiteRepoInterface;
    }

    public function getWebsiteService(){
        $url = request()->getHost();
        return $this->websiteRepo->getWebsiteInformation($url);
    }
}