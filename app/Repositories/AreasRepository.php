<?php

namespace App\Repositories;

use App\Api\APIActions;
use App\Repositories\Interfaces\AreasRepositoryInterface;
use Illuminate\Support\Facades\Session;
use App\Exceptions\ApiException;

class AreasRepository implements AreasRepositoryInterface
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
        $url = '/getAllAreas';
        $url .= !empty($q) ? '?' . $q : '';
        $result = $this->get($url, $cond, [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function getInfoWithGyms($cond = array())
    {
        $q = '';
        if ( !empty($cond) ) {
            foreach ($cond as $k => $v) {
                $str = $k . '=' . $v;
                $q .= empty($q) ? $str : '&' . $str;
            }
        }
        $url = '/getAreasWithGyms';
        $url .= !empty($q) ? '?' . $q : '';
        $result = $this->get($url, $cond, [],true);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function store($data)
    {
        $result = $this->post('/areas/create', $data, [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function edit($id)
    {
        $result = $this->get('/getArea/' . $id, [], [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function update($data, $id)
    {
        $result = $this->post('/areas/update/' . $id, $data, [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

}