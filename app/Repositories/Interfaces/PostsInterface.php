<?php
namespace App\Repositories\Interfaces;

interface PostsInterface{
    public function getListingPostByPostTypeID(int $id);

    public function getDetailByID(int $id);
    public function getDetailByRW(string $rw);

    public function increaseViewByID(int $id, int $pt_id);
    public function increaseViewByRW(string $rw, int $pt_id);

    public function getPostInformation($param, int $pt_id);
}