<?php

namespace App\Providers;

use App\Repositories\Interfaces\ConfigRepoInterface;
use App\Repositories\Interfaces\PostsInterface;
use App\Repositories\Interfaces\PostTypesInterface;
use App\Repositories\Interfaces\ProductCateInterface;
use App\Repositories\Interfaces\ProductCateLv1Interface;
use App\Repositories\Interfaces\ProductCateLv2Interface;
use App\Repositories\Interfaces\ProductsInterface;
use App\Repositories\Interfaces\PropertiesInterface;
use App\Repositories\Interfaces\ShopsRepoInterface;
use App\Repositories\Interfaces\WebsiteRepoInterface;
use App\Repositories\Repo\ConfigurationsRepo\ConfigRepo;
use App\Repositories\Repo\Posts\PostsRepo;
use App\Repositories\Repo\PostTypes\PostTypesRepo;
use App\Repositories\Repo\ProductCategories\ProductCateRepo;
use App\Repositories\Repo\ProductCateLv1\ProductCateLv1Repo;
use App\Repositories\Repo\ProductCateLv2\ProductCateLv2Repo;
use App\Repositories\Repo\Products\ProductsRepo;
use App\Repositories\Repo\Properties\PropertiesRepo;
use App\Repositories\Repo\Shops\ShopsRepo;
use App\Repositories\Repo\Website\WebsiteRepo as WebsiteWebsiteRepo;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WebsiteRepoInterface::class, WebsiteWebsiteRepo::class);
        $this->app->bind(ShopsRepoInterface::class, ShopsRepo::class);
        $this->app->bind(PostsInterface::class, PostsRepo::class);
        $this->app->bind(PostTypesInterface::class, PostTypesRepo::class);
        $this->app->bind(ConfigRepoInterface::class, ConfigRepo::class);
        $this->app->bind(ProductCateInterface::class, ProductCateRepo::class);
        $this->app->bind(ProductsInterface::class, ProductsRepo::class);
        $this->app->bind(PropertiesInterface::class, PropertiesRepo::class);
        $this->app->bind(ProductCateLv1Interface::class, ProductCateLv1Repo::class);
        $this->app->bind(ProductCateLv2Interface::class, ProductCateLv2Repo::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
