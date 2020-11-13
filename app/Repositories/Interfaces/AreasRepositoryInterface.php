<?php

namespace App\Repositories\Interfaces;

interface AreasRepositoryInterface
{
    public function all($cond);

    public function store($data);

    public function edit($id);

    public function update($data, $id);
    public function getInfoWithGyms($cond);

}