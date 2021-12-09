<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostModel;

class PostTypeModel extends Model
{
    
    protected $table = 'post_type';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function Posts()
    {
        return $this->hasMany(PostModel::class, 'post_type_id');
    }
}
