<?php
namespace App\Repositories\Interfaces;

interface WebsiteRepoInterface{
    public function getWebsiteInformation(String $url);
}