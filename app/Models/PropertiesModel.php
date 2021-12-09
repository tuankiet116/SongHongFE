<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertiesModel extends Model
{
    use HasFactory;
    protected $table = 'properties';
    public $primary_key='id';
}
