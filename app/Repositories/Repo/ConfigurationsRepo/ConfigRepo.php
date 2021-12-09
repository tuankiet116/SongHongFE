<?php

namespace App\Repositories\Repo\ConfigurationsRepo;

use App\Models\ConfigurationModel;
use App\Repositories\Interfaces\ConfigRepoInterface;

class ConfigRepo implements ConfigRepoInterface
{
    public function getConfig(int $webID)
    {
        return ConfigurationModel::with('banner')
            ->where([
                ['website_user_id', '=', $webID],
            ])->get();
    }
}
