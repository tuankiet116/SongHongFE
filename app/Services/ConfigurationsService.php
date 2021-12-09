<?php
namespace App\Services;

use App\Repositories\Interfaces\ConfigRepoInterface;
use App\Repositories\Interfaces\WebsiteRepoInterface;

class ConfigurationsService{
    private $config;
    private $web;

    public function __construct(ConfigRepoInterface $config, WebsiteRepoInterface $web)
    {
        $this->config = $config;
        $this->web = $web;
    }

    public function getConfig(){
        $id = $this->web->getWebsiteInformation(request()->getHost())->id;
        return $this->config->getConfig($id);
    }
}