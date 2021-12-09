<?php
namespace App\Services;
use App\Repositories\Interfaces\PostTypesInterface;
use App\Repositories\Interfaces\WebsiteRepoInterface;

class PostTypesService{
    private $postTypes;
    private $website;
    private $webID;

    public function __construct(PostTypesInterface $postTypes, WebsiteRepoInterface $website)
    {
        $this->postTypes = $postTypes;
        $this->website = $website;
        $this->webID = $this->website->getWebsiteInformation(request()->getHost())->id;
    }

    public function getPostTypesInfor(){
        $param = explode('/',request()->path())[0];
        return $this->postTypes->getPostTypeInfor($param, $this->webID);
    }

    public function getPostTypeByRW($param){
        return $this->postTypes->getPostTypeInfor($param, $this->webID);
    }
}