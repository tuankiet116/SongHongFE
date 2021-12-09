<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigurationModel extends Model
{
    use HasFactory;
    protected $table = 'configuration';
    public $primary_key = 'configuration_id';

    public function banner(){
        return $this->hasMany(BannerModel::class, 'configuration_id', 'con_id')->where('banner_active', 1)->limit(3);
    }

    public function bannerAll(){
        return $this->hasMany(BannerModel::class, 'configuration_id', 'con_id');
    }
}
