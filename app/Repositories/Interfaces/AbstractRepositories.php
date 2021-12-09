<?php

namespace App\Repositories\Interfaces;

interface AbstractRepositories
{
    public function model();
    public function all();
    public function store(array $data);
    public function show(int $id);
    public function edit(int $id);
}
