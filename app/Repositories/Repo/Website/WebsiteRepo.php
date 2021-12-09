<?php

namespace App\Repositories\Repo\Website;
use App\Models\WebsiteModel;
use App\Repositories\Interfaces\WebsiteRepoInterface;

class WebsiteRepo implements WebsiteRepoInterface{
    public function getWebsiteInformation(string $url)
    {
        return WebsiteModel::where('domain', $url)->first();
    }
}