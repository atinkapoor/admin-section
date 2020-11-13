<?php

namespace App\Repositories\Interfaces;

interface AreaDayTimeSlotsRepositoryInterface
{
    public function all($cond);

    public function edit($area_id,$day_id);

    public function update($data, $id);

}