<?php

namespace App\Repositories\Interfaces;

interface AreaDateRangeTimeSlotsRepositoryInterface
{
    public function all($cond);

    public function store($data);

    public function edit($id);

    public function update($data, $id);

    public function delete($id);
}