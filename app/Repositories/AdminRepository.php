<?php

namespace App\Repositories;

use App\Api\APIActions;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminRepository implements AdminRepositoryInterface
{
    use APIActions;

    const TOKEN = 'token';
    const API_TOKEN = 'api_token';

    public function update($data, $id)
    {
        $result = $this->post('/change_password/update/' . $id, $data, [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        abort($result->getStatusCode());
    }

}