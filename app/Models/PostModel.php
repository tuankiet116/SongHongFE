<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostDetailModel;

class PostModel extends Model
{

    protected $table = 'post';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    public function PostDetail(){
        return $this->hasOne(PostDetailModel::class, 'post_id', 'id');
    }
}
