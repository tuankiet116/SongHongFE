<?php

namespace App\Repositories\Interfaces;

interface ConfigRepoInterface
{
    public function getConfig(int $webID);
}
