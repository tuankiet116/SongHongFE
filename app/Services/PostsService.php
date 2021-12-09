<?php
namespace App\Services;

use App\Repositories\Interfaces\PostsInterface;
use App\Repositories\Interfaces\PostTypesInterface;
use App\Repositories\Interfaces\WebsiteRepoInterface;

class PostsService {
    private $web;
    private $webID;
    
    private $posts;
    private $postTypes;

    public function __construct(WebsiteRepoInterface $web, PostsInterface $posts, PostTypesInterface $postTypes)
    {
        $this->web = $web->getWebsiteInformation(request()->getHost());
        $this->webID = $this->web->id;

        $this->posts = $posts;
        $this->postTypes = $postTypes;
    }

    private function getPostTypeID($param = null){
        if(!isset($param)){
            $param = explode('/', request()->getPathInfo())[1];
        }
        return $this->postTypes->getPostTypeInfor($param, $this->webID)->id??null;
    }

    public function listingPosts($paginate = null){
        return $this->posts->getListingPostByPostTypeID($this->getPostTypeID(), $paginate);
    }

    public function listingPostsByPostType(string $param = null, $paginate = null){
        $post_type_id = $this->getPostTypeID($param);
        if(isset($post_type_id)){
            return $this->posts->getListingPostByPostTypeID($post_type_id, $paginate);
        }
        return null;
    }

    public function getNewestPost(string $param = null){
        $post_type_id = $this->getPostTypeID($param);
        if(isset($post_type_id)){
            return $this->posts->getListingPostByPostTypeID($post_type_id)->first();
        }
        return null;
    }

    public function getPostInfor(){
        $param = explode('/',request()->path())[1];
        $pt_id = $this->getPostTypeID();
        return $this->posts->getPostInformation($param, $pt_id);
    }

    public function getPostDetail(){
        $param = explode('/',request()->path())[1];
        if(is_numeric($param)){
            return $this->posts->getDetailByID($param);
        }
        return $this->posts->getDetailByRW($param);
    }
    
    public function increaseView(){
        $param = explode('/',request()->path())[1];
        $pt_id = $this->getPostTypeID();
        if(is_numeric($param)){
            return $this->posts->increaseViewByID($param, $pt_id);
        }
        return $this->posts->increaseViewByRW($param, $pt_id);
    }
}