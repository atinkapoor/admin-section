<?php

namespace App\Repositories\Interfaces;

interface CreditPacksRepositoryInterface
{
    public function all($cond);
    public function store($data);
    public function edit($id);
    public function update($data, $id);
    public function delete($id);
    public function switch_credit_pack($data);
}