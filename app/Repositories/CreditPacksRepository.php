<?php

namespace App\Repositories;

use App\Api\APIActions;
use App\Repositories\Interfaces\CreditPacksRepositoryInterface;
use Illuminate\Support\Facades\Session;
use App\Exceptions\ApiException;

class CreditPacksRepository implements CreditPacksRepositoryInterface
{
    use APIActions;

    const TOKEN = 'token';
    const API_TOKEN = 'api_token';

    public function all($cond = array())
    {
        $q = '';
        if ( !empty($cond) ) {
            foreach ($cond as $k => $v) {
                $str = $k . '=' . $v;
                $q .= empty($q) ? $str : '&' . $str;
            }
        }
        $url = '/getAllCreditPacks';
        $url .= !empty($q) ? '?' . $q : '';
        $result = $this->get($url, $cond, [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function store($data)
    {
        $result = $this->post('/credit_pack/create', $data, [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function edit($id)
    {
        $result = $this->get('/getCreditPack/' . $id, [], [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function update($data, $id)
    {
        $result = $this->post('/credit_pack/update/' . $id, $data, [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function delete($id)
    {
        $result = $this->post('/credit_pack/delete/' . $id, [], [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function switch_credit_pack($data)
    {
        $result = $this->post('/bulk_change_subscription', $data, [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }
}